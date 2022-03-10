<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddListingRequest;
use App\Models\Listing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
//        return Listing::all();


        try{

            $listings = Listing::orderBy('price', 'ASC')->get();
            if($listings){
                return response()->json([
                    'data'=> $listings
                ],200);
            }
            return response()->json([
                'listing'=>"empty"
            ],404);
        }
        catch(\Exception $e){
            return response()->json([
                'listing'=>'internal error'
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
     * @param AddListingRequest $request
     * @return JsonResponse
     */
    public function store(AddListingRequest $request)
    {
        $inputs = $request->all();

        $listing = new Listing();
        $listing->fill($inputs);
        $listing->save();
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
//        return Listing::where('id', $id)->first();

        $listing = Listing::find($id);
        if($listing)
        {
            return response()->json([
                'data'=> $listing
            ],200);
        }
        return response()->json([
            'listing'=>'listing could not be found'
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
//        $listing = Listing::where('id', $id)->first();
//        $listing->update($inputs);

        $listing = Listing::find($id);

        if($listing){
            $listing->update($request->all());
            if($listing->save()){
                return response()->json([
                    'data'=> $listing
                ],200);
            }
            else
            {
                return response()->json([
                    'listing'=>'listing could not be updated'
                ],500);
            }
        }
        return response()->json([
            'listing'=>'listing could not be found'
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
//        Listing::where('id', $id)->delete();


        $listing = Listing::find($id);
        if($listing->delete()){ //returns a boolean
            return response()->json([
                'listing'=> "mabrouk"
            ],200);
        }
        else
        {
            return response()->json([
                'listing'=>'listing could not be deleted'
            ],500);
        }
    }
}
