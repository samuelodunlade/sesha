<?php

namespace App\Http\Controllers\Admin;
use App\Models\Secret;
use App\Models\Category;
use App\Models\View;
use App\Models\Vote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SecretController extends Controller
{
    public $expirationOptions = [];
    public function __construct()
    {
        $this->expirationOptions = config('secret_expiration.options');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("admin.secrets.index");
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
        // Mark notification as read
        request()->user()->unreadNotifications()
        ->where('data->secret_id', $id)
        ->update(['read_at' => now()]);
        
        $secret = Secret::where('id', $id)
        ->with(['category', 'votes', 'views'])
        ->firstOrFail();
        return view("admin.secrets.show", [
            'secret' => $secret,
            "expirationOptions" => $this->expirationOptions
        ]);
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
        
        $request->validate([
            'lifecycle' => 'required|in:'.implode(',', array_keys($this->expirationOptions))
        ]);
        

        Secret::findOrFail($id)->update(["expires_at" =>  config('secret_expiration.durations')[$request->lifecycle]]);

        return redirect()->back()->with("success", "Secret Lifecycle extended by ". $request->lifecycle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
