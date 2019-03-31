<?php

namespace App\Http\Controllers;

use App\Http\Resources\Advert as AdvertResource;
use Illuminate\Http\Request;
use App\Advert;

class AdvertController extends Controller
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
        return AdvertResource::collection($adverts);
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
            Advert::findOrFail($request->advert_id) :
            new Advert;

        $advert->id = $request->input('advert_id');
        $advert->title = $request->input('title');
        $advert->content = $request->input('content');

        if($advert->save()) {
            return new AdvertResource($advert);
        }
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
        return new AdvertResource($advert);
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
        // Hae ilmoitus
        $advert = Advert::findOrFail($id);

        if($advert->delete()) {
            return new AdvertResource($advert);
        }
    }
}
