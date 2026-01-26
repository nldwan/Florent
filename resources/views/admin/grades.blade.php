@extends('layouts.admin')
@section('title', 'Grades Management')

@section('content')

<style>
.page-title {
    font-weight: 600;
    letter-spacing: .3px;
}
.card {
    border-radius: 14px;
}
table th {
    font-size: 0.85rem;
    text-transform: uppercase;
    color: #6c757d;
}
table td {
    vertical-align: middle;
    font-size: 0.95rem;
}
.btn {
    border-radius: 8px;
}
.custom-modal {
    border-radius: 14px;
}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="page-title">Student Grades</h4>
    <a href="{{ route('admin.grades.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add Grade
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Level</th>
                    <th>Sublevel</th>
                    <th>Final Score</th>
                    <th>Status</th>
                    <th width="130">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $grade)
                <tr id="row-{{ $grade->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $grade->user->name }}</td>
                    <td>{{ $grade->course->name ?? '-' }}</td>
                    <td>{{ $grade->level->name ?? '-' }}</td>
                    <td>{{ $grade->sublevel->order ?? '-' }}</td>
                    <td>
                        {{ $grade->final_score ? number_format($grade->final_score, 1) : '-' }}
                    </td>
                    <td>
                        <span class="badge bg-{{ $grade->status == 'completed' ? 'success' : 'warning' }}">
                            {{ $grade->status }}
                        </span>
                    </td>
                    <td class="d-flex gap-1 flex-wrap">
                        <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#edit{{ $grade->id }}">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm"
                            onclick="confirmDelete({{ $grade->id }})">
                            Delete
                        </button>
                    </td>
                </tr>

                {{-- EDIT MODAL --}}
                <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <form method="POST" class="edit-form" data-id="{{ $grade->id }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-content custom-modal">
                                <div class="modal-header">
                                    <h5>Edit Grade</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label>Writing Grammar</label>
                                            <input type="number" name="writing_grammar"
                                                class="form-control"
                                                value="{{ $grade->writing_grammar }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Writing Translation</label>
                                            <input type="number" name="writing_translation"
                                                class="form-control"
                                                value="{{ $grade->writing_translation }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Writing Composition</label>
                                            <input type="number" name="writing_composition"
                                                class="form-control"
                                                value="{{ $grade->writing_composition }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Reading Comprehension</label>
                                            <input type="number" name="reading_compre"
                                                class="form-control"
                                                value="{{ $grade->reading_compre }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Reading Vocabulary</label>
                                            <input type="number" name="reading_vocabulary"
                                                class="form-control"
                                                value="{{ $grade->reading_vocabulary }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Listening</label>
                                            <input type="number" name="listening_compre"
                                                class="form-control"
                                                value="{{ $grade->listening_compre }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Speaking Pronouncing</label>
                                            <input type="number" name="speaking_pronouncing"
                                                class="form-control"
                                                value="{{ $grade->speaking_pronouncing }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Speaking Fluency</label>
                                            <input type="number" name="speaking_fluency"
                                                class="form-control"
                                                value="{{ $grade->speaking_fluency }}">
                                        </div>

                                        <div class="col-12">
                                            <label>Notes</label>
                                            <textarea name="notes" class="form-control"
                                                rows="3">{{ $grade->notes }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        No grades found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Nilai siswa ini akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteGrade(id);
        }
    });
}

function deleteGrade(id) {
    fetch(`/admin/grades/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: data.message,
                timer: 1500,
                showConfirmButton: false
            });

            document.querySelector(`#row-${id}`).remove();
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(() => {
        Swal.fire('Error', 'Server error', 'error');
    });
}
</script>

<script>
document.querySelectorAll('.edit-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const id = this.dataset.id;
        const formData = new FormData(this);

        fetch(`/admin/grades/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {

                // update final score
                document.querySelector(`#row-${id} td:nth-child(6)`)
                    .innerText = data.data.final_score ?? '-';

                // update status
                document.querySelector(`#row-${id} td:nth-child(7)`)
                    .innerHTML = `
                        <span class="badge bg-${data.data.status === 'completed' ? 'success' : 'warning'}">
                            ${data.data.status}
                        </span>
                    `;

                // close modal
                bootstrap.Modal.getInstance(
                    this.closest('.modal')
                ).hide();

                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        })
        .catch(() => {
            Swal.fire('Error', 'Gagal update nilai', 'error');
        });
    });
});
</script>

@endsection
