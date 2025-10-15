<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::view('/index', 'index')->name('index');
Route::view('/about-us', 'about-us')->name('about-us');
Route::view('/contact', 'contact')->name('contact');
Route::view('/gallery', 'gallery')->name('gallery');
Route::view('/blog_details', 'blog_details')->name('blog_details');
Route::view('/blog', 'blog')->name('blog');
Route::view('/bmi_calculator', 'bmi_calculator')->name('bmi_calculator');
Route::view('/class_details', 'class_details')->name('class_details');
Route::view('/class_timetable', 'class_timetable')->name('class_timetable');
Route::view('/services', 'services')->name('services');
Route::view('/team', 'team')->name('team');
Route::view('/404', '404')->name('404');

