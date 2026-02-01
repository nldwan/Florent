@extends('layouts.siswa')

@section('content')

<style>
    .video-grid {
        display: grid;
        gap: 20px;
        padding: 20px 0;
        grid-template-columns: repeat(1, 1fr);
    }

    .video-card {
        background: white;
        border-radius: 12px;
        padding: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.07);
        transition: 0.2s;
    }

    .video-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        transform: translateY(-3px);
    }

    .video-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #374151;
    }

    .video-wrapper {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* ratio 16:9 */
        overflow: hidden;
        border-radius: 10px;
    }

    .video-wrapper iframe {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        border: 0;
    }

    @media (min-width: 640px) {
        .video-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .video-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
</style>

<div class="container py-5">

    <h2 class="text-center fw-bold mb-5" style="color:#1f2937;">Video Conversation</h2>
    <div class="video-grid">
        @foreach($conversations as $c)
            <div class="video-card">

                <div class="video-title">
                    {{ $c->title }}
                </div>

                <div class="video-wrapper">
                    <iframe 
                        src="{{ $c->video }}"
                        allowfullscreen>
                    </iframe>
                </div>

            </div>
        @endforeach
    </div>

</div>

@endsection