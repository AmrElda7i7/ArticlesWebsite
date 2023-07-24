<?php
use App\Models\ArticleImage;

function generalException($destination)
{
    return redirect()->route($destination)->with('error', 'something went wrong!');
}


function storeImage($image, $article): void
{
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $article->image->create(
        [
            'name' => $imageName,
        ]
    );
    $image->storeAs($article->id, $imageName, 'uploads');
}