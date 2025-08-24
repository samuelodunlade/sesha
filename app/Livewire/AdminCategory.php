<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class AdminCategory extends Component
{
    use WithFileUploads, WithPagination;
    //pagination
    protected $paginationTheme = 'bootstrap';

    //properties 
    public $title;
    public $cover_image;
    public $description;
    public $slug;
    public $status=true;

    public $editMode=false;
    public $categoryId;
    public $search = '';

    protected $rules = [
        'title' => 'required|min:3|unique:categories,title',
        'cover_image' => 'required|image|max:2048',
        'description' => 'nullable|string'
    ];

    // load the data
    public function mount()
    {
        $this->loadCategories();
    }


    // save category
    public function saveCategory()
    {
        $this->validate();

        $imagePath = $this->cover_image->store('categories', 'public_path');

        Category::create([
            'title' => $this->title,
            'description' => $this->description,
            'cover_image' => $imagePath,
            'status' => $this->status==true?"active":"inactive",
            'slug' => Str::slug($this->title)
        ]);

        $this->resetForm();
        $this->loadCategories();
        session()->flash('message', 'Category created successfully.');
    }

    //load categories
    public function loadCategories()
    {
        $query = Category::query();
        
        if ($this->search) {
            $query->where('title', 'like', '%'.$this->search.'%')
            ->orWhere('description', 'like', value: '%'.$this->search.'%');
        }
        
        return $query->orderByDesc("id") ->paginate(10);
    }
    //update  search
    public function updatedSearch()
    {
        $this->loadCategories();
    }

    //edit category 
    public function edit($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $this->categoryId = $categoryId;
        $this->title = $category->title;
        $this->description = $category->description;
        $this->status = $category->status;
        $this->editMode = true;
    }

    //update category
    public function updateCategory()
    {
        $this->validate([
            'title' => 'required|min:3|unique:categories,title,'.$this->categoryId,
            'cover_image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($this->categoryId);
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status==true?"active":"inactive",
        ];

        if ($this->cover_image) {
            // Delete old image
            Storage::disk('public')->delete($category->cover_image);
            $data['cover_image'] = $this->cover_image->store('categories', 'public_path');
        }

        $category->update($data);

        $this->resetForm();
        $this->loadCategories();
        session()->flash('message', 'Category updated successfully.');
    }


    //toggle category status
    public function toggleStatus($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->status = $category->status == 'active' ? 'inactive' : 'active';
        $category->save();
        $this->loadCategories();
    }

    //delete category
    public function deleteCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        if($category->cover_image){
            // Delete image file
            Storage::disk('public')->delete($category->cover_image);
        }
        $category->delete();
        $this->loadCategories();
        session()->flash('message', 'Category deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin-category', [
            'categories' => $this->loadCategories(),
        ]);
    }

    //reset form
    public function resetForm()
    {
        $this->reset([
            'title',
            'description',
            'cover_image',
            'status',
            'editMode',
            'categoryId'
        ]);
    }

    
    public function showSearch(){
        dd($this->search);
    }

}
