<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shisha\ShishaController AS ShishaMain;
use App\Http\Controllers\Shisha\PagesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SecretController as SecretControllerAdmin;
use App\Http\Controllers\Admin\TagController as TagControllerAdmin;
use App\Http\Controllers\Admin\ProfileController as ProfileControllerAdmin;

// Shisha routes
// shisha index
Route::get("/", [ShishaMain::class, "index"])->name("shisha.index");

// shisha timeline
Route::get("/secrets", [ShishaMain::class, "timeline"])->name("shisha.timeline");

// shisha terms and condition
Route::get("/terms-and-condition", [PagesController::class, "terms"])->name("shisha.terms");

// shisha policy
Route::get("/policy", [PagesController::class, "policy"])->name("shisha.policy");

// shisha by cat
Route::get("/secrets/category/{cat_name}", [ShishaMain::class, "bycategory"])->name("shisha.bycategory");

// secret by tag
Route::get("/secrets/tag/{tag_slug}", [ShishaMain::class, "bytagname"])->name("shisha.bytagname");


// shisha creation page
Route::middleware(['throttle:post_submit'])->group(function () {
   Route::get("/secrets/share", [ShishaMain::class, "create"])->name("shisha.create"); 
});


// secret detail page
Route::get("/secrets/{secret:slug}", [ShishaMain::class, "show"])->name("shisha.show");


//admin routes

// category management page

Route::prefix("/admin/")->middleware(['auth', 'verified', 'onlyAdmin'])->group(function(){
    Route::get("categories", [CategoryController::class, "index"])->name("admin.categories");

    Route::get("secrets/{id}/show", [SecretControllerAdmin::class, "show"])->name("admin.secrets.show");

    Route::patch("secrets/{id}/update", [SecretControllerAdmin::class, "update"])->name("admin.secrets.update");

    Route::get("secrets", [SecretControllerAdmin::class, "index"])->name("admin.secrets.index");


    // tags management routes
    Route::get("/tags", [TagControllerAdmin::class, "index"])->name("admin.tags.index");
    Route::get("/tags/create", [TagControllerAdmin::class, "create"])->name("admin.tags.create");
    Route::post("/tags/store", [TagControllerAdmin::class, "store"])->name("admin.tags.store");
    Route::get("/tags/{tag}/edit", [TagControllerAdmin::class, "edit"])->name("admin.tags.edit");
    Route::patch("/tags/{tag}/update", [TagControllerAdmin::class, "update"])->name("admin.tags.update");
    Route::delete("/tags/{tag}/destroy", [TagControllerAdmin::class, "destroy"])->name("admin.tags.destroy");

    // recalculate secret count for each category
    Route::post("/categories/recalculate", [CategoryController::class, "recalculate"])->name("admin.categories.recalculate");
    //records management page
    

    // admin profile update
    //show admin profile page route
    Route::get("/profile/show", [ProfileControllerAdmin::class, "show"])->name("admin.profile.show");
     Route::patch("/profile/update", [ProfileControllerAdmin::class, "update"])->name("admin.profile.updatePicture");

    // admin.profile.updatePicture


});
