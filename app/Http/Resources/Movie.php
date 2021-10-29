<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Movie extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return parent::toArray($request);
    }

//    public function toArray($request)
//    {
//             return [
//                 'ID' => $this->id,
//                 'Movie Title' => $this->movie_title,
//                 'Rate of movie' => $this->rate_of_movie
//             ];
//    }
//
//    public function with($request)
//    {
//        return [
//            'version' => '1.0.0',
//            'api_url' => url('http://127.0.0.1:8000/api')
//        ];
//    }


}