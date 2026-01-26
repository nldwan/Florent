@extends('layouts.admin')
@section('title', 'Admin Accounts')

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

/* Responsive adjustments */
@media (max-width: 576px) {
    .modal-lg {
        --bs-modal-width: 95%;
    }

    .table-responsive {
        font-size: 0.85rem;
    }

    .page-title {
        font-size: 1.1rem;
    }
}
</style>

<!-- Header -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <h4 class="page-title mb-0">Admin Accounts</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm ms-auto">
        <i class="bi bi-plus-lg"></i> Add Admin
    </a>
</div>

<!-- Table -->
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
                @forelse($admins as $admin)
                <tr id="row-{{ $admin->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->no_hp }}</td>
                    <td class="d-flex gap-1 flex-wrap">
                        <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editAdmin{{ $admin->id }}">
                            Edit
                        </button>

                        <button type="button"
                            class="btn btn-danger btn-sm"
                            onclick="confirmDelete({{ $admin->id }})"
                            data-id="{{ $admin->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                <!-- EDIT MODAL -->
                <div class="modal fade" id="editAdmin{{ $admin->id }}" tabindex="-1" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <form method="POST" class="edit-form" data-id="{{ $admin->id }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-content custom-modal">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name"
                                            class="form-control"
                                            value="{{ $admin->name }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email"
                                            class="form-control"
                                            value="{{ $admin->email }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="no_hp"
                                            class="form-control"
                                            value="{{ $admin->no_hp }}" required>
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
                        No admin data found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- JS -->
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Admin ini akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteAdmin(id);
        }
    });
}

function deleteAdmin(id) {
    fetch(`/admin/users/admin/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
            document.querySelector(`button[onclick="confirmDelete(${id})"]`).closest('tr').remove();
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(() => {
        Swal.fire('Error', 'Terjadi kesalahan server', 'error');
    });
}

document.querySelectorAll('.edit-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const formData = new FormData(this);

        fetch(`/admin/users/admin/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                document.querySelector(`#row-${id} td:nth-child(2)`).innerText = data.data.name;
                document.querySelector(`#row-${id} td:nth-child(3)`).innerText = data.data.email;
                document.querySelector(`#row-${id} td:nth-child(4)`).innerText = data.data.no_hp;
                bootstrap.Modal.getInstance(this.closest('.modal')).hide();
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
