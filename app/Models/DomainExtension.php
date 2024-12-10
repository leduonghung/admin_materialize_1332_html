<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DomainExtension extends Model
{
    use HasFactory,SoftDeletes,QueryScopes;
    // protected $table = 'DomainExtension';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'name',
        'description',
        'order',
        'publish',
        'userCreated',
        'userUpdated'
    ];

    public function isActive()
    {
        return ($this->publish) ? 'Kích hoạt' : ' &nbsp; Ẩn &nbsp; ';
    }
}
