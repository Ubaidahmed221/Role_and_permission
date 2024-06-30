@extends('layout.layout')
@section('contentes')
    <div class="container mt-4">
        <h2>Manage Role</h2>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createRoleModal">
            Create Role
        </button>
        <div class="col-md-12">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $x = 0;
                        @endphp
                        @foreach ($roles as $role)
                            <tr>
                                <th scope="row">{{ ++$x }}</th>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if (strtolower($role->name) != 'user')
                                        <button class="btn btn-primary updateroleEditbtn" data-id="{{ $role->id }}"
                                            data-name="{{ $role->name }}" data-toggle="modal"
                                            data-target="#updateRoleModal">Edit</button>
                                        <button data-id="{{ $role->id }}" data-name="{{ $role->name }}"
                                            data-toggle="modal" data-target="#DeleteRoleModal"
                                            class="btn btn-danger DeleteRoleModal">Delete</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Role Modal -->
        <div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="createRole">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Create Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" class="form-control" name="role" placeholder="enter role" required>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary CreateRoleBtn">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update Role Modal -->
        <div class="modal fade" id="updateRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="updateRole">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" class="form-control" name="role" placeholder="enter role"
                                    id="updateroleName" required>
                                <input type="hidden" name="role_id" id="updateRoleid">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary UpdateRoleBtn">Update </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="DeleteRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="deleteform">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="role_id" id="deleteRoleId">
                            <p>Are You Sure, You Want To Delete The <span class="delete-role"></span> Role?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#createRole').submit(function(e) {
                e.preventDefault();
                // $('.CreateRoleBtn').props('disabled',true);
                var formdata = $(this).serialize();

                $.ajax({
                    url: "{{ route('createRole') }}",
                    type: "post",
                    data: formdata,
                    success: function(res) {
                        // $('.CreateRoleBtn').props('disabled',false);
                        if (res.success) {
                            alert(res.msg);
                            location.reload();
                        } else {
                            alert(res.msg);
                        }

                    }
                })

            })

            $('.DeleteRoleModal').click(function() {
                var $roleid = $(this).data('id');
                var $rolename = $(this).data('name');

                $('.delete-role').text($rolename)
                $('#deleteRoleId').val($roleid)
                console.log($roleid);
                $('#deleteform').submit(function(e) {
                    e.preventDefault();
                    // $('.CreateRoleBtn').props('disabled',true);
                    var formdata = $(this).serialize();

                    $.ajax({
                        url: "{{ route('deleterole') }}",
                        type: "post",
                        data: formdata,
                        success: function(res) {
                            // $('.CreateRoleBtn').props('disabled',false);
                            if (res.success) {
                                alert(res.msg);
                                location.reload();
                            } else {
                                alert(res.msg);
                            }

                        }
                    })

                })


            });
            $('.updateroleEditbtn').click(function() {
                var roleId = $(this).data('id');
                var roleName = $(this).data('name');

                $('#updateroleName').val(roleName);
                $('#updateRoleid').val(roleId);

            });
            $('#updateRole').submit(function(e) {
                e.preventDefault();
                // $('.CreateRoleBtn').props('disabled',true);
                var formdata = $(this).serialize();

                $.ajax({
                    url: "{{ route('updaterole') }}",
                    type: "post",
                    data: formdata,
                    success: function(res) {
                        // $('.CreateRoleBtn').props('disabled',false);
                        if (res.success) {
                            alert(res.msg);
                            location.reload();
                        } else {
                            alert(res.msg);
                        }

                    }
                })

            })



        }); //  document ready
    </script>
@endpush
