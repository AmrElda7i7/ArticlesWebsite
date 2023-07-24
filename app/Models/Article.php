<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['name' ,'category_id' ,'body' ,'status' ] ;
    public function category()
    {
        return $this->belongsTo(Category::class) ;
    }
    public function image()
    {
        return $this->hasOne(ArticleImage::class) ;
    }
    public function user()
    {
        return $this->belongsTo(User::class) ;
    }
    public function comments()
    {
        return $this->hasMany(comment::class);
    }
}
