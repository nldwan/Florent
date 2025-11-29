@extends('layouts.siswa')

@section('content')
<div class="container mt-4">
    <!-- <h3>Vocabulary Kelas {{ auth()->user()->kelas }}</h3> -->
    <form action="{{ route('siswa.vocabulary') }}" method="GET" class="mb-4 d-flex">
        <input 
            type="text" 
            name="search" 
            class="form-control me-2" 
            placeholder="Cari kata..." 
            value="{{ request('search') }}"
        >
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
    <h3>Vocabulary</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Verb 1</th>
                <th>Verb 2</th>
                <th>Verb 3</th>
                <th>Meaning</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vocabularies as $vocabulary)
                <tr>
                    <td>{{ $vocabulary->verb1 }}</td>
                    <td>{{ $vocabulary->verb2 }}</td>
                    <td>{{ $vocabulary->verb3 }}</td>
                    <td>{{ $vocabulary->meaning }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
