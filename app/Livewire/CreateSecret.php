<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Secret;  
use App\Models\Category;
use Str;
use App\Notifications\SecretCreated;
use App\Models\User;

class CreateSecret extends Component
{

    // form properties 
    public $title = ""; 
    public $summary = ""; 
    public $category = ""; 
    public $content = ""; 
    public $lifecycle = ""; 
    public $random_title = ""; // Random title

    public $expiration = '1_day'; // Default expiration
    public $expirationOptions;
    public $expires_at;


        public function mount()
    {
        $this->expirationOptions = config('secret_expiration.options');
    }
    //validation

    public function render()
    {
        //get all categories
        $categories = Category::where('status', "active")->get();
        return view('livewire.create-secret', [
            'categories' => $categories,
        ]);
    }


    public function save(){
        //validation
        $this->validate([
            'random_title' => 'nullable|max:0',
            'title' => 'required|min:10',
            'summary' => 'required|min:20',
            'category' => 'required',
            'content' => 'required|min:50|max:10000',
            'lifecycle' => 'required|in:'.implode(',', array_keys($this->expirationOptions)),
        ]);
        $ip_address = request()->ip();
       $result =  Secret::create([
            "title" => $this->title,
            "summary" => $this->summary,
            "category_id" => $this->category,
            "content" => $this->content,
            "expires_at" => config('secret_expiration.durations')[$this->lifecycle],
            "slug" => \Illuminate\Support\Str::slug($this->title).'-'.uniqid(),
            "ip_address" => $ip_address,
        ]);
        

        // Notify admin of new secret
        $admins = User::where('role', "admin")->get();
        foreach ($admins as $admin) {
            $admin->notify(new SecretCreated($result));
        }

        if($result){
            session()->flash('message', 'Secret submitted successfully.');
            $this->resetForm();
        }else{
            session()->flash('error', 'Error submitting secret.');
        }


    }




    public function resetForm()
    {
        $this->reset([
            'title',
            'summary',
            'category',
            'content',
            'lifecycle',
            'random_title'
        ]);
    }


}
