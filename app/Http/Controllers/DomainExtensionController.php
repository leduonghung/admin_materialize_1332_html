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
        $this->domainExtensionService = $domainExtensionService;
        $this->domainExtensionRepository = $domainExtensionRepository;
    }

    public function index(Request $request)
    {
        try {
            $colums = ["id", "name", "publish", "description", "created_at"];
            $conditions = [];
            
            $publish = $request->publish === null ? false : explode(',', $request->publish);
            if ($publish !== false) {
                $conditions['whereIn']['publish'] = $publish;
            }
            
            $join = [
                // ['languages as tb2', 'tb2.id', '=', 'domains.language_id'],
            ];

            $data = __('messages.domain_extension');
            // dd($data);
            $data['conditions'] = !empty($conditions) && array_key_exists('whereIn', $conditions) ? $conditions['whereIn'] : false;
            $data['domainExtensions'] = $this->domainExtensionRepository->findMyCondition($colums, $conditions, [], $join, [['order', 'DESC']], true);
            $data['action'] = 'admin.domain';
            // dd($data['domains']);
            return view('admin.domain-extension.index', compact('data')); //->with(['code'=>'success','title'=>'asdada','content'=>'Thêm bản ghi thành công !']);
        } catch (\Exception $e) {
            throw $e;
        }
    }


    public function edit($id)
    {
        try {
            $colums = ['id', 'name', 'order', 'description','publish'];
            $data['type'] = 'domainExtension';
            if ($data['data'] = $this->domainExtensionService->findWhere([['id', '=', $id]], $colums)) {
                return response()->json([
                    'data' => $data,
                    'message' => 'Chỉnh sửa đuôi mở rộng thành công !',
                ], 200);
            }
            return response()->json([
                'data' => false,
                'message' => 'Chỉnh sửa đuôi mở rộng không thành công !',
            ], 201);
        } catch (\Exception $e) {
            dd($e);
            \Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        try {
            // dd($request);
            if ($data = $this->domainExtensionService->update($id, $request)) {
                return response()->view('admin.domain-extension.update', compact('data'), 200)->header('Content-Type', 'html');
                // return redirect()->route('admin.user')->with(['code'=>'success','title'=>'Chỉnh sửa thành công','content'=>'Bản ghi đã được Chỉnh sửa thành công vào dữ liệu !']);
                // ->with(['code'=>'info','color'=>'ff6849','time'=>'4500','title'=>'Chỉnh sửa thành công !','content'=>'Bản ghi đã được chỉnh sửa thành công !']);
            }
            return response()->view('admin.domain-extension.update', ['error' => 'Chỉnh sửa không thành công !'], 201)->header('Content-Type', 'html');
        } catch (\Exception $e) {
            Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
    }

    public function destroy($id)
    {
        try {
            if ($domain = $this->domainExtensionService->delete($id)) {
                return response()->json($domain, 200);
            }

            return response()->json([
                'error' => 'Xóa Thất Bại',
            ], 201);

        } catch (Exception $e) {
            dd($e);
            // log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => false,
            ], 500);
        }
    }

    // public function exists(Request $request)
    // {
    //     try {
    //         $data = $this->domainExtensionRepository->findWhere(['name' => $request->name]);
    //         //    dd($data);
    //         return response()->json([
    //             'code' => $data !== null ? 201 : 200,
    //             'message' => $data !== null ? 'Đuôi tên miền này đã được sử dụng !' : 'Đuôi này hợp lệ',
    //         ], $data !== null ? 201 : 200);
    //     } catch (\Exception $e) {
    //         throw $e;
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $data = __('messages.DomainExtension');
            $data['flags'] = config('apps.DomainExtension.flags');
            $data['action'] = route('admin.setting.DomainExtension.store');
            $data['DomainExtension'] = [];
            // dd($data['flags']);
            return view('admin.Domain-extensionExtension.create', compact('data'));
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
            // if($request->has('extension')) echo $request->input('extension');
            // dd($request->toArray());
            if ($data = $this->domainExtensionService->create($request)) {
                $code = $request->has('extension') ? 200: 201;
                return response()->view('admin.domain-extension.store', compact('data'), $code)->header('Content-Type', 'html');
                // if ($request->has('extension')) {
                //     # code...
                // } else {
                //     return response()->view('admin.domain-extension.store', compact('data'), 200)->header('Content-Type', 'html');
                //     # code...
                // }
                
                // return response()->json([
                    //     'extension' => $request->has('extension') ? true: false,
                    //     'message' => 'Thêm đuôi mở rộng thành công !',
                    // ], 200);
                    // return redirect()->route('admin')->with(['code'=>'success','title'=>'Thêm mới thành công','content'=>'Bản ghi đã được thêm thành công vào dữ liệu !']);
                }
                return response()->view('admin.domain-extension.store',[
                    'code' => 205,
                    'message' => 'Thêm đuôi mở rộng thành công !',
                ], 205)->header('Content-Type', 'html');
            // return response()->json([
            //     'code' => 201,
            //     'message' => 'Thêm đuôi mở rộng thành công !',
            // ], 201);
            // return redirect()->route('admin')->with(['code'=>'error','title'=>'Thêm mới không thành công','content'=>'Bản ghi đã được thêm không thành công vào dữ liệu !']);
            // return redirect()->route('admin.proTags.index');
            // dd($this->domainExtensionService->create($request));
        } catch (\Exception $e) {
            dd($e);
            \Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
    }



    public function switchBackendDomainExtension($id)
    {
        $DomainExtension = $this->domainExtensionRepository->findById($id, ['id', 'flag']);
        if ($this->domainExtensionService->switch($id)) {
            session(['app_locale' => $DomainExtension->flag]);
            App::setlocale($DomainExtension->flag);
        }
        // dd($curentDomainExtension);
        return back();
    }
}
