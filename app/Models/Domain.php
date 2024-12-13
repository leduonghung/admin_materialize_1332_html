<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Domain extends Model
{
    use HasFactory,SoftDeletes,QueryScopes;
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'name',
        'language_id',
        'domain_extension_id',
        'date_of_registration',
        'expiry_date',
        'year_of_extended',
        'place_registration',
        'content',
        'status',
        'publish',
        'order',
        'userCreated',
        'userUpdated',
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    public function isPublish()
    {
        return __('messages.domain.publish')[$this->publish];
    }
    public function isCheck()
    {
        return __('messages.domain.status')[$this->status];
    }

    public function language() {
        return $this->hasOne(Language::class,'id', 'language_id');
    }
}
