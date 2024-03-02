@extends('layout')
@section('title','ลอง')
@section('content')
    <h2>โครงการพัฒนาเว็บแอพลิเคชั่นระบบตรวจวัดคุณภาพน้ำ</h2>
    <a href="/about">About us</a>
    <a href="/admin">Administrator</a>
    <a href="/login">Login</a>
    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search here..." aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
@endsection
