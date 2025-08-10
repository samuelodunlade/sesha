<?php

namespace App\Http\Controllers\Shisha;
use App\Models\Secret;
use App\Models\Category;
use App\Models\Tag;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShishaController extends Controller
{
    //
    public function index(){
        
        //fetch all secrets using all these criteria: is_editor_choice, expires_at, deleted_at, is_blocked

        $secrets = Secret::with('category') // Eager load category relationship
            ->where('is_editor_choice', true)
            ->where('is_blocked', false)
            ->where(function($query) {
                $query->whereNull('deleted_at');
            })
            ->where(function($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', Carbon::now());
            })
            ->orderByDesc('views')->orderBy("id")->simplePaginate(10); 

        return view("shisha_frontend.index", [
            'secrets' => $secrets
        ]);

    }

    public function create(){
        return view("shisha_frontend.create");
    }

    public function timeline(){
        return view("shisha_frontend.timeline");
    }

    public function bycategory($categoryname){
        //fetch all secrets using all these criteria:  expires_at, deleted_at, is_blocked that belong to the category whose slug was passed
        $category = Category::where('slug', $categoryname)->first();
        if (!$category) {
            abort(404);
        }
        //check if category status is inactive and send 404
        if (!$category->status) {
            abort(404, 'This category is currently not available');
        }
        //count the number of secrets in the category and update the secret_count column in the category table
        // $category->secret_count = $category->secrets()->where('is_blocked', false)
        //     ->where(function($query) {
        //         $query->whereNull('deleted_at');
        //     })
        //     ->where(function($query) {
        //         $query->whereNull('expires_at')
        //             ->orWhere('expires_at', '>', Carbon::now());
        //     })
        //     ->count();
        // $category->save();
        $secrets = Secret::with('category') // Eager load category relationship
            ->where('is_blocked', false)
            ->where(function($query) {
                $query->whereNull('deleted_at');
            })
            ->where(function($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', Carbon::now());
            })
            ->where('category_id', $category->id)
            ->orderByDesc('views')->orderBy("id")->simplePaginate(10);  
        return view("shisha_frontend.bycategory", [
            'secrets' => $secrets,
            'category' => $category
        ]);
    }

    //fetch secrets bytagname
    public function bytagname($tag_slug){
        //get the specific tag
        $tag = Tag::where('slug', $tag_slug)->first();
        if (!$tag) {
            abort(404);
        }

        //check if tag status is inactive and send 404
        if (!$tag->status) {
            abort(404, 'This tag is currently not available');
        }

        
        return view("shisha_frontend.bytags", [
            'tag' => $tag
        ]);



    }

    //secret detail using slug via route model binding
    public function show($slug){
        //fetch secret using all these criteria:  expires_at, deleted_at, is_blocked that belong to the category whose slug was passed
        $secret = Secret::with('category') // Eager load category relationship
            ->where('is_blocked', false)
            ->where(function($query) {
                $query->whereNull('deleted_at');
            })
            ->where(function($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', Carbon::now());
            })
            ->where('slug', $slug)
            ->firstOrFail();  
        
        
        //check if secret id and ip_address already exists in the views table
        $viewed = $secret->views()->where('ip_address', request()->ip())->first();
        if (!$viewed) {
                    // increment views  on the secret table 
            $secret->increment('views');
            // and also add it to views table
            $secret->views()->create([
                'ip_address' => request()->ip(),
                'secret_id' => $secret->id
            ]);
        }


        return view("shisha_frontend.show", [
            'secret' => $secret
        ]);
    }



}
