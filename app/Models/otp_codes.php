<?php

namespace App\Models;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otp_codes extends Model
{
    use HasFactory, UsesUuid;
    
   
    protected $fillable = [
        'otp','valid_until','user_id'
    ];

 

    public function getKeyType()
    {
        return 'string';
    }

    public function user(){

        return $this->belogsTo(user::class);
        

    }


}
