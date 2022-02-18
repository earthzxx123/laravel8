<?php

use App\Http\Controllers\Covid19Controller;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; //สัปดาห์ที่ 7

use App\Http\Controllers\OrderController; //สัปดาห์ที่ 11
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/homepage", function () {
    return "<h1>This is home page</h1>";
});

Route::get("/blog/{id}", function ($id) {
    return "<h1>This is blog page : {$id} </h1>";
});
Route::get("/blog/{id}/edit", function ($id) {
    return "<h1>This is blog page : {$id} for edit</h1>";
});
Route::get("/product/{a}/{b}/{c}", function ($a, $b, $c) {
    return "<h1>This is product page </h1><div>{$a} , {$b}, {$c}</div>";
});
Route::get("/category/{a?}", function ($a = "mobile") {
    return "<h1>This is category page : {$a} </h1>";
});
Route::get("/myorder/create", function () {
    return "<h1>This is order form page : " . request("username") . "</h1>";
});

Route::get("/hello", function () {
    return view("hello");
});

Route::get('/greeting', function () {

    $name = 'James';
    $last_name = 'Mars';

    return view('greeting', compact('name', 'last_name'));
});

Route::get("/gallery", function () {
    $ant = "https://cdn3.movieweb.com/i/article/Oi0Q2edcVVhs4p1UivwyyseezFkHsq/1107:50/Ant-Man-3-Talks-Michael-Douglas-Update.jpg";
    $bird = "https://www.hebergementwebs.com/image/cc/cc8811773d2cdbeb4d46e5550fc455fe.jpg/falcon-and-the-winter-soldier-falcon-minifigure-captain-america.jpg";
    $cat = "http://www.onyxtruth.com/wp-content/uploads/2017/06/black-panther-movie-onyx-truth.jpg";
    $god = "https://www.blackoutx.com/wp-content/uploads/2021/04/Thor.jpg";
    $spider = "https://icdn5.digitaltrends.com/image/spiderman-far-from-home-poster-2-720x720.jpg";

    return view("test/index", compact("ant", "bird", "cat", "god", "spider"));
});

Route::get("/ant", function () {
    $ant = "https://static1.moviewebimages.com/wordpress/wp-content/uploads/article/Oi0Q2edcVVhs4p1UivwyyseezFkHsq.jpg?q=50&fit=contain&w=1107";

    return view("test/ant", compact("ant"));
});

Route::get("/bird", function () {
    $bird = "https://www.hebergementwebs.com/image/cc/cc8811773d2cdbeb4d46e5550fc455fe.jpg/falcon-and-the-winter-soldier-falcon-minifigure-captain-america.jpg";

    return view("test/bird", compact("bird"));
});
Route::get("/cat", function () {
    $cat = "http://www.onyxtruth.com/wp-content/uploads/2017/06/black-panther-movie-onyx-truth.jpg";

    return view("test/cat", compact("cat"));
});
Route::get("/god", function () {
    $god = "https://www.blackoutx.com/wp-content/uploads/2021/04/Thor.jpg";

    return view("test/god", compact("god"));
});
Route::get("/spider", function () {
    $spider = "https://icdn5.digitaltrends.com/image/spiderman-far-from-home-poster-2-720x720.jpg";

    return view("test/spider", compact("spider"));
});


//สัปดาห์ที่3 12/12/2564

// Route Template Inheritance
Route::middleware(['auth', 'role:admin,teacher,fitncae'])->group(function () {
    Route::get("/teacher/inheritance", function () {
        return view("teacher-inheritance");
    });

    Route::get("/student/inheritance", function () {
        return view("student-inheritance");
    });
});

// Route Template Component
Route::get("/teacher/component", function () {
    return view("teacher-component");
});
Route::get("/student/component", function () {
    return view("student-component");
});

//เดิมก่อนหน้าเป็น /tables แต่อาจารย์ให้เปลี่ยยนเป็น /table
Route::get('/table', function () {
    return view('table');
});

//สัปดาห์ที่4 19/12/2564
Route::get("/myprofile/create", [MyProfileController::class, "create"]);
Route::get("/myprofile/{id}/edit", [MyProfileController::class, "edit"]);
Route::get("/myprofile/{id}", [MyProfileController::class, "show"]);

Route::get("/newgallery", [MyProfileController::class, "gallery"]);
Route::get("/newgallery/ant", [MyProfileController::class, "ant"]);
Route::get("/newgallery/bird", [MyProfileController::class, "bird"]);

//สัปดาห์ที่5 26/12/2564
Route::get("/coronavirus", [MyProfileController::class, "coronavirus"]);
Route::get("/covid19/create", [Covid19Controller::class, "create"]);
Route::get("/covid19/{id}/edit", [Covid19Controller::class, "edit"]); //edit
Route::get('/covid19', [Covid19Controller::class, "index"]);

//สัปดาห์ที่6 9/1/2565
Route::get('/covid19/{id}', [Covid19Controller::class, 'show']);
Route::post("/covid19", [Covid19Controller::class, "store"]);
Route::patch("/covid19/{id}", [Covid19Controller::class, "update"]); //update
Route::delete('/covid19/{id}', [Covid19Controller::class, 'destroy']); //delete

//สัปดาห์ที่7 16/1/2565
//Route::resource('/staff',StaffController::class); 

// Route::resource('post', 'PostController');
Route::resource('post', PostController::class);

//สัปดาห์ที่8 #สอบ 23/1/2565

// สัปดาห์ที่9 30/1/2565
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__ . '/auth.php';

//สัปดาห์ที่10 6/2/2565

//สัปดาห์ที่11 13/2/2565
Route::resource('product', ProductController::class);
Route::middleware(['auth'])->group(function () {
    Route::resource('order', OrderController::class);
    Route::resource('payment', PaymentController::class);
    Route::resource('order-product', OrderProductController::class);
});
