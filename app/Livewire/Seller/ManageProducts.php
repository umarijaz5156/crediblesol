<?php

namespace App\Livewire\Seller;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\User;
use App\Models\WeightMetric;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;


use Livewire\Component;

class ManageProducts extends Component
{

    use WithFileUploads;

    public $createUpdateModel = false;
    public $productEditId;

    public $weightMetrics = [];
    public $categories;
    public $selectedCategory = null;
    public $subCategories;


    #[Validate]
    public $price;
    #[Validate]
    public $title;
    #[Validate]

    public $available_date;
    #[Validate]

    public $description;
    #[Validate]

    public $stock;
    #[Validate]

    public $stock_metric;
    #[Validate]

    public $price_metric;
    #[Validate]

    public $category_id;

    public $previousImage;
    #[Validate]

    public $attachments = [];


    public $product_id;
    public $productDeleteId;
    public $confirmingDeletionModal = false;
    public $viewModel = false;
    public $product;


    protected $rules = [
        'title' => ['required', 'string', 'max:80'],
        'available_date' => ['required', 'date', 'after_or_equal:today'],
        'description' => ['required', 'string'],
        'price' => ['required', 'numeric', 'min:0'],
        'price_metric' => ['required'],
        'stock' => ['required', 'integer', 'min:0'],
        'stock_metric' => ['required'],
        'category_id' => ['required', 'integer'],
        'attachments' => ['required', 'array', 'min:1', 'max:5'],
        'attachments.*' => ['image', 'max:2048'],


    ];

    protected $messages = [
        'title.required' => 'The title field is required.',
        'available_date.required' => 'The available date field is required.',
        'available_date.date' => 'The available date must be a valid date.',
        'available_date.after_or_equal' => 'The available date must be today or a future date.',
        'description.required' => 'The description field is required.',
        'price.required' => 'The price field is required.',
        'price.numeric' => 'The price must be a number.',
        'price.min' => 'The price must not be negative.',
        'stock.required' => 'The stock field is required.',
        'stock.integer' => 'The stock must be an integer.',
        'stock.min' => 'The stock must not be negative.',
        'category_id.required' => 'Please select a category for the product.',
        'stock_metric.required' => 'The Stock Unit field is required.',
        'price_metric.required' => 'The price Unit field is required.',
        'attachments.required' => 'At least one image is required.',
        'attachments.min' => 'At least one image is required.',
        'attachments.max' => 'You can upload up to five images.',
        'attachments.*.image' => 'Each image must be an image file.',
        'attachments.*.max' => 'Each image must not exceed 2MB in size.',
    ];

    public function createUpdateProduct()
    {
        $validatedData = $this->validate();

        $user = User::with('seller')->findOrFail(auth()->id());

        $validatedData['seller_account_id'] = $user->seller->id;
        $product = Product::updateOrCreate(['id' => $this->productEditId], $validatedData);

        if ($this->productEditId) {

            $oldImages = Product::with('attachments')->findOrFail($this->productEditId);

            $newAttachmentFilenames = [];
            foreach ($this->attachments as $attachment) {
                $newAttachmentFilenames[] = $attachment->getClientOriginalName();
            }

            $existingImageFile = $oldImages->attachments->pluck('file_path')->toArray();

            $existingImageFilenames = [];
            foreach ($existingImageFile as $filename) {
                $existingImageFilenames[] = basename($filename);
            }

            foreach ($existingImageFilenames as $existingFilename) {

                if (!in_array($existingFilename, $newAttachmentFilenames)) {
                    $path = 'product_images/' . $existingFilename;
                    ProductImages::where('file_path', $path)->delete();
                    Storage::disk('public')->delete($existingFilename);
                }
            }

        } else {
            $existingImageFilenames = [];
        }

        foreach ($this->attachments as $attachment) {
            $newFilename = $attachment->getClientOriginalName();
            if (!in_array($newFilename, $existingImageFilenames)) {
                $imagePath = $attachment->storeAs('product_images', Carbon::now()->timestamp . '-' . $newFilename, 'public');
                ProductImages::create([
                    'product_id' => $product->id,
                    'file_path' => $imagePath,
                ]);
            }
        }

        $this->createUpdateModel = false;
        session()->flash('success', 'Action performed successfully!');
    }

    public function editProduct($id)
    {
        $this->valueReset();
        $product = Product::with(['attachments', 'category', 'stockMetric', 'priceMetric'])->find($id);
        $this->title = $product->title ?? '';
        $this->available_date = $product->available_date ?? '';
        $this->description = $product->description ?? '';
        $this->price = $product->price ?? '';
        $this->stock = $product->stock ?? '';
        $this->price_metric = $product->price_metric ?? '';
        $this->stock_metric = $product->stock_metric ?? '';
        $this->category_id = $product->category_id ?? '';
        $this->selectedCategory = $product->category_id ?? '';
        $this->previousImage = json_encode($product->attachments);

        $this->productEditId = $id;

        $this->dispatch('updateCkEditorBody');
        $this->dispatch('initReviewEditor');
        $this->createUpdateModel = true;
    }

    public function viewProduct($id)
    {
        $this->valueReset();
        $product = Product::with(['attachments', 'category', 'stockMetric', 'priceMetric'])->find($id);
        $this->product = $product;
        $this->viewModel = true;
    }

    public function deleteProduct($id)
    {
        $this->valueReset();
        $this->productDeleteId = $id;
        $this->confirmingDeletionModal = true;
    }

    public function delete()
    {
        $id = $this->productDeleteId;
        $product = Product::with('attachments')->find($id);

        foreach ($product->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
        }
        $product->attachments()->delete();

        $product->delete();

        $this->reset('productDeleteId', 'confirmingDeletionModal');
        session()->flash('success', 'Product deleted successfully.');
    }

    public function showModal()
    {
        $this->valueReset();
        $this->weightMetrics = WeightMetric::pluck('name', 'id');
        $this->categories = Category::get();
        $this->dispatch('updateCkEditorBody');
        $this->dispatch('initReviewEditor');
        $this->createUpdateModel = true;
    }

    public function updatedPriceMetric($value)
    {
        $this->stock_metric = $value;
    }


    public function valueReset()
    {
        $this->title = '';
        $this->available_date = '';
        $this->description = '';
        $this->price = '';
        $this->stock = '';
        $this->price_metric = '';
        $this->stock_metric = '';
        $this->category_id = '';
        $this->attachments = [];
        $this->productEditId = null;
        $this->productDeleteId = null;
        $this->product_id = null;
        $this->selectedCategory = null;
        $this->previousImage = null;
    }

    public function mount()
    {
        $this->weightMetrics = WeightMetric::pluck('name', 'id');
        $this->categories = Category::get();
    }


    #[Layout('layouts.seller')]

    public function render()
    {
        $seller = Auth::user()->seller;
        $products = Product::with(['attachments', 'category', 'stockMetric', 'priceMetric'])
            ->where('seller_account_id', $seller->id)
            ->latest()
            ->paginate(20);
        return view('livewire.seller.manage-products', ['products' => $products]);
    }
}
