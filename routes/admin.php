<?php

use App\Http\Controllers\Admin\SettingsController;
use App\Livewire\Admin\CommissionPercentage;
use App\Livewire\Admin\Contact as AdminContact;
use App\Livewire\Admin\Currencies;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\FeatureSellers;
use App\Livewire\Admin\ManageCategories;
use App\Livewire\Admin\ManageOrders;
use App\Livewire\Admin\ManageProducts;
use App\Livewire\Admin\ManageSellers;
use App\Livewire\Admin\ManageUsers;
use App\Livewire\Admin\Report;
use App\Livewire\Admin\SellerPayouts;
use App\Livewire\Admin\ViewSeller;
use App\Livewire\Admin\ViewUser;
use App\Livewire\Admin\weightMetrics;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
// });

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('dashboard/', Dashboard::class)->name('dashboard');

    Route::get('categories/', ManageCategories::class)->name('categories');
    Route::get('weight-metrics', weightMetrics::class)->name('weightMetrics');
    Route::get('currencies', Currencies::class)->name('currencies');
    Route::get('settings', App\Livewire\Admin\Settings\Index::class)->name('settings');
    Route::get('/products', ManageProducts::class)->name('products');
    Route::get('/users', ManageUsers::class)->name('users');
    Route::get('/user/{id}', ViewUser::class)->name('user.view');
    Route::get('/sellers', ManageSellers::class)->name('sellers');
    Route::get('/seller/{id}', ViewSeller::class)->name('seller.view');
    Route::get('/seller/payouts/{id}', SellerPayouts::class)->name('seller.payouts');

    Route::get('/orders', ManageOrders::class)->name('orders');
    Route::get('/contacts', AdminContact::class)->name('contacts');
    Route::get('/feature/sellers', FeatureSellers::class)->name('feature.sellers');
    Route::get('/Commission-percentage', CommissionPercentage::class)->name('commission.percentage');
    Route::get('/reports', Report::class)->name('reports');


});

