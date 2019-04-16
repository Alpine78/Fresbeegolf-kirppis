<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Photo;
use App\Http\Resources\Photo as PhotoResource;
use Illuminate\Http\UploadedFile;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $photos = Photo::get();

        // Palauttaa kuvat resurssina
        return PhotoResource::collection($photos);
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

//        $uploadedPhotos = $request->photo;
//        return response(['fileexension'=>$uploadedPhotos->extension]);
        // Edwin Diazin ohje
        // 209. Persisting user with photo part 1

//        $input = $request->all();
//
//        if ($file = $request->file('photo_id')) {
//            $name = time() . $file->getClientOriginalName();
//            $file->move('images', $name);
//            $photo = Photo::create(['file'=>$name]);
//            $input['photo_id'] = $photo->id;
//        }

        // https://appdividend.com/2018/02/05/laravel-multiple-images-upload-tutorial/

//        $this->validate($request, [
//           'photo' => 'required',
//           'photo.*' =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
//        ]);


//        if ($request->hasFile('photo'))
//        {
//            foreach ($request->file('photo') as $image)
//            {
//                $name = time() . $image->getClientOriginalName();
//                $image->move(public_path().'/images/', $name);
//                $data[] = $name;
//            }
//        }

//        return $request->photos;
//
//        $uploadedPhotos = $request->photos;
//        //$uploadedPhotos->store('dummy');
////        dd($uploadedPhotos);
//
//        $file = $request->file('photos');
//        $file = $request->photos;
//        $path = $request->photos->store('images');

//
//        $input = $request->all();
//        foreach ($input as $item)
//        {
//            $file = $request->file('photos');
//            $file = $request->photos;
//            $path = $request->photos->store('images');

//            if ($input = $request->file('photos')) {
////                $input->store('teststiore');
////                $name = time() . $input->getClientOriginalName();
////                $input->move('images', $name);
////                $photo = Photo::create(['file'=>$name]);
////                $input['photo_id'] = $photo->id;
//
//            }
        //}

//        foreach ($uploadedPhotos as $uploadedPhoto)
//        {
//            $uploadedPhoto->store('kuva');
//        }

        $advert_id = $request->input('advert_id');




        return response(['status'=>'success'], 200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Yksi kuva
        $photo = Photo::findOrFail($id);
        return new PhotoResource($photo);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function advertphotos($id)
    {
        $photos = Photo::where('advert_id', $id)->get();

        // Palauttaa kuvat resurssina
        return PhotoResource::collection($photos);
    }
}
