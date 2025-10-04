@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
    <div class="bg-blue-200 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Halo, {{ Auth::user()->username }}</h1>
        <p class="mb-6">Selamat datang di Florent English Course! Yuk, lanjutkan perjalanan belajarmu</p>

        {{-- Tombol ke materi --}}
        <div class="mb-8">
            <a href="#" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
               Lihat Materi
            </a>
        </div>

        {{-- Materi Belajar --}}
        <h2 class="text-xl font-semibold mb-4">Materi Belajar</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <div class="bg-gray-100 p-6 rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-2">Grammar Basics</h3>
                <a href="#"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                   Lihat Materi
                </a>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-2">Vocabulary</h3>
                <a href="#"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                   Lihat Materi
                </a>
            </div>
        </div>

        {{-- Nilai Saya --}}
        <h2 class="text-xl font-semibold mb-4">Nilai Saya</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b">Mata Pelajaran</th>
                        <th class="px-4 py-2 border-b">Nilai</th>
                        <th class="px-4 py-2 border-b">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 border-b">Grammar Basics</td>
                        <td class="px-4 py-2 border-b">85</td>
                        <td class="px-4 py-2 border-b">Lulus</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border-b">Vocabulary</td>
                        <td class="px-4 py-2 border-b">90</td>
                        <td class="px-4 py-2 border-b">Lulus</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection