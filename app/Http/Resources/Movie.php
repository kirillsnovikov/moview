<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Movie extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'original_title' => $this->original_title,
            'slug' => $this->slug,
            'premiere' => date('Y', strtotime($this->premiere)),
//            'description' => $this->description,
//            'description_short' => $this->description_short,
//            'kp_raiting' => $this->kp_raiting,
//            'imdb_raiting' => $this->imdb_raiting,
            'image' => $this->image,
//            'image_ext' => $this->image_ext,
//            'meta_title' => $this->meta_title,
//            'meta_description' => $this->meta_description,
//            'meta_keywords' => $this->meta_keyword,
//            'published' => $this->published,
//            'views' => $this->views,
//            'year' => $this->year,
//            'duration' => $this->duration,
//            'kp_id' => $this->kp_id,
//            'created_by' => $this->created_by,
//            'Created' => (string)$this->created_at->format('d-m-Y'),
        ];
    }

}
