<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['title','body','user_id'];
    //using this method it will not show err msg on pasing arr on create method

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
