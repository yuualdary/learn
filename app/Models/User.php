<?php

namespace App\Models;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\roleuser;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Traits\UsesUuid;
use DB;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use UsesUuid;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function IsAdmin(){

        // $roles = roleuser::all();
        // foreach($roles as $role){
        //     $getId = roleuser::where('rolename','ADMIN')->get();
        // }

        // dd($getId);

       $roles =DB::Table('roleusers')->where([['roleusers.rolename','=','ADMIN']])->get();
    //    dd($roles);
           foreach($roles as $role){
            $getId = $role->id;
        }
       
         
        if(Auth::user()->role_id == $getId){

            return true;
        }else{
            return false;
        }
    }

    public function IsMail(){

        if(Auth::user()->mailsend != false){
            return true;
        }
        return false;

    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(){
        return [];
    }
}
