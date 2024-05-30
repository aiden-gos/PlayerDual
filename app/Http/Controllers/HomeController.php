<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        $user = User::query();

        if(!empty($request->query("name"))){

            $user->where('name', 'like', '%'.$request->query('name').'%');
        }
        if($request->query("sex") == "1" || $request->query("sex") == "0"){
            $user->where("sex",$request->query("sex"));
        }
        if(!empty($request->query("priceMin"))){
            $user->where("price" ,">", $request->query("priceMin"));
        }
        if(!empty($request->query("priceMax"))){
            $user->where("price","<", $request->query("priceMax"));
        }
        $reslut = $user->get();
        return response()->json($reslut, 200);
    }
}
