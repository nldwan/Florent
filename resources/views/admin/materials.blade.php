@extends('layouts.admin')
@section('title', 'Material Management')

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
    <h4 class="page-title">Material Management</h4>
    <a href="{{ route('admin.materials.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add Material
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Course</th>
                    <th>Level</th>
                    <th>Sublevel</th>
                    <th>File</th>
                    <th width="130">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materials as $material)
                <tr id="row-{{ $material->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $material->title }}</td>
                    <td>{{ $material->course->name }}</td>
                    <td>{{ $material->level->name }}</td>
                    <td>{{ $material->sublevel->order ?? '-' }}</td>
                    <td>
                        <a href="{{ asset('materi/'.$material->file) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            View
                        </a>
                    </td>
                    <td class="d-flex gap-1 flex-wrap">
                        <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#edit{{ $material->id }}">
                            Edit
                        </button>

                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="confirmDelete({{ $material->id }})">
                            Delete
                        </button>
                    </td>
                </tr>

                {{-- EDIT MODAL --}}
                <div class="modal fade" id="edit{{ $material->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <form method="POST" class="edit-form" data-id="{{ $material->id }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-content custom-modal">
                                <div class="modal-header">
                                    <h5>Edit Material</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Course</label>
                                        <select name="course_id" class="form-control" required>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ $course->id == $material->course_id ? 'selected' : '' }}>
                                                    {{ $course->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Level</label>
                                        <select name="level_id" class="form-control" required>
                                            @foreach($levels as $level)
                                                <option value="{{ $level->id }}"
                                                    {{ $level->id == $material->level_id ? 'selected' : '' }}>
                                                    {{ $level->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Sublevel</label>
                                        <select name="sublevel_id" class="form-control" required>
                                            @foreach($sublevels as $sub)
                                                <option value="{{ $sub->id }}"
                                                    {{ $sub->id == $material->sublevel_id ? 'selected' : '' }}>
                                                    {{ $sub->order }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text"
                                            name="title"
                                            class="form-control"
                                            value="{{ $material->title }}"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Replace PDF (optional)</label>
                                        <input type="file"
                                            name="file"
                                            class="form-control"
                                            accept="application/pdf">
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
                    <td colspan="7" class="text-center text-muted py-4">
                        No materials found.
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
        text: 'Material ini akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteMaterial(id);
        }
    });
}

function deleteMaterial(id) {
    fetch(`/admin/materials/${id}`, {
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

            // hapus row tabel
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

        fetch(`/admin/materials/${id}`, {
            method: 'POST', // PUT via method spoofing
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

                // update title di tabel
                document.querySelector(
                    `#row-${id} td:nth-child(2)`
                ).innerText = data.data.title;

                // tutup modal
                bootstrap.Modal.getInstance(
                    this.closest('.modal')
                ).hide();

                // alert sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(() => {
            Swal.fire('Error', 'Gagal update data', 'error');
        });
    });
});
</script>

@endsection
