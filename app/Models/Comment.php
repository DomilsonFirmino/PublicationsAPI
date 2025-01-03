<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    //
    protected $fillable = ['content','publication_id','content'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function publication(){
        return $this->belongsTo(Publication::class);
    }
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
