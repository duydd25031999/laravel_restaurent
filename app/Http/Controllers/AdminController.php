<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $data = User::all();
        return view("admin.user", compact("data"));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }

    public function foodMenu()
    {
        $data = Food::all();
        return view("admin.foodmenu", compact("data"));
    }

    public function deletemenu($id)
    {

        $data = food::find($id);

        $data->delete();

        return redirect()->back();
    }

    public function upload(Request $request)
    {

        $data = new food;


        $image = $request->image;


        $imagename = time() . '.' . $image->getClientOriginalExtension();

        $request->image->move('foodimage', $imagename);

        $data->image = $imagename;


        $data->title = $request->title;

        $data->price = $request->price;

        $data->description = $request->description;

        $data->save();

        return redirect()->back();
    }
}
