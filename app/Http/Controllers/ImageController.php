<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddImageRequest;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
//        return Image::all();


        try{

            $images = Image::orderBy('listing_id', 'ASC')->get();
            if($images){
                return response()->json([
                    'data'=> $images
                ],200);
            }
            return response()->json([
                'image'=>"empty"
            ],404);
        }
        catch(\Exception $e){
            return response()->json([
                'image'=>'internal error'
            ],500);
        }

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
     * @param AddImageRequest $request
     * @return JsonResponse
     */
    public function store(AddImageRequest $request)
    {
        $inputs = $request->all();

        $image = new Image();
        $image->fill($inputs);
        $image->save();

        return response()->json (['added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
//        return Image::where('id', $id)->first();

        $image = Image::find($id);
        if($image)
        {
            return response()->json([
                'data'=> $image
            ],200);
        }
        return response()->json([
            'image'=>'image could not be found'
        ],500);

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
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
//        $inputs = $request->all();
//        $image = Image::where('id', $id)->first();
//        $image->update($inputs);


        $image = Image::find($id);

        if($image){
            $image->update($request->all());
            if($image->save()){
                return response()->json([
                    'data'=> $image
                ],200);
            }
            else
            {
                return response()->json([
                    'image'=>'image could not be updated'
                ],500);
            }
        }
        return response()->json([
            'image'=>'image could not be found'
        ],500);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
//        Image::where('id', $id)->delete();


        $image = Image::find($id);
        if($image->delete()){ //returns a boolean
            return response()->json([
                'image'=> "mabrouk"
            ],200);
        }
        else
        {
            return response()->json([
                'image'=>'image could not be deleted'
            ],500);
        }
    }
}
