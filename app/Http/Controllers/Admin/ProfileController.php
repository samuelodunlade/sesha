<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function show(){

        return view("admin.profile.index");
    }

    public function update(Request $request){

        $request->validate([
            "picture" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);

        $user = auth()->user();
       

        if($request->hasFile("picture")){
            // If the user has a previous picture, delete it
            if ($user->getOriginal("display_picture")) {
            $previousPicture = $user->getOriginal("display_picture");
                if (file_exists(public_path("storage/" . $previousPicture))) {
                    unlink(public_path("storage/" . $previousPicture));
                }
            }

            $path = $request->file("picture")->store("profile_pictures", "public");
            $user->display_picture = $path;
            $user->save();
        }
        
        
        return redirect()->route("admin.profile.show")->with("success", "Profile picture updated successfully.");;

    }


}
