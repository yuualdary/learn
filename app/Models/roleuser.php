<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class roleuser extends Model
{
    use HasFactory, UsesUuid;

    
  
    protected $fillable = [
        'rolename',
    ];

    public function getIncrementing()
    {
        return false;
    }
    

    public function getKeyType()
    {
        return 'string';
    }

    
    public function user(){

        return $this->belogsTo(user::class);
        

    }

    

}

