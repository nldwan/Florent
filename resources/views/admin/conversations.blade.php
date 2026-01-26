@extends('layouts.admin')
@section('title', 'Conversation Management')

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

    /* Responsive header */
    .d-flex.justify-content-between.align-items-center.mb-4.flex-wrap.gap-2 {
        flex-wrap: wrap;
    }

    /* Tombol action tetap kecil tapi pindah baris kalau sempit */
    td.d-flex.flex-wrap > .btn {
        flex: 0 0 auto; /* jangan melebar */
    }
    td.d-flex.flex-wrap {
        gap: 0.25rem;
    }

    /* Modal footer tombol tetap kecil */
    .modal-footer.flex-wrap > .btn {
        flex: 0 0 auto;
        margin-bottom: 0.25rem;
    }
</style>


<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h4 class="page-title">Conversation</h4>
    <a href="{{ route('admin.conversations.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add Conversation
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Course</th>
                    <th>Title</th>
                    <th>Video</th>
                    <th width="130">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($conversations as $conversation)
                <tr id="row-{{ $conversation->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $conversation->course->name }}</td>
                    <td>{{ $conversation->title }}</td>
                    <td>
                        <a href="{{ $conversation->video }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            View
                        </a>
                    </td>
                    <td class="d-flex gap-1 flex-wrap">
                        <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#edit{{ $conversation->id }}">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm"
                            onclick="confirmDelete({{ $conversation->id }})">
                            Delete
                        </button>
                    </td>
                </tr>

                {{-- EDIT MODAL --}}
                <div class="modal fade" id="edit{{ $conversation->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <form method="POST" class="edit-form" data-id="{{ $conversation->id }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-content custom-modal">
                                <div class="modal-header">
                                    <h5>Edit Conversation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Course</label>
                                        <select name="course_id" class="form-control">
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ $course->id == $conversation->course_id ? 'selected' : '' }}>
                                                    {{ $course->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text"
                                               name="title"
                                               class="form-control"
                                               value="{{ $conversation->title }}">
                                    </div>

                                    <div class="mb-3">
                                        <label>YouTube Link</label>
                                        <input type="text"
                                               name="video"
                                               class="form-control"
                                               value="{{ $conversation->video }}">
                                    </div>
                                </div>

                                <div class="modal-footer flex-wrap gap-2">
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
                    <td colspan="5" class="text-center text-muted py-4">
                        No conversations found.
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
        text: 'Conversation ini akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteConversation(id);
        }
    });
}

function deleteConversation(id) {
    fetch(`/admin/conversations/${id}`, {
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

        fetch(`/admin/conversations/${id}`, {
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

                // update table
                document.querySelector(`#row-${id} td:nth-child(2)`).innerText = data.data.course;
                document.querySelector(`#row-${id} td:nth-child(3)`).innerText = data.data.title;

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
            Swal.fire('Error', 'Gagal update data', 'error');
        });
    });
});
</script>

@endsection
