<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Hash;

class UserController extends Controller
{

    public function getAllPosts()
    {
        return User::select('id','name','email')
            ->with(['posts'=>function($q){
                $q->select('id','title','user_id')->active();
            }])
            ->get();
    }

    public function doLogin(Request $request){

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    return Auth::user();           
        }else{
            throw new \Exception("Não foi possível realizar o login. Tente novamente.");
        }
    }

    public function doLogout(){
        Auth::logout();
        return Auth::user(); //tem q ser nulo
    }

    public function getLogin(){
        return Auth::user();
    }

    public function createLogin(Request $request){

        $theUser = User::where('email','=', $request->email)->first();
        if ($theUser)
           throw new \Exception("Este email já está cadastrado");
            
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        Auth::login($user);

        return Auth::user();
    }

     public function saveFromRequest(Request $request){

        $user = null;
        if ($request->id){ //edit
            $user=User::find($request->id);
        }else{ //new
            $user = new User();
        }
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password){
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return $user;

    }

    public function index()
    {
        return User::get();
    }

    public function show($id)
    {
        return User::find($id);
    }

}
