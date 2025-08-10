<?php

namespace App\Http\Controllers\Admin;
use App\Models\Secret;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.categories.categories");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function recalculate()
    {
        // recalculate secret count for each category
        $categories = \App\Models\Category::all();
        foreach ($categories as $category) {
            //only count secrets that are not deleted, expires_at is null or greater than now, is_blocked  is false
            $sec_count = Secret::where("category_id", $category->id)
                ->where("deleted_at", null)
                ->where(function ($query) {
                    $query->where("expires_at", null)
                        ->orWhere("expires_at", ">", now());
                })
                ->where("is_blocked", false)
                ->count();

            $category->secret_count = $sec_count;
            $category->save();
        }

        return redirect()->back()->with("success", "Secret count for categories recalculated successfully.");  

    }
}
