<?php

namespace App\Http\Resources;

use App\User;
use App\Photo;
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
//        Voit palauttaa myös itse määräämät asiat
//        Nämä tulevat collectionissa.

        $user = User::findOrFail($this->user_id);
        $photo = Photo::findOrFail($this->main_photo_id);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'updated_at' => $this->updated_at,
            'photo' => $this->photo,
            'user' => [
                'user_id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' =>  $user->lastname,
                'nickname' => $user->nickname,
                'city' => $user->city,
                'email' => $user->email,
                'phone' => $user->phonenumber
            ],
            'photo_gallery' => [
                'main_photo_id' => $photo->id,
                'main_photo_url' => $photo->photo_url
            ]
        ];
    }

    public function with($request)
    {
        // Palautetaan ilmoituksen mukana tietoja:
//        Nämä tulevat yksittäisen ilmoituksen mukana.
//
        $user = User::findOrFail($this->user_id);

        return [
            'user' => $user
        ];
    }
}
