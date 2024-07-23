<?php

namespace App\Livewire\Front;

use App\Models\Category;
use App\Models\Product;
use App\Models\SellerAccount;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


class SellerDetails extends Component
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
    public $seller;

    public function mount($title = null)
    {
        if($title){
            $modifiedTitle = str_replace('-', ' ', $title);
            $this->seller = SellerAccount::where('username', $modifiedTitle)->first();
            if(!$this->seller){
                return redirect('/');
            }
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
        // Handle logic when minPrice changes
    }

    public function updatedMaxPrice()
    {
        // Handle logic when maxPrice changes
    }

    public function updatePrices()
    {
        // dd($this->minPrice  . ' ' . $this->maxPrice);
    }


    public function updatedStartDateFilter($value)
    {
        if ($value === null || $value === 'Invalid date') {
            $this->startDateFilter = null;
        }
    }

    public function updatedEndDateFilter($value)
    {
        if ($value === null || $value === 'Invalid date') {
            $this->endDateFilter = null;
        }
    }

    #[Layout('layouts.web')]
    public function render()
    {

        $categories = Category::get();

        $products = Product::with(['attachments', 'seller', 'category', 'stockMetric', 'priceMetric'])
        ->where('seller_account_id',$this->seller->id)
        ->where('approved',1)
        ->when($this->category, function ($query, $category) {
            return $query->where('category_id', $category->id);
        })        ->when($this->productNameFilter, function ($query, $productNameFilter) {
            return $query->where('title', 'like', '%' . $productNameFilter . '%');
        })
        ->when($this->minPrice, function ($query) {
            return $query->where('price', '>=', $this->minPrice);
        })
        ->when($this->maxPrice, function ($query) {
            return $query->where('price', '<=', $this->maxPrice);
        })
        ->when($this->startDateFilter && $this->endDateFilter && $this->startDateFilter != $this->endDateFilter, function ($query) {
            return $query->whereBetween('available_date', [$this->startDateFilter, $this->endDateFilter]);
        })
        
        ->paginate(20);

        return view('livewire.front.seller-details',['categories'=>$categories,'products' => $products]);
    }
}
