@extends('layouts.siswa')

@section('content')
<style>
    .materi-card {
        border-radius: 20px;
        width: 230px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .icon-wrapper {
        background-color: #d9c4ff;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .icon-wrapper i {
        font-size: 38px;
        color: #7c3aed;
    }
    .btn-lihat {
        background-color: #2563eb;
        color: #fff;
        border-radius: 10px;
        padding: 5px 15px;
        font-weight: 500;
    }
    .btn-lihat:hover {
        background-color: #1e40af;
    }
    .btn-download {
        background-color: #22c55e;
        color: #fff;
        border-radius: 10px;
        padding: 5px 15px;
        font-weight: 500;
     }
    .btn-download:hover {
        background-color: #15803d;
    }
</style>

<div class="container py-5">
    <h2 class="text-center fw-bold mb-5" style="color:#1f2937;">Daftar Materi Pembelajaran</h2>

    <div class="row justify-content-center">
        @foreach ($materials as $material)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex justify-content-center">
            <div class="card materi-card text-center border-0">
                <div class="card-body">
                    <!-- Ikon -->
                    <div class="icon-wrapper mx-auto mb-3">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                    <!-- Judul -->
                    <h5 class="fw-semibold mb-3" style="color:#1f2937;">{{ $material->title }}</h5>

                    <!-- Tombol -->
                    @if($material->file)
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ asset('materi/' . $material->file) }}" 
                           target="_blank" 
                           class="btn btn-lihat">Lihat</a>

                        <a href="{{ asset('materi/' . $material->file) }}" 
                           download 
                           class="btn btn-download">Download</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection