<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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

    public function last($n=3){
        return Comment::select('id','text','post_id')
            ->active()
            ->orderBy('id', 'desc')
            ->with(['post'=>function($q){
                $q->select('id','title');
            }])
            ->take($n)
            ->get();
    }

    public function getAll(){
          return Comment::select('id','text','email','post_id')
            ->active()
            ->orderBy('id', 'desc')
            ->with(['post'=>function($q){
                $q->select('id','title');
            }])
            ->get();
    }

    public function getCommentsByPost($id){
        return Comment::select('*')
            ->where('post_id','=',$id)
            ->get();
    }

    public function save(Request $request){

        $comment = null;
        if ($request->id){ //edit
            $comment=Comment::find($request->id);
        }else{ //new
            $comment = new Comment();
        }
        $comment->text = $request->text;
        $comment->active = $request->active;
        $comment->email = $request->email;
        $comment->save();
        return $comment;

    }
}
