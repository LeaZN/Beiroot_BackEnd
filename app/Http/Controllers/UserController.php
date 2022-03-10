<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
//        return User::all();

        try{

            $users = User::orderBy('id', 'ASC')->get();
            if($users){
                return response()->json([
                    'data'=> $users
                ],200);
            }
            return response()->json([
                'user'=>"empty"
            ],404);
        }
        catch(\Exception $e){
            return response()->json([
                'user'=>'internal error'
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
     * @param AddUserRequest $request
     * @return JsonResponse
     */
    public function store(AddUserRequest $request)
    {
        $inputs = $request->all();

        $user = new User();
        $user->fill($inputs);
        $user->save();

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
//                return User::where('id', $id)->first();

        $user = User::find($id);
        if($user)
        {
            return response()->json([
                'data'=> $user
            ],200);
        }
        return response()->json([
            'user'=>'user could not be found'
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
//                    $inputs = $request->all();
//                    $user = User::where('id', $id)->first();
//                    $user->update($inputs);

        $user = User::find($id);

        if($user){
            $user->update($request->all());
            if($user->save()){
                return response()->json([
                    'data'=> $user
                ],200);
            }
            else
            {
                return response()->json([
                    'user'=>'user could not be updated'
                ],500);
            }
        }
        return response()->json([
            'user'=>'user could not be found'
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
//        User::where('id', $id)->delete();


        $user = User::find($id);
        if($user->delete()){ //returns a boolean
            return response()->json([
                'user'=> "mabrouk"
            ],200);
        }
        else
        {
            return response()->json([
                'user'=>'user could not be deleted'
            ],500);
        }
    }
}
