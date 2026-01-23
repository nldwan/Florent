@extends('layouts.admin')
@section('title', 'Student Accounts')

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
        letter-spacing: .05em;
        color: #6c757d;
    }

    table td {
        vertical-align: middle;
        font-size: 0.95rem;
    }

    .custom-modal .modal-header,
    .custom-modal .modal-footer {
        border-color: #f0f0f0;
    }

    .btn {
        border-radius: 8px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .custom-modal {
        border-radius: 14px;
    }

    .custom-modal .modal-body {
        padding: 24px;
    }

    .custom-modal .form-control {
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .custom-modal label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #6b7280;
    }

    .modal-dialog {
        margin: auto;
    }

    .modal-lg {
        --bs-modal-width: 600px;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="page-title">Siswa Accounts</h4>
    <a href="{{ route('admin.users.siswa.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add Siswa
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th width="130">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr id="row-{{ $user->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->no_hp }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editUser{{ $user->id }}">
                            Edit
                        </button>

                        <button type="button"
                            class="btn btn-danger btn-sm"
                            onclick="confirmDelete({{ $user->id }})"
                            data-id="{{ $user->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                <!-- EDIT MODAL -->
                <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <form method="POST" class="edit-form" data-id="{{ $user->id }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-content custom-modal">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name"
                                            class="form-control"
                                            value="{{ $user->name }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email"
                                            class="form-control"
                                            value="{{ $user->email }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="no_hp"
                                            class="form-control"
                                            value="{{ $user->no_hp }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Password (optional)</label>
                                        <input type="password" name="password"
                                            class="form-control"
                                            placeholder="Leave blank if unchanged">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        No siswa data found.
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
        text: 'Siswa ini akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteSiswa(id);
        }
    });
}

function deleteSiswa(id) {
    fetch(`/admin/users/siswa/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: data.message,
                timer: 1500,
                showConfirmButton: false
            });

            // HAPUS ROW DARI TABLE
            document
                .querySelector(`button[onclick="confirmDelete(${id})"]`)
                .closest('tr')
                .remove();

        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(() => {
        Swal.fire('Error', 'Terjadi kesalahan server', 'error');
    });
}
</script>

<script>
document.querySelectorAll('.edit-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const id = this.dataset.id;
        const formData = new FormData(this);

        fetch(`/admin/users/siswa/${id}`, {
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

                // Update tabel
                document.querySelector(`#row-${id} td:nth-child(2)`).innerText = data.data.name;
                document.querySelector(`#row-${id} td:nth-child(3)`).innerText = data.data.email;
                document.querySelector(`#row-${id} td:nth-child(4)`).innerText = data.data.no_hp;

                // Tutup modal
                bootstrap.Modal.getInstance(
                    this.closest('.modal')
                ).hide();

                // SweetAlert sukses
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
            Swal.fire('Error', 'Gagal update data', 'error');
        });
    });
});
</script>

@endsection