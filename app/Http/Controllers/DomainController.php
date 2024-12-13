<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\DomainServiceInterface as DomainService;
use App\Repositories\Interfaces\DomainRepositoryInterface as DomainRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\Repositories\Interfaces\DomainExtensionRepositoryInterface as DomainExtensionRepository;

class DomainController extends Controller
{
    private $languageRepository;
    private $domainRepository;
    private $domainService;
    private $domainExtensionRepository;
    function __construct(LanguageRepository $languageRepository,DomainRepository $domainRepository,DomainExtensionRepository $domainExtensionRepository,DomainService $domainService)
    {
        $this->languageRepository = $languageRepository;
        $this->domainExtensionRepository = $domainExtensionRepository;
        $this->domainRepository = $domainRepository;
        $this->domainService = $domainService;
    }
    public function index(Request $request)
    {
        try {
            $colums = ["domains.id","domains.name","tb2.name as language_name", "domains.publish", "domain_extension_id","language_id", "place_registration", "expiry_date", "content", "status"];
            $conditions =[];

            $status = $request->status === null ? false : explode( ',', $request->status);
            // $conditions = [['deleted_at','==',null]];
            if($status !== false){
                $conditions['whereIn']['status'] = $status;
            }
            $publish = $request->publish === null ? false : explode( ',', $request->publish);
            if($publish !== false){
                $conditions['whereIn']['publish'] = $publish;
            }
            $domain_extension_id = $request->domain_extension_id === null ? false : explode( ',', $request->domain_extension_id);
            if($domain_extension_id !== false){
                $conditions['whereIn']['domain_extension_id'] = $domain_extension_id;
            }
            $language_id = $request->language_id === null ? false : explode( ',', $request->language_id);
            if($language_id !== false){
                $conditions['whereIn']['language_id'] = $language_id;
            }
            $join = [
                ['languages as tb2','tb2.id','=','domains.language_id'],
                // ['post_catalogues as tb3','tb3.id','=','posts.post_catalogue_id']
            ];

            // dd($conditions);
            $data = __('messages.domain');
            $data['conditions'] = !empty($conditions) && array_key_exists('whereIn',$conditions) ? $conditions['whereIn'] : false;
            $data['domains'] = $this->domainRepository->findMyCondition($colums,$conditions,[],$join,[['domains.order','DESC']],true);
            $data['languages'] = $this->languageRepository->getAll(['id','code','name']);
            $data['domainExtensions'] = $this->domainExtensionRepository->getAll(['id','name']);
            $data['action'] = 'admin.domain';
            // dd($data['domains']);
            return view('admin.domain.index', compact('data'));//->with(['code'=>'success','title'=>'asdada','content'=>'Thêm bản ghi thành công !']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // dd($request->toArray());
            if($data = $this->domainService->create($request)){
                return response()->view('admin.domain.store', compact('data'), 200)->header('Content-Type', 'html');

                // return response()->json([
                //     'code' => 200,
                //     'message' => 'Thêm đuôi mở rộng thành công !',
                // ], 200);
            }
            return response()->json([
                'code' => 201,
                'message' => 'Thêm đuôi mở rộng thành công !',
            ], 201);
        } catch (\Exception $e) {
            dd($e);
            // Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Domain $domain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $data['type'] = 'domain';
            $colums = ['id','name','language_id','domain_extension_id','date_of_registration','year_of_extended','place_registration','order','content','status','publish'];
            if($data['data'] = $this->domainService->findWhere([['id','=',$id]],$colums)){
// dd($data);
                return response()->json([
                    'data'=>$data,
                    'message' => 'Thêm đuôi mở rộng thành công !',
                ], 200);
            }
            return response()->json([
                'code' => 201,
                'message' => 'Thêm đuôi mở rộng thành công !',
            ], 201);
        } catch (\Exception $e) {
            dd($e);
            // \Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
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
            if($data = $this->domainService->update($id, $request)){
                return response()->view('admin.domain.update', compact('data'), 200)->header('Content-Type', 'html');
                // return redirect()->route('admin.user')->with(['code'=>'success','title'=>'Chỉnh sửa thành công','content'=>'Bản ghi đã được Chỉnh sửa thành công vào dữ liệu !']);
                // ->with(['code'=>'info','color'=>'ff6849','time'=>'4500','title'=>'Chỉnh sửa thành công !','content'=>'Bản ghi đã được chỉnh sửa thành công !']);
            }
            return response()->view('admin.domain.update', ['error'=>'Chỉnh sửa không thành công !'], 201)->header('Content-Type', 'html');

        } catch (\Exception $e) {
            dd($e);
            // Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return abort(403, 'Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
        }
    }

