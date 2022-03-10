<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookmarkRequest;
use App\Models\Bookmark;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
//        return Bookmark::all();

        try{

            $bookmarks = Bookmark::orderBy('user_id', 'ASC')->get();
            if($bookmarks){
                return response()->json([
                    'data'=> $bookmarks
                ],200);
            }
            return response()->json([
                'bookmark'=>"empty"
            ],404);
        }
        catch(\Exception $e){
            return response()->json([
                'bookmark'=>'internal error'
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
     * @param AddBookmarkRequest $request
     * @return JsonResponse
     */
    public function store(AddBookmarkRequest $request)
    {
        $inputs = $request->all();

        $bookmark = new Bookmark();
        $bookmark-> fill($inputs);
        $bookmark->save();

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
//        return Bookmark::where('id', $id)->first();

        $bookmark = Bookmark::find($id);
        if($bookmark)
        {
            return response()->json([
                'data'=> $bookmark
            ],200);
        }
        return response()->json([
            'bookmark'=>'bookmark could not be found'
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
//        $bookmark = Bookmark::where('id', $id)->first();
//        $bookmark->update($inputs);


        $bookmark = Bookmark::find($id);

        if($bookmark){
            $bookmark->update($request->all());
            if($bookmark->save()){
                return response()->json([
                    'data'=> $bookmark
                ],200);
            }
            else
            {
                return response()->json([
                    'bookmark'=>'bookmark could not be updated'
                ],500);
            }
        }
        return response()->json([
            'bookmark'=>'bookmark could not be found'
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
//        Bookmark::where('id', $id)->delete();


        $bookmark = Bookmark::find($id);
        if($bookmark->delete()){ //returns a boolean
            return response()->json([
                'bookmark'=> "mabrouk"
            ],200);
        }
        else
        {
            return response()->json([
                'bookmark'=>'bookmark could not be deleted'
            ],500);
        }

    }
}
