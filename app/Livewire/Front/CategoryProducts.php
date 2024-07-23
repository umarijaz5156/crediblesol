<?php

namespace App\Livewire\Front;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;


class CategoryProducts extends Component
{

    use WithPagination;

    public $category;
    public $productNameFilter,$categoryFilter;
    public $priceRangeFilter;
    public $minPrice = 0;
    public $maxPrice = 1000;

    public $setMinPrice = 0;
    public $setMaxPrice = 1000;
    
    public $dateRangeFilter;
    public $startDateFilter;
    public $endDateFilter;


    public function mount($title = null)
    {
        if($title){
            $modifiedTitle = str_replace('-', ' ', $title);
            $this->category = Category::where('title', $modifiedTitle)->first();
        }else{
            $this->category = null;
        }
    }

    public function categoryChanged($categoryId)
    {
        $this->category = Category::where('id', $categoryId)->first();
      
    }

    public function updatingProductNameFilter()
    {
        $this->resetPage();
    }
    public function updatedMinPrice()
    {
    }

    public function updatedMaxPrice()
    {
    }

    public function updatePrices()
    {
    }



    #[Layout('layouts.web')]
    public function render()
    {
       
        $categories = Category::get();

        $products = Product::with(['attachments', 'seller', 'category', 'stockMetric', 'priceMetric'])
        ->where('approved',1)
        ->when($this->category, function ($query) {
            $query->where('category_id', $this->category->id);
        })
        ->when($this->productNameFilter, function ($query, $productNameFilter) {
            $query->where('title', 'like', '%' . $productNameFilter . '%');
        })
        ->when($this->minPrice, function ($query) {
            $query->where('price', '>=', $this->minPrice);
        })
        ->when($this->maxPrice, function ($query) {
            $query->where('price', '<=', $this->maxPrice);
        })
        ->when($this->startDateFilter && $this->endDateFilter && $this->startDateFilter != $this->endDateFilter, function ($query) {
            $query->whereBetween('available_date', [$this->startDateFilter, $this->endDateFilter]);
        })
        ->latest()
        ->paginate(20);
        
        return view('livewire.front.category-products', ['categories'=>$categories, 'products' => $products]);

    }
}
