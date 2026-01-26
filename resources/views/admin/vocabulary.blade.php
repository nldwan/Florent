@extends('layouts.admin')
@section('title', 'Vocabulary')

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

    .custom-modal {
        border-radius: 12px;
        border: none;
    }

    .custom-modal .modal-header {
        border-bottom: 1px solid #f0f0f0;
    }

    .custom-modal .modal-footer {
        border-top: 1px solid #f0f0f0;
    }

    .custom-modal label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .custom-modal .form-control {
        border-radius: 8px;
        font-size: 0.9rem;
    }

    /* Button lebih halus */
    .btn {
        border-radius: 8px;
    }

    .modal-dialog.modal-fixed {
        max-width: 480px;
    }


    .custom-modal .modal-body {
        padding: 20px;
    }

    .custom-modal textarea {
        resize: none;
    }

    .form-group {
        margin-bottom: 16px;
    }

</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="page-title">Vocabulary List</h4>
    <a href="{{ route('admin.vocabulary.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add Vocabulary
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Verb 1</th>
                    <th>Verb 2</th>
                    <th>Verb 3</th>
                    <th>Meaning</th>
                    <th width="130">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vocabularies as $item)
                <tr id="row-{{ $item->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->verb1 }}</td>
                    <td>{{ $item->verb2 }}</td>
                    <td>{{ $item->verb3 }}</td>
                    <td>{{ $item->meaning }}</td>
                    <td class="d-flex gap-1 flex-wrap">
                        <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $item->id }}">
                            Edit
                        </button>

                        <button type="button"
                            class="btn btn-danger btn-sm"
                            onclick="confirmDelete({{ $item->id }})">
                            Delete
                        </button>
                    </td>
                </tr>

                <!-- EDIT MODAL -->
                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-fixed">
                        <form method="POST" class="edit-form" data-id="{{ $item->id }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-content custom-modal">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Vocabulary</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Verb 1</label>
                                        <input type="text" name="verb1" class="form-control" value="{{ $item->verb1 }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Verb 2</label>
                                        <input type="text" name="verb2" class="form-control" value="{{ $item->verb2 }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Verb 3</label>
                                        <input type="text" name="verb3" class="form-control" value="{{ $item->verb3 }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Meaning</label>
                                        <textarea name="meaning" class="form-control" rows="3">{{ $item->meaning }}</textarea>
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
                    <td colspan="6" class="text-center text-muted py-4">
                        No vocabulary data found.
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
        text: 'This vocabulary will be permanently deleted!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteVocabulary(id);
        }
    });
}

function deleteVocabulary(id) {
    fetch(`/admin/vocabulary/${id}`, {
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
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const id = this.dataset.id;
        const formData = new FormData(this);

        fetch(`/admin/vocabulary/${id}`, {
            method: 'POST', // PUT via _method
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
                const row = document.querySelector(`#row-${id}`);
                row.children[1].innerText = data.data.verb1;
                row.children[2].innerText = data.data.verb2;
                row.children[3].innerText = data.data.verb3;
                row.children[4].innerText = data.data.meaning;

                // Tutup modal
                bootstrap.Modal.getInstance(
                    this.closest('.modal')
                ).hide();

                // Alert sukses
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
            Swal.fire('Error', 'Failed to update data', 'error');
        });
    });
});
</script>

@endsection
