@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="font-weight-bold">Dashboard Admin</h2>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-lg-3 col-md-6">
            <div class="card bg-danger border-0">
                <div class="card-body d-flex justify-content-center">
                    <i class="fa-solid fa-lock" style="font-size: 35px;"></i>
                    <p class="font-weight-bold pt-2 ml-3">Jumlah Admin: {{$jml_admin}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
            <div class="card bg-success border-0">
                <div class="card-body d-flex justify-content-center">
                    <i class="fa-solid fa-lock" style="font-size: 35px;"></i>
                    <p class="font-weight-bold pt-2 ml-3">Jumlah Semua Blog: {{$jml_artikel}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
            <div class="card bg-warning border-0">
                <div class="card-body d-flex justify-content-center">
                    <i class="fa-solid fa-lock" style="font-size: 35px;"></i>
                    <p class="font-weight-bold pt-2 ml-3">Jumlah Blog Saya: 5</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
            <div class="card bg-info border-0">
                <div class="card-body d-flex justify-content-center">
                    <i class="fa-solid fa-lock" style="font-size: 35px;"></i>
                    <p class="font-weight-bold pt-2 ml-3">Jumlah Pengguna: 18</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col d-flex justify-content-between">
            <h3 class="font-weight-bold">Blog Terbaru Saya</h3>
            <a href="/blog" class="btn btn-outline-primary">Lihat Semua Blog Saya</a>
        </div>
    </div>

    <div>
        <article class="mt-4">
            <div class="row">
                <div class="col d-flex justify-content-between align-items-center">
                    <img class="img-thumbnail float-left thumbnail-article" width="200" src="https://asset.kompas.com/crops/aPEuc8DLw1VHJbcVbCNsbgnCIQ4=/0x0:0x0/750x500/data/photo/2022/03/09/6228c75d77995.jpg" alt="Banner Artikel">
                    <div class="article-wrap ml-4">
                        <h4 class="font-weight-bold w-auto text-capitalize article-description text-capitalize">
                            <a href="#">ketahui penyebab radang tenggorokan yang diidap oleh kebanyakan orang saat masa corona</a>
                        </h4>
                        <div class="d-flex mt-3">
                            <p class="article-description mr-3">Kesehatan <time>09/03/2022, 11:30 WIB</time></p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <article class="mt-4">
            <div class="row">
                <div class="col d-flex justify-content-between align-items-center">
                    <img class="img-thumbnail float-left thumbnail-article" width="200" src="https://asset.kompas.com/crops/aPEuc8DLw1VHJbcVbCNsbgnCIQ4=/0x0:0x0/750x500/data/photo/2022/03/09/6228c75d77995.jpg" alt="Banner Artikel">
                    <div class="article-wrap ml-4">
                        <h4 class="font-weight-bold w-auto text-capitalize article-description text-capitalize">
                            <a href="#">ketahui penyebab radang tenggorokan yang diidap oleh kebanyakan orang saat masa corona</a>
                        </h4>
                        <div class="d-flex mt-3">
                            <p class="article-description mr-3">Kesehatan <time>09/03/2022, 11:30 WIB</time></p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <article class="mt-4">
            <div class="row">
                <div class="col d-flex justify-content-between align-items-center">
                    <img class="img-thumbnail float-left thumbnail-article" width="200" src="https://asset.kompas.com/crops/aPEuc8DLw1VHJbcVbCNsbgnCIQ4=/0x0:0x0/750x500/data/photo/2022/03/09/6228c75d77995.jpg" alt="Banner Artikel">
                    <div class="article-wrap ml-4">
                        <h4 class="font-weight-bold w-auto text-capitalize article-description text-capitalize">
                            <a href="#">ketahui penyebab radang tenggorokan yang diidap oleh kebanyakan orang saat masa corona</a>
                        </h4>
                        <div class="d-flex mt-3">
                            <p class="article-description mr-3">Kesehatan <time>09/03/2022, 11:30 WIB</time></p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
