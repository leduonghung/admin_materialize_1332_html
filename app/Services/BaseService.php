<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Repositories\LanguageRepository;
use App\Services\Interfaces\BaseServiceInterface;

class BaseService implements BaseServiceInterface
{
    protected $nestedset;
    protected $languageRepository;
    public function __construct()
    {
        // $this->languageRepository = $languageRepository;
    }

    // public function currentLanguage()
    // {
    //     $languageRepository = new LanguageRepository();
    //     $languageData = $languageRepository->findWhere(['current'=>1],['id','name','current']);
    //     if(!$languageData){
    //         $flag = \App::getLocale();
    //         $languageDataFlag = $languageRepository->findWhere(['flag'=>$flag],['id','name','current']);
    //         if ($languageDataFlag) {
    //             return $languageDataFlag->id;
    //         }

    //     }else{
    //         return $languageData->id;
    //     }
    //     return 1;
    // }

    // public function nestedset()
    // {
    //     $this->nestedset->Get('level ASC, order ASC');
    //     $this->nestedset->Recursive(0, $this->nestedset->Set());
    //     $this->nestedset->Action();
    // }

    public function formatRouterPayload($model_id,$canonical, $controllerName){
        return [
            'canonical' =>$canonical,
            'module_id' =>$model_id,
            'controllers'=>'App\Http\Controllers\Frontend\\'.$controllerName
        ];
    }

    public function updateStatus($post = []){
        DB::beginTransaction();
        try {
            $model = lcfirst($post['model']).'Repository';
            $payload['userUpdated'] = \Auth::id();
            $payload[$post['field']] = !(int) $post['value'];
            // dd($post['modelId']);
            $data = $this->{$model}->update($post['modelId'],$payload);

            DB::commit();
            return $data;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage().' IN ' .$e->getLine();
            return false;
        }
    }

    public function updateStatusAll($post = []){
        DB::beginTransaction();
        try {
            $model = lcfirst($post['model']).'Repository';
            $payload['userUpdated'] = \Auth::id();
            $payload[$post['field']] = (int) $post['value'];

            $flag = $this->{$model}->updateByWhereIn($post['modelId'],$payload);

            DB::commit();
            return $flag;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage().' IN ' .$e->getLine();
            return false;
        }
    }
}
