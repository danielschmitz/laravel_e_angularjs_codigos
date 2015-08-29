<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class BlogController extends Controller
{
    public function getMenuInfo(){
        $tagController = new TagController();
        $commentController = new CommentController();
        $authUser = Auth::user();
        return array($tagController->getAll(),$commentController->last(),$authUser);
    }
}
