<?php

use Illuminate\Support\Facades\Route;

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

/* เส้นทางในการเข้าใช้งาน Web Page*/
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('welcome');
});

/*ไม่จำเป็นต้องใส่ / ก็ได้เพราะไม่มี path หลักข้างหน้า*/
Route::get('about', function () {
    return view('about');
});

Route::get('admin', function () {
    return view('admin');
});

Route::get('login', function () {
    return view('login');
});

Route::get('welcome', function () {
    return view('welcome');
});

/* --------------------------------------------------------- */

/* ส่งค่ามาพร้อมกับการระบุเส้นทาง เก็บค่าไว้ใน parameter ชื่อ name*/
Route::get('/blog/{name}', function ($name) {
    return "<h1>Story Detail ${name}</h1>";
    /* แสดงค่าที่รับมาจาก path */
});

/* ย่อ path */
Route::get('admin/user/test', function () {
    return "<h1>Welcome Admin</h1>";
    /* แสดงค่าที่รับมาจาก path */
})->name('admin');

/* เรียก path ที่ไม่มีอยู่ใน route */
Route::fallback(function(){
    return "404 NOT FOUND : ไม่พบหน้าเว็บ";
});
