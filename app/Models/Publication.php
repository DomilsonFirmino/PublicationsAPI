<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    //
    protected $fillable = ['img','user_id','content','title'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comment(){
        return $this->belongsTo(Comment::class,'comment_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'comment_id');
    }
}
