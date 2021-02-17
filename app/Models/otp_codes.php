<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otp_codes extends Model
{
    use HasFactory;
    
   
    protected $fillable = [
        'key',
    ];

 

    public function getKeyType()
    {
        return 'string';
    }

    public function user(){

        return $this->belogsTo(user::class);
        

    }


}
