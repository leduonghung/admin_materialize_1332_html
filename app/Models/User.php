<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\QueryScopes;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory,SoftDeletes;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable,QueryScopes;
    protected $softDelete = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile_photo_path',
        'password',
        'phone',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'birthday',
        'description',
        'user_agent',
        'ip',
        'image',
        'publish',
        'userCreated',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isActive()
    {
        return ($this->publish) ? 'Kích hoạt' : ' &nbsp; Ẩn &nbsp; ';
    }

    // public function roles() {
    //     return $this->belongsToMany(Role::class, 'role_users','user_id', 'role_id')

    //     ->select(['roles.id', 'roles.name', 'roles.publish'])->withTimestamps();
    // }

    // public function checkPermissionAccess($permissionCheck) : bool {
    //     $roles = auth()->user()->roles;
    //     $roles->contains(function ($role) {
    //         if(in_array(strtolower($role->name),['admin','developer'])) return true;
    //         // dd($value);
    //     });

    //     // dd($roles);
    //     foreach ($roles as $role) {
    //         $permissions = $role->permissions;
    //         // dd($permissions->toArray());
    //         if($permissions->contains('key_code', $permissionCheck)){
    //             return true;
    //         }
    //     }
    //     return false;
    // }
}
