@extends('layouts.user_template')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">System Users</h4>
        <p class="text-muted mb-0" style="font-size:14px;">Manage admin accounts that have access to this system.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-lg me-1"></i> Add User
    </button>
</div>

{{-- SEARCH --}}
<div class="mb-3">
    <input type="text" id="searchInput" class="form-control w-25" placeholder="Search by name or email...">
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="userTable">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Contact</th>
                        <th>Role</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($user as $users)
                    <tr>
                        <td>#{{ $users->id }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                                     style="width:32px;height:32px;font-size:13px;">
                                    {{ strtoupper(substr($users->fullname, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-medium">{{ $users->fullname }}</div>
                                    <div class="text-muted" style="font-size:12px;">
                                        <i class="bi bi-envelope me-1"></i>{{ $users->email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $users->contact ?? '—' }}</td>
                        <td>
                            @if($users->role === 'admin')
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Admin</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">User</span>
                            @endif
                        </td>
                        <td style="font-size:13px;">{{ $users->created_at->format('M j, Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $users->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $users->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>

                    {{-- EDIT MODAL --}}
                    <div class="modal fade" id="editModal{{ $users->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('user.update', $users->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-body row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" name="fullname" class="form-control" value="{{ $users->fullname }}" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ $users->email }}" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Contact</label>
                                            <input type="text" name="contact" class="form-control" value="{{ $users->contact }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Role</label>
                                            <select name="role" class="form-select">
                                                <option value="admin" {{ $users->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="user" {{ $users->role === 'user' ? 'selected' : '' }}>User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- DELETE MODAL --}}
                    <div class="modal fade" id="deleteModal{{ $users->id }}" tabindex="-1">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete <strong>{{ $users->fullname }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('user.destroy', $users->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-people fs-3 d-block mb-2"></i>
                            No users found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ADD MODAL --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="modal-body row g-3">
                    <div class="col-12">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="fullname" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Contact</label>
                        <input type="text" name="contact" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SEARCH --}}
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    document.querySelectorAll('#userTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
    });
});
</script>

@endsection