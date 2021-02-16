<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roleuser extends Model
{
    use HasFactory;

    
    protected static function boot(){
        static::creating(function ($model){
            if (! $model->getKey()){
                $model->{$model->getKeyName()}=(string) Str::uuid();//str adalah helper uuid
            }
        });

     }

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

