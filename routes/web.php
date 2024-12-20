<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProductController as SiteProductController;
use App\Http\Controllers\TimeManagementController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\IdeaController;
use App\Http\Controllers\Admin\ManageDayController;
use App\Http\Controllers\Admin\ManageTimeController;
use App\Http\Controllers\TaskController as TodoController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ScheduleDayController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\WorkShiftController;
use App\Models\ScheduleDay;

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


Route::delete('/clear-schedule-days', function() {
    ScheduleDay::truncate();
})->name('clear-schedule-days');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/category/{id}', [BlogController::class, 'show'])->name('category');
Route::get('/post/{id}', [BlogController::class, 'showPost'])->name('post');

Route::get('/contact-us', [MessageController::class, 'create'])->name('contact-us');
Route::post('/store-message', [MessageController::class, 'store'])->name('store-message');
Route::get('/report', [MessageController::class, 'report'])->name('report');
Route::get('/search-phrase', [BlogController::class, 'searchPhrase'])->name('search-phrase');

Route::resources([ 
    'comments' => CommentController::class,
]);

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/events/postpone/{id}', [DashboardController::class, 'postpone'])->name('events.postpone');
    Route::delete('/dashboard/remove-categories', [DashboardController::class, 'removeCategoriesAndPosts'])->name('remove-categories');
    Route::post('/dashboard/add-new-thumbnails', [DashboardController::class, 'makeNewThumbnails'])->name('add-new-thumbnails');
    Route::delete('/dashboard/remove-events', [DashboardController::class, 'removeEvents'])->name('remove-events');

    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');

    Route::middleware(['root'])->group(function () {
        Route::get('/messages', [MessageController::class, 'index'])->name('messages');
        Route::get('/clear-messages', [MessageController::class, 'clear'])->name('clear-messages');
        Route::get('/message/{id}', [MessageController::class, 'show'])->name('message');
        Route::delete('/clear-tasks', [TodoController::class, 'clear'])->name('clear-tasks');
        
        Route::put('/activate-products/{id}', [SiteProductController::class, 'activateProducts'])->name('activate-products');
        Route::put('/disable-products/{id}', [SiteProductController::class, 'disableProducts'])->name('disable-products');

        Route::put('/activate-times/{id}', [TimeManagementController::class, 'activateTimes'])->name('activate-times');
        Route::put('/disable-times/{id}', [TimeManagementController::class, 'disableTimes'])->name('disable-times');

        Route::resources([
            'settings' => SettingController::class, 
        ]);
        
        Route::delete('/scedule-days-delete-month/{id}', [WorkShiftController::class, 'deleteMonth'])->name('scedule-days-delete-month');
    });

    Route::resources([ 
        'events'         => EventController::class,
        'categories'     => CategoryController::class,
        'posts'          => PostController::class,
        'tasks'          => TaskController::class,
        'schedules'      => ScheduleController::class,
        'schedule-days'  => ScheduleDayController::class,
        'product-lists'  => ProductListController::class,
        'products'       => ProductController::class,
        'ideas'          => IdeaController::class,
        'manage-days'    => ManageDayController::class,
        'manage-times'   => ManageTimeController::class,
        'colors'         => ColorController::class,
    ]);
});























require __DIR__.'/auth.php';
