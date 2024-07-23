<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductStat;
use App\Models\Report as ModelsReport;
use App\Models\Review;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Report extends Component
{
    
    public $reportDeleteId;
    public $reportDetails;
    public $confirmingDeletionModal = false;
    public $viewReport = false;
    public $statusChangeInfo = ['approved' => 0, 'productId' => 0];
    public $changeStatusModal = false;

    public $statusChangeInfoReview = ['approved' => 0, 'reviewId' => 0];
    public $changeStatusReviewModal = false;


    #[Layout('layouts.app')]
    public function render()
    {
        $reports = ModelsReport::latest()->paginate(10);
        return view('livewire.admin.report', ['reports' => $reports]);
    }

    public function viewReports($id){

        $this->reportDetails = ModelsReport::find($id);
        $this->viewReport = true;
    }

    public function deleteReport($id){
        $this->reportDeleteId = $id;
        $this->confirmingDeletionModal = true;
    }

    public function delete()
    {
        $id = $this->reportDeleteId;
        $report = ModelsReport::find($id);
        $report->delete();

        $this->reset('reportDeleteId', 'confirmingDeletionModal');
        session()->flash('success', 'Report deleted successfully.');
    }


    // for product

    public function confirmChangeStatus($id, $approved)
    {
        $this->statusChangeInfo['approved'] = !$approved;
        $this->statusChangeInfo['productId'] = $id;
        $this->changeStatusModal = true;
    }

    public function updateStatus()
    {
        $product = Product::findOrFail($this->statusChangeInfo['productId']);
        $product->approved = $this->statusChangeInfo['approved'];
        $product->save();

        $this->reset('statusChangeInfo', 'changeStatusModal');
        session()->flash('success', 'Product status has been updated successfully!');
    }

    // for review

    public function confirmChangeReviewStatus($id,$approved){
        $this->statusChangeInfoReview['approved'] = !$approved;
        $this->statusChangeInfoReview['reviewId'] = $id;
        $this->changeStatusReviewModal = true;
    }

    public function updateReviewStatus(){

        $review = Review::findOrFail($this->statusChangeInfoReview['reviewId']);
        $review->is_approved = $this->statusChangeInfoReview['approved'];
        $review->save();

        $businessStat = ProductStat::firstOrNew(['product_id' => $review->product->id]);

        $reviews = Product::findOrFail($review->product->id)->reviews;
        $reviewsCount = $reviews->count();
        $avgRating = $reviews->avg('rating') ?? 0;
        $positiveReviewsCount = $reviews->where('rating', '>=', 3)->count();
        $negativeReviewsCount = $reviewsCount - $positiveReviewsCount;

        // Save business stats
        $businessStat = ProductStat::firstOrNew(['product_id' => $review->product->id]);
        $businessStat->reviews_count = $reviewsCount;
        $businessStat->avg_rating = $avgRating;
        $businessStat->positive_reviews_count = $positiveReviewsCount;
        $businessStat->negative_reviews_count = $negativeReviewsCount;

        $businessStat->save();

        $this->reset('statusChangeInfoReview', 'changeStatusReviewModal');
        session()->flash('success', 'Review status has been updated successfully!');
    }
}
