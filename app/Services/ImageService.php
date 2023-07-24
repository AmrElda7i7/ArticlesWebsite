<?php

namespace App\Services;
use App\Models\ArticleImage;

class ImageService
{


    public function storeImage($image ,$article_id)
    {
        
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        ArticleImage::create(
            [
                'name' => $imageName,
                'article_id' => $article_id
            ]
        );
        $image->storeAs($article_id, $imageName, 'uploads');
    }
    public function updateImage($image ,$article_id): void
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $Image = ArticleImage::where('article_id' ,$article_id)->first() ;
        $Image->Update(  [
            'name' => $imageName,
            'article_id' => $article_id
        ]) ;
        $image->storeAs($article_id, $imageName, 'uploads');

    }
}
