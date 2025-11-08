@extends('layouts.siswa')

@section('content')
<div class="container mt-4">
    <!-- <h3>Vocabulary Kelas {{ auth()->user()->kelas }}</h3> -->
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
