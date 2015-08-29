<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Tag::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Tag::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function save(Request $request){

        $tag = null;
        if ($request->id){ //edit
            $tag=Tag::find($request->id);
        }else{ //new
            $tag = new Tag();
        }
        $tag->title = $request->title;
        $tag->save();
        return $tag;

    }

    public function getAll(){
        return Tag::select('id','title')->get();
    }

    public function getAllwithPosts(){
        return Tag::select('id','title')
        ->with(['posts'=>function($q){
            $q->select('id','title')->active();
        }])
        ->get();
    }
}
