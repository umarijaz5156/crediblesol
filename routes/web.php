<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SetupController;
use App\Livewire\Chat\Index;
use App\Livewire\Front\CategoryProducts;
use App\Livewire\Front\Chat;
use App\Livewire\Front\Checkout;
use App\Livewire\Front\ContactUs;
use App\Livewire\Front\CreateSeller;
use App\Livewire\Front\Home;
use App\Livewire\Front\ProductDetails;
use App\Livewire\Front\Register;
use App\Livewire\Payment\Payment;
use App\Livewire\Payment\PaymentSuccess;
use App\Livewire\Seller\Chat\Index as ChatIndex;
use App\Livewire\Seller\Dashboard;
use App\Livewire\Seller\ManageProducts;
use App\Livewire\Front\Orders;
use App\Livewire\Front\SellerDetails;
use App\Livewire\Front\Sellers;
use App\Livewire\Seller\ManagePayout;
use App\Livewire\Seller\Orders as SellerOrders;
use App\Livewire\Seller\SellerEarning;
use App\Livewire\Seller\SellerInformation;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$installed = Storage::disk('public')->exists('installed');

// if ($installed === false) {
//     Route::get('/setup', App\Livewire\Setup\Check::class)->name('setup.check');
//     Route::post('/setup/last-step', [SetupController::class, 'lastStep'])->name('setup.last-step');
// }

// Route::get('/', function () {
//     $installed = Storage::disk('public')->exists('installed');

//     if ($installed === false) {
//         return redirect()->route('setup.check');
//     }
//     return view('welcome');
// })->name('home');

Route::get('/setup/finish', function () {
    $redirect = route('home');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return view('setup-complete', compact('redirect'));
})->name('setup.finish');


Route::get('/logout-user', function () {
    Auth::logout();
    return redirect('/');
})->name('logout-user');


// payTech
Route::get('/payment', Payment::class)->name('payment');
Route::get('payment-success/{code?}', [PaymentController::class, 'success'])->name('payment.success');
Route::get('payment-cancel/{code?}', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/callback/{code?}', [PaymentController::class, 'callback'])->name('payment.callback');


// orange money
Route::get('sendPayment', [PaymentController::class, 'sendPayment'])->name('send.payment');

Route::get('/set-default-lang/{locale}', function ($locale) {
    if (setDefaultLang($locale)) {
        return redirect()->back();
    }
    return redirect()->back();
})->name('set-default-lang'); 

// seller
Route::group(['middleware' => ['auth', 'web']], function () {


    Route::group(['prefix' => 'seller', 'middleware' => ['user.is_seller']], function () {
        Route::get('/dashboard', Dashboard::class)->name('seller.dashboard');
        Route::get('/information', SellerInformation::class)->name('seller.information');

        Route::group(['middleware' => ['seller.approved']], function () {
            Route::get('/products', ManageProducts::class)->name('seller.products');
            Route::get('/orders', SellerOrders::class)->name('seller.orders');
            Route::get('/chats/{id?}', ChatIndex::class)->name('seller.chats');
            Route::get('/payouts', ManagePayout::class)->name('seller.payout');
            Route::get('/earning', SellerEarning::class)->name('seller.earning');

        });

        Route::get('/profile/edit', function () {
            return view('profile.show-seller');
        })->name('seller.profile.edit');

    });


    // user
    Route::get('/profile/edit', function () {
        return view('profile.show-user');
    })->name('user.profile.edit');

    Route::get('/chats/{id?}', Index::class)->name('buyer.chats');
    Route::get('/orders', Orders::class)->name('buyer.orders');




});

Route::get('/', Home::class)->name('home');
Route::get('/register', Register::class)->name('register');

Route::get('/products/{title}-{id}', ProductDetails::class)->name('products.show');
Route::get('/category/{title?}', CategoryProducts::class)->name('category.products');
Route::get('/seller-products/{title}', SellerDetails::class)->name('front.seller.products');
Route::get('/sellers', Sellers::class)->name('sellers');
Route::get('/checkout', Checkout::class)->name('checkout');
Route::get('/seller-account/create', CreateSeller::class)->name('create.seller');
Route::get('/contact-us', ContactUs::class)->name('contactUs');


Route::get('/privacy-policy', function () {
    return view('policy');
})->name('privacy-policy');

Route::get('/terms-and-conditions', function () {
    return view('terms');
})->name('terms');

Route::get('/about-us', function () {
    return view('about');
})->name('about');





