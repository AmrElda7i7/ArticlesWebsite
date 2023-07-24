<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $fillable = ['body' ,'user_id' ,'article_id'] ;
    public function user()
    {
        return $this->belongsTo(User::class) ;
    }
}
