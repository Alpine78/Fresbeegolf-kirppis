<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Photo;
use App\Http\Resources\Photo as PhotoResource;

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

        $uploadedPhotos = $request->photo;
        return response(['fileexension'=>$uploadedPhotos->extension]);
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
//           'filename' => 'required',
//           'filename.*' =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
//        ]);

//        if ($request->hasFile('filename'))
//        {
//            foreach ($request->file('filename') as $image)
//            {
//                $name = time() . $image->getClientOriginalName();
//                $image->move(public_path().'/images/', $name);
//                $data[] = $name;
//            }
//        }


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
