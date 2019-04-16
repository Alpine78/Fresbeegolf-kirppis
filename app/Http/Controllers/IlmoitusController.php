<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advert;
use App\Http\Resources\Photo;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Resources\Ilmoitus as IlmoitusResource;


class IlmoitusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ilmoitukset
        $adverts = Advert::orderBy('updated_at', 'desc')->paginate(15);
            //->get();
            //->paginate(15);

        // Palauta kaikki resurssina
        return IlmoitusResource::collection($adverts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //




        $advert = $request->isMethod('put') ?
            Advert::findOrFail($request->advert_id) : new Advert;

        $advert->id = $request->input('advert_id');
        $advert->user_id = $request->input('user_id');
        $advert->title = $request->input('title');
        $advert->content = $request->input('content');
        $advert->brand = $request->input('brand');
        $advert->model = $request->input('model');
        $advert->type = $request->input('type');
        $advert->condition = $request->input('condition');
        $advert->price = $request->input('price');
        $advert->main_photo_id = $request->input('main_photo_id');

        $photo = $request->input('photo');
        $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('images/').$name);
        $request->merge(['photo' => $name]);
//        $userPhoto = public_path('img/profile/').$currentPhoto;
        $advert->photo = 'images/' . $name;

        if($advert->save()) {
//            return new AdvertResource($advert);
            $newAdvert = new IlmoitusResource($advert);
//            $this->savePhotos($photo, $advert->id);

//            return $request->input('photos');


            return $newAdvert;
        }
    }

    public function savePhotos($photo, $advertId)
    {
//        dd($photo);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Hae ilmoitus
        $advert = Advert::findOrFail($id);

        // Palauta yksi ilmoitus resurssina
        return new IlmoitusResource($advert);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $advert = Advert::findOrFail($id);

        $advert->user_id = $request->input('user_id');
        $advert->title = $request->input('title');
        $advert->content = $request->input('content');
        $advert->brand = $request->input('brand');
        $advert->model = $request->input('model');
        $advert->type = $request->input('type');
        $advert->condition = $request->input('condition');
        $advert->price = $request->input('price');
        $advert->main_photo_id = $request->input('main_photo_id');

        $photo = $request->input('photo');
        $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('images/').$name);
        $request->merge(['photo' => $name]);
//        $userPhoto = public_path('img/profile/').$currentPhoto;
        $advert->photo = 'images/' . $name;

        if($advert->save()) {
//            return new AdvertResource($advert);
            $newAdvert = new IlmoitusResource($advert);
//            $this->savePhotos($photo, $advert->id);

//            return $request->input('photos');


            return $newAdvert;
        }

        dd($request);
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Hae ilmoitus
        $advert = Advert::findOrFail($id);

        if($advert->delete()) {
            return new IlmoitusResource($advert);
        }
    }
}
