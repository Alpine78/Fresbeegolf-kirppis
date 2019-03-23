<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Advert extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content
        ];
    }

    public function with($request)
    {
        return [
          'author_url' => url('https://ilkkarytkonen.fi/')
        ];
    }
}