    public function resource(Request $request)
    {
        // if ($request->ajax()) {
            // dd($request->toArray());
            // $status = $request->query->get('status');
            // dd($status);
        $result['status'] = __('messages.domain.status');
        $result['publish'] = __('messages.domain.publish');
        $colums = ["domains.id","domains.name", "domains.publish", "domain_extension_id", "tb2.name as lang_name", "place_registration", "expiry_date", "months_of_extended", "status","created_at"];
        $conditions =[];
        if ($request->has('status') && !empty($request->status)) {
            // $conditions['whereIn'] = ['status',$request->status];
        }
        if ($request->has('domain_extension_id') && !empty($request->domain_extension_id)) {
            $conditions['whereIn'] = ['domain_extension_id',$request->domain_extension_id];
        }
        // $status = $request->status;
        // dd($request->toArray());
        // if(!empty($conditions)){
        //     foreach ($conditions as $key => $val) {
        //         $query->where($val[0],$val[1],$val[2]);
        //     }
        // }
        $join = [
            ['countries as tb2','tb2.id','=','domains.language_id'],
            // ['post_catalogues as tb3','tb3.id','=','posts.post_catalogue_id']
        ];

        // if(!empty($relations)){
        //     foreach ($relations as $value) {
        //         $query->with($value);
        //     }
        // }
        // if(count($orderBy)){
        //     foreach ($orderBy as $val) {
        //         $query->orderBy($val[0],$val[1]);
        //     }
        // }

            $data = $this->domainRepository->findMyCondition($colums,[],[],$join,[['order','DESC']],true);
        //     if(!empty($request->Region)) {
        //         $query->whereIn('Region',$request->Region);
        //    }
            // return DataTables::query(DB::table('users'))->toJson();
            // dd($data);
            return Datatables::of($data)
            ->addColumn('status', function($row) use ($result) {
                return $result['status'][$row->status];
            })
            ->addColumn('publish', function($row) use ($result) {
                // dd($result['publish']);
                return $result['publish'][$row->publish];
            })
            ->addColumn('action', function($row){
                // ${ route('admin.domain') 
                // $btn = `<a href="`.route('admin.domain.edit',['id'=>$row->id]) .`" class="btn btn-icon btn-secondary waves-effect waves-light"> <span class="tf-icons ri-notification-4-line ri-22px"></span> </a>`;tf-icons ri-22px
                $btn = '<a href="'.route('admin.domain.edit',['id'=>$row->id]) .'" class="btn btn-icon btn-outline-primary waves-effect"> <i class="ri-pencil-fill tf-icons ri-22px"></i> </a>';
                $btn .= ' | <a href="'.route('admin.domain.edit',['id'=>$row->id]) .'" class="btn btn-icon btn-danger waves-effect"><i class="ri-delete-bin-6-line tf-icons ri-22px"></i> </a>';

                return $btn;
            })
            ->rawColumns(['action', 'status'])
            // ->filterColumn("status", function($query, $value){
            //     $query->whereHas("status", fn($q) => $q->whereIn("status", $value));
            // })
            // ->rawColumns(['status'])
            // ->filter(function ($query) use ($request) {

                // if ($request->has('status') && !empty($request->status)) {
                //     dd($request->status);
                //     // $query->where('status', 'in', $request->get('status'));
                // }
        
            // if ($request->has('category')) {
            //         $query->whereHas('categories', function ($q) use ($request) {
            //             $q->where('categories.slug', $request->category);
            //         });
            //     }
        
              
            // })
            // ->addIndexColumn()

                    // ->addColumn('status', function($row){

                    //      if($row->status){

                    //         return '<span class="badge badge-primary">Active</span>';

                    //      }else{

                    //         return '<span class="badge badge-danger">Deactive</span>';

                    //      }

                    // })
                    // ->filter(function ($instance) use ($request) {
                        // dd($request->get('status'));
                        // if (count($request->get('status')) > 0) {

                            // $instance->where('status','in', $request->get('status'));

                        // }
                    //     if(!empty($request->status)) {
                    //         $instance->whereIn('status',$request->status);
                    //    }

                        // if (!empty($request->get('search'))) {

                        //      $instance->where(function($w) use($request){

                        //         $search = $request->get('search');

                        //         $w->orWhere('name', 'LIKE', "%$search%")

                        //         ->orWhere('email', 'LIKE', "%$search%");

                        //     });

                        // }

                    // })
                    // ->rawColumns(['status'])
            ->make(true);
        // $products = Domain::all();
        // return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            if ( $domain = $this->domainService->delete($id)) {
                // $code = 200;
                // $data = [
                //     'title' => 'Xóa domain thành công !',
                //     'message' => 'domain '.$domain->name .' đã xóa thành công',
                // ];
                return response()->json($domain, 200);
            } 
            
            return response()->json([
                'error' => 'Xóa Thất Bại',
            ], 201);

            // return redirect()->route('motorcycles.show', ['id' => $motorcycles->id]);
        } catch (Exception $e) {
            dd($e);
            // log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => false,
            ], 500);
            // echo $e->getMessage().' IN ' .$e->getLine();
        }
    }
    public function exists(Request $request)
    {
        try {
            // dd($request->toArray());
           $name = $request->name;
           $data = $this->domainRepository->findWhere(['name'=>$name]);
        //    echo $data !== null ? 201 : 200;
        //    dd($data);
            return response()->json([
                'code' => $data !== null ? 201 : 200,
                'message' => $data !== null ? 'Tên miền này đã được sử dụng !' : 'Tên miền này hợp lệ !',
            ], $data !== null ? 201 : 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
