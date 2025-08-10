<?php

namespace App\Http\Controllers\Admin;
use App\Models\Secret;
use App\Models\Category;
use App\Models\Tag;
use App\Models\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function home(){
        //count all secrets
        $secrets = Secret::count();
        //count all categories
        $categories = Category::count();
        //count all tags
        $tags = Tag::count();
        //count all views from views table
        $views = View::count();

        return view('admin.dashboard', [
            "secrets" => $secrets,
            "categories" => $categories,
            "tags" => $tags,
            "views" => $views,
        ]);
    }

    // records: top five most viewd secrets, most liked secrets, most disliked secrets
    public function records(){
        //top five most viewed secrets
        $most_viewed = Secret::withCount('views')->orderBy('views_count', 'desc')->take(5)->get();
        //most liked secrets
        $most_liked = Secret::orderBy('upvotes', 'desc')->take(5)->get();
        //most disliked secrets
        $most_disliked = Secret::orderBy('downvotes', 'desc')->take(5)->get();

        return view('admin.records', [
            "most_viewed" => $most_viewed,
            "most_liked" => $most_liked,
            "most_disliked" => $most_disliked,
        ]);
    }



}
