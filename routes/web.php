<?php


use App\Models\Page;
use App\Models\Permision;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\SeoController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PermissionController;
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

Route::get('/',[App\Http\Controllers\Frontend\HomeController::class,'index'])->name('frontend.home');
Route::get('/contact',[App\Http\Controllers\Frontend\PostController::class,'contactUs'])->name('frontend.contact');
Route::post('/contact',[App\Http\Controllers\Frontend\PostController::class,'sendContactUs'])->name('frontend.contactus');
Route::get('/search',[App\Http\Controllers\Frontend\PostController::class,'searchList'])->name('frontend.search');
Route::get('/{slug}',[App\Http\Controllers\Frontend\PostController::class,'newsList'])->name('frontend.newslist');
Route::get('/detail/{id}',[App\Http\Controllers\Frontend\PostController::class,'newsDetail'])->name('frontend.newsdetail');
Route::get('/author/{id}',[App\Http\Controllers\Frontend\PostController::class,'authorList'])->name('frontend.authorpost');
Route::get('/page/{slug}',[App\Http\Controllers\Frontend\PostController::class,'pageList'])->name('frontend.pagelist');


Route::group(['middleware' => ['auth', 'check.published']], function () {

Route::prefix('cms')->group(function () {

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('backend.home');

// Route::get('/dashboard', function () {
//     return view('layouts.dashboard');
// });

Route::resource('post', PostController::class);
Route::post('post/toggle/{post}', [PostController::class,'togglePublished'])->name('post.toggle');

Route::resource('category', CategoryController::class);
Route::post('category/toggle/{category}', [CategoryController::class,'togglePublished'])->name('category.toggle');

Route::resource('author',AuthorController::class);
Route::post('author/toggle/{author}', [AuthorController::class,'togglePublished'])->name('author.toggle');

Route::get('page', [PageController::class, 'index'])->name('page');
Route::get('fetch-page', [PageController::class, 'fetchpage']);
Route::post('page', [PageController::class,'store'])->name('page.store');
Route::get('edit-page/{id}', [PageController::class, 'edit'])->name('page.edit');
Route::put('update-page/{id}', [PageController::class, 'update'])->name('page.update');
Route::delete('delete-page/{id}', [PageController::class, 'destroy'])->name('page.delete');
Route::post('page/toggle/{page}', [PageController::class,'togglePublished'])->name('page.toggle');

Route::resource('user', UserController::class);
Route::post('user/toggle/{user}', [UserController::class,'togglePublished'])->name('user.toggle');

Route::resource('role',RoleController::class);

Route::resource('permision',PermissionController::class);

Route::get('fields', [SeoController::class, 'index'])->name('fields.index');
Route::get('create-fields', [SeoController::class, 'create'])->name('fields.create');
Route::post('store-fields', [SeoController::class, 'store'])->name('fields.store');
Route::post('store-value-fields', [SeoController::class, 'storeValue'])->name('fields.store.value');
Route::delete('delete-fields/{id}', [SeoController::class, 'destroy'])->name('fields.destroy');


} );

});
