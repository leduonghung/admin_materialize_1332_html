<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LanguageRequest;
use App\Services\Interfaces\LanguageServiceInterface as languageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;

class LanguageController extends Controller
{
    protected $languageService;
    protected $languageRepository;
    public function __construct(
        languageService $languageService,
        LanguageRepository $languageRepository,
        ) {
        $this->languageService = $languageService ;
        $this->languageRepository = $languageRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            
            $data = __('messages.language');
            $data['action'] = 'admin.setting.language';
            if(!$request->perPages) $request->perPages = 15;
            $data['languages'] = $this->languageService->paginate($request);
            //    $data['softDeletes'] =  $result['softDeletes'];
            // $data= $this->languageRepository->findByCondition([['current','=',0]],[],true);
        // dd($data);
            
            return view('admin.language.index', compact('data'));//->with(['code'=>'success','title'=>'asdada','content'=>'Thêm bản ghi thành công !']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $data = __('messages.language');
            $data['flags'] = config('apps.language.flags');
            $data['action'] = route('admin.setting.language.store');
            $data['language']= [];
            // dd($data['flags']);
            return view('admin.language.create', compact('data'));
        } catch (\Exception $e) {
            throw $e;
            Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageRequest $request)
    {
        try {
            if($this->languageService->create($request)){
                return redirect()->route('admin.setting.language')->with(['code'=>'success','title'=>'Thêm mới thành công','content'=>'Bản ghi đã được thêm thành công vào dữ liệu !']);
            }
            return redirect()->route('admin.setting.language.create')->with(['code'=>'error','title'=>'Thêm mới không thành công','content'=>'Bản ghi đã được thêm không thành công vào dữ liệu !']);
            // return redirect()->route('admin.proTags.index');
            // dd($this->languageService->create($request));
        } catch (\Exception $e) {
            Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $data = __('messages.language');
            $data['language'] = $this->languageService->find($id);
            $data['action'] = route('admin.setting.language.update',['id'=>$data['language']->id]);
            // dd($id);
            // dd($data['icons']);
            return view('admin.language.create', compact('data'));

        } catch (\Exception $e) {
            throw $e;
            Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageRequest $request, $id)
    {
        try {
            dd($request);
            if($this->languageService->update($id, $request)){
                return redirect()->route('admin.setting.language')->with(['code'=>'success','title'=>'Chỉnh sửa thành công','content'=>'Bản ghi đã được Chỉnh sửa thành công vào dữ liệu !']);
                // ->with(['code'=>'info','color'=>'ff6849','time'=>'4500','title'=>'Chỉnh sửa thành công !','content'=>'Bản ghi đã được chỉnh sửa thành công !']);
            }
            return redirect()->route('admin.setting.language.create')->with(['code'=>'error','title'=>'Chỉnh sửa không thành công','content'=>'Bản ghi đã được Chỉnh sửa không thành công vào dữ liệu !']);//->with('error','Chỉnh sửa bản ghi không thành công !');

        } catch (\Exception $e) {
            Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $language = $this->languageService->delete($id);
            // dd($language);
            $data = [
                // 'rederect' => route('admin.setting.language'),
                'title' => 'Xóa Language thành công !',
                'name' => $language['name'],
                'message' => $language['message'],
            ];
            return response()->json($data, 200);

            // return redirect()->route('motorcycles.show', ['id' => $motorcycles->id]);
        } catch (Exception $e) {
            log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => false,
            ], 500);
            // echo $e->getMessage().' IN ' .$e->getLine();
        }
    }

    public function loadAjax(Request $request)
    {
        // dd($request->toArray());
        try {
            DB::beginTransaction();
            // $oneUnit = $this->unit->find($id);
            $data['field'] = $request->field;
            $data['id'] = $request->id;
            $language = $this->languageService->find($request->id);
            
            // dd($language);
            if ($data['field'] == 'status') {
                $language->status = !$language->status;
                $language->languageUpdated = \Auth::id();
                $language->save();

                $data['label'] = $language->isActive();
                $data['name'] = $language->name;
                $data[$request->field] = $language->status;
            }

            DB::commit();
            return response()->view('admin.language.loadAjax', compact('data'), 200)->header('Content-Type', 'html');

            // return view('admin.unit.loadAjax', compact('data'));
        } catch (Exception $e) {
            DB::rollBack();
            log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
    }

    public function switchBackendLanguage($id) {
        $language = $this->languageRepository->findById($id,['id','flag']);
        if($this->languageService->switch($id)){
            session(['app_locale'=>$language->flag]);
            App::setlocale($language->flag);
        }
        // dd($curentLanguage);
        return back();
    }
}
