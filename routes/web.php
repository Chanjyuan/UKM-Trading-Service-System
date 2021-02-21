<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PaymentController;

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/catalog', [App\Http\Controllers\HomeController::class, 'catalog'])->name('posts.catalog');
Route::get('/category/{id}', [App\Http\Controllers\HomeController::class, 'showCates']);
/**
Route::get('/changepassword', 'ProfileController@changePasswordForm')->name('changepassword');
Route::post('/changepassword', 'ProfileController@changePassword')->name('changepassword');
**/
Route::get('/changepassword', [App\Http\Controllers\ChangePasswordController::class, 'changePasswordForm'])->name('changepassword');
Route::post('/changepassword', [App\Http\Controllers\ChangePasswordController::class, 'changePassword'])->name('changepassword');

Route::resources(['posts'=> PostsController::class,]);
Route::resource('posts.offers', OffersController::class);

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'profile'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');
Route::get('/review/{user}', [App\Http\Controllers\ProfilesController::class, 'review']);
Route::get('/offers/{user_id}', [App\Http\Controllers\OffersController::class, 'myOffers']);
Route::get('/offers/{user_id}/receive', [App\Http\Controllers\OffersController::class, 'receivedOffers']);
Route::get('/offers/{offer_id}/approve', [App\Http\Controllers\OffersController::class, 'approveOffer']);
Route::get('/offers/{offer_id}/reject', [App\Http\Controllers\OffersController::class, 'rejectOffer']);
Route::get('users/notifications', [App\Http\Controllers\UsersController::class, 'notifications'])->name('users.notifications');

Route::get('/admin-dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/category', [App\Http\Controllers\CategoriesController::class, 'index'])->name('admin.category.index');
Route::get('/{id}/editcategory', [App\Http\Controllers\CategoriesController::class, 'edit'])->name('admin.category.edit');
Route::resources(['categories'=> CategoriesController::class,]);

Route::post('/add-to-cart', [App\Http\Controllers\PostsController::class, 'addtocart']);
Route::get('/cart', [App\Http\Controllers\PostsController::class, 'cart'])->name('posts.cart');
Route::post('/delete-cart-item', [App\Http\Controllers\PostsController::class, 'deleteCartItem']);

Route::get('/search',[App\Http\Controllers\HomeController::class, 'search']);

Route::get('/accounts', [App\Http\Controllers\ProfilesController::class, 'index'])->name('admin.profile.index');
// Route::get('/{id}/editaccount', [App\Http\Controllers\ProfilesController::class, 'adminedit'])->name('admin.profile.edit');
// Route::patch('/accounts/{id}', [App\Http\Controllers\ProfilesController::class, 'adminupdate'])->name('admin.profile.update');
Route::resources(['profiles'=> ProfilesController::class,]);

Route::get('/contacts',  [App\Http\Controllers\ContactsController::class, 'get']);
Route::get('/conversation/{id}', [App\Http\Controllers\ContactsController::class, 'getMessagesFor']);
Route::post('/conversation/send', [App\Http\Controllers\ContactsController::class, 'send']);
Route::get('/chat',  [App\Http\Controllers\ContactsController::class, 'chat']);

Route::resources(['payment'=> PaymentController::class]);