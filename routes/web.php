<?php

use App\Http\Controllers\vendor\Chatify\CustomMessagesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//Route::get('/', function () {
//    return Inertia::render('HomeView', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
Route::get('/post', [\App\Http\Controllers\NewsController::class, 'index'])->name('posts');
Route::get('/post/{post}', [\App\Http\Controllers\NewsController::class, 'show'])->name('post.show');
Route::get('/cabinet', [\App\Http\Controllers\CabinetController::class, 'index'])->name('cabinet');
Route::get('/orders/performer', [\App\Http\Controllers\Orders\PerformerController::class, 'index'])->name('orders.performer');
Route::get('/orders/customer', [\App\Http\Controllers\Orders\CustomerController::class, 'index'])->name('orders.customer');
Route::get('@{username}', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('/payments', [\App\Http\Controllers\PaymentController::class, 'index'])->name('payment');
Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index'])->name('task');
Route::get('/tasks/my', [\App\Http\Controllers\TaskController::class, 'myTask'])->name('my.task');
Route::get('/tasks/create', [\App\Http\Controllers\TaskController::class, 'createTask'])->name('create.task');
Route::post('/tasks/store', [\App\Http\Controllers\TaskController::class, 'storeTask'])->name('store.task');
Route::get('/messages', [\App\Http\Controllers\Messages\MessageController::class, 'index'])->name('messages');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/ap', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('ap');
    Route::resource('/ap/users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('/ap/options', \App\Http\Controllers\Admin\OptionController::class);
    Route::resource('/ap/tasks', \App\Http\Controllers\Admin\TaskController::class);
    Route::resource('/ap/posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('/ap/post/categories', \App\Http\Controllers\CategoryController::class);
    Route::get('/ap/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
});

//Route::post('/message', [\App\Http\Controllers\vendor\Chatify\CustomMessagesController::class, 'index'])->name('message');
//Route::get('/mes', [\App\Http\Controllers\vendor\Chatify\CustomMessagesController::class, 'index'])->name('mes');


Route::post('/message/send', [CustomMessagesController::class, 'create'])->name('message.send');
Route::get('/messages', [CustomMessagesController::class, 'index'])->name('messages');
//Route::controller(CustomMessagesController::class)->group(function () {
//    Route::get('/mess', 'index');
//    Route::get('/messages', 'messages')->name('messages');
//    Route::post('/send', 'send')->name('send');
//});
