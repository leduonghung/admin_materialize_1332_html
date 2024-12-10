<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DomainExtensionRequest;
use App\Services\Interfaces\DomainExtensionServiceInterface as DomainExtensionService;
use App\Repositories\Interfaces\DomainExtensionRepositoryInterface as DomainExtensionRepository;

class DomainExtensionController extends Controller
{
    protected $domainExtensionService;
    protected $domainExtensionRepository;
    public function __construct(
        DomainExtensionService $domainExtensionService,
        DomainExtensionRepository $domainExtensionRepository,
        ) {
        $this->domainExtensionService = $domainExtensionService ;
        $this->domainExtensionRepository = $domainExtensionRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            
            $data = __('messages.DomainExtension');
            $data['action'] = 'admin.domain.extension';
            if(!$request->perPages) $request->perPages = 15;
            $data['DomainExtensions'] = $this->domainExtensionService->paginate($request);
            //    $data['softDeletes'] =  $result['softDeletes'];
            // $data= $this->domainExtensionRepository->findByCondition([['current','=',0]],[],true);
        // dd($data);
            
            return view('admin.DomainExtension.index', compact('data'));//->with(['code'=>'success','title'=>'asdada','content'=>'Thêm bản ghi thành công !']);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function exists(Request $request)
    {
        try {
            // dd($request->except(['name']));
        //    $name = $request->name;
           $data = $this->domainExtensionRepository->findWhere(['name'=>$request->name]);
        //    dd($data);
            return response()->json([
                'code' => $data !== null ? 201 : 200,
                'message' => $data !== null ? 'Đuôi tên miền này đã được sử dụng !' : 'Đuôi này hợp lệ',
            ], $data !== null ? 201 : 200);
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
            $data = __('messages.DomainExtension');
            $data['flags'] = config('apps.DomainExtension.flags');
            $data['action'] = route('admin.setting.DomainExtension.store');
            $data['DomainExtension']= [];
            // dd($data['flags']);
            return view('admin.DomainExtension.create', compact('data'));
        } catch (\Exception $e) {
            throw $e;
            Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // dd($request->toArray());
            if($this->domainExtensionService->create($request)){
                return response()->json([
                    'code' => 200,
                    'message' => 'Thêm đuôi mở rộng thành công !',
                ], 200);
                // return redirect()->route('admin')->with(['code'=>'success','title'=>'Thêm mới thành công','content'=>'Bản ghi đã được thêm thành công vào dữ liệu !']);
            }
            return response()->json([
                'code' => 201,
                'message' => 'Thêm đuôi mở rộng thành công !',
            ], 201);
            // return redirect()->route('admin')->with(['code'=>'error','title'=>'Thêm mới không thành công','content'=>'Bản ghi đã được thêm không thành công vào dữ liệu !']);
            // return redirect()->route('admin.proTags.index');
            // dd($this->domainExtensionService->create($request));
        } catch (\Exception $e) {
            dd($e);
            \Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
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
            $data = __('messages.DomainExtension');
            $data['DomainExtension'] = $this->domainExtensionService->find($id);
            $data['action'] = route('admin.setting.DomainExtension.update',['id'=>$data['DomainExtension']->id]);
            // dd($id);
            // dd($data['icons']);
            return view('admin.DomainExtension.create', compact('data'));

        } catch (\Exception $e) {
            throw $e;
            Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DomainExtensionRequest $request, $id)
    {
        try {
            dd($request);
            if($this->domainExtensionService->update($id, $request)){
                return redirect()->route('admin.setting.DomainExtension')->with(['code'=>'success','title'=>'Chỉnh sửa thành công','content'=>'Bản ghi đã được Chỉnh sửa thành công vào dữ liệu !']);
                // ->with(['code'=>'info','color'=>'ff6849','time'=>'4500','title'=>'Chỉnh sửa thành công !','content'=>'Bản ghi đã được chỉnh sửa thành công !']);
            }
            return redirect()->route('admin.setting.DomainExtension.create')->with(['code'=>'error','title'=>'Chỉnh sửa không thành công','content'=>'Bản ghi đã được Chỉnh sửa không thành công vào dữ liệu !']);//->with('error','Chỉnh sửa bản ghi không thành công !');

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
            $DomainExtension = $this->domainExtensionService->delete($id);
            // dd($DomainExtension);
            $data = [
                // 'rederect' => route('admin.setting.DomainExtension'),
                'title' => 'Xóa DomainExtension thành công !',
                'name' => $DomainExtension['name'],
                'message' => $DomainExtension['message'],
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
            $DomainExtension = $this->domainExtensionService->find($request->id);
            
            // dd($DomainExtension);
            if ($data['field'] == 'status') {
                $DomainExtension->status = !$DomainExtension->status;
                $DomainExtension->DomainExtensionUpdated = \Auth::id();
                $DomainExtension->save();

                $data['label'] = $DomainExtension->isActive();
                $data['name'] = $DomainExtension->name;
                $data[$request->field] = $DomainExtension->status;
            }

            DB::commit();
            return response()->view('admin.DomainExtension.loadAjax', compact('data'), 200)->header('Content-Type', 'html');

            // return view('admin.unit.loadAjax', compact('data'));
        } catch (Exception $e) {
            DB::rollBack();
            log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
    }

    public function switchBackendDomainExtension($id) {
        $DomainExtension = $this->domainExtensionRepository->findById($id,['id','flag']);
        if($this->domainExtensionService->switch($id)){
            session(['app_locale'=>$DomainExtension->flag]);
            App::setlocale($DomainExtension->flag);
        }
        // dd($curentDomainExtension);
        return back();
    }
}
