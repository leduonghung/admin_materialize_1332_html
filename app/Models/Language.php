<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory,QueryScopes;
    // protected $table = 'countries';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'code',
        'iso_code',
        'name',
        'capital',
        'continent',
        'phone_code',
        'currency_code',
    ];


    // public function post_catalogue(){
    //     return $this->belongsToMany(PostCatalogue::class, 'post_catalogue_language', 'language_id', 'post_catalogue_id')
    //     // ->withPivot('name','description','content','meta_title','meta_keyword','meta_description','canonical')
    //     ->withTimestamps();
    // }
    // public function menus(){
    //     return $this->belongsToMany(Menu::class, 'menu_language', 'language_id', 'menu_catalogue_id')
    //     ->withPivot('name','canonical')
    //     ->withTimestamps();
    // }

    public function domain()
    {
        return $this->belongsToy(Domain::class, 'language_id', 'id');
    }
}
