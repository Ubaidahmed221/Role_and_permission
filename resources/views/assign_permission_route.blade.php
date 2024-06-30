@extends('layout.layout')
@section('contentes')
    <div class="container mt-4">
        <h2>Manage Route</h2>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Assign Permission To Route
        </button>

        <div class="col-md-12 p-5">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Permission</th>
                            <th scope="col">Router Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $x = 0;
                        @endphp
                        @foreach ($routerpermission as $permissionsse)
                            <tr>
                                <td>{{ ++$x }}</td>
                                <td>{{ $permissionsse->permission->name }}</td>
                                <td>{{ $permissionsse->router }}</td>
                                <td>
                                    <button class="btn btn-info editbtn" data-id ="{{ $permissionsse->id }}"
                                        data-permission-id = "{{ $permissionsse->permission_id }}"
                                        data-router="{{ $permissionsse->router }}" data-toggle="modal"
                                        data-target="#updateModal">Edit</button>
                                    <button class="btn btn-danger deletebtns" data-id ="{{ $permissionsse->id }}" data-toggle="modal"
                                        data-target="#deleteModal">Delete</button>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        {{--  Create Model  --}}
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="addForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Assign Permission To Route</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Permission</label>
                                <select name="permission_id" class="form-control" required>
                                    <option value="">Select Permission</option>
                                    @foreach ($permission as $permissionss)
                                        <option value="{{ $permissionss->id }}">{{ $permissionss->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label>Route</label>
                                <select name="route" class="form-control" required>
                                    <option value="">Select Role</option>
                                    @foreach ($routeDetail as $route)
                                        <option value="{{ $route['name'] }}">{{ $route['name'] }}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary addBtn">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Update Model --}}
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="UpdateForm">
                        @csrf
                        <input type="hidden" name="id" id="update-id" />

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Assign Permission To Route</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Permission</label>
                                <select name="permission_id" id="update-permission-id" class="form-control" required>
                                    <option value="">Select Permission</option>
                                    @foreach ($permission as $permissionss)
                                        <option value="{{ $permissionss->id }}">{{ $permissionss->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label>Route</label>
                                <select name="route" id="update-router" class="form-control" required>
                                    <option value="">Select Role</option>
                                    @foreach ($routeDetail as $route)
                                        <option value="{{ $route['name'] }}">{{ $route['name'] }}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary submitBtn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Delete Route --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="delete-form">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"> Delete Assign Permission To Route</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="delete_id">
                            <p>Are you want To delete?</p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger deleteRoleBtn">delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @push('script')
        <script>
            $(document).ready(function() {
                $('#addForm').submit(function(e) {
                    e.preventDefault();
                    // $('.CreateRoleBtn').props('disabled',true);
                    var formdata = $(this).serialize();

                    $.ajax({
                        url: "{{ route('createPermissionRoute') }}",
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

                });

                // Update Form Work
                $('.editbtn').click(function() {
                    var id = $(this).data('id');
                    var permission_id = $(this).data('permission-id');
                    var router = $(this).data('router');

                    $('#update-id').val(id);
                    $('#update-permission-id').val(permission_id);
                    $('#update-router').val(router);


                });
                $('#UpdateForm').submit(function(e) {
                    e.preventDefault();
                    // $('.CreateRoleBtn').props('disabled',true);
                    var formdata = $(this).serialize();

                    $.ajax({
                        url: "{{ route('updatePermissionRoute') }}",
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

                });

                $('.deletebtns').click(function(){
                  var id =  $(this).data('id');
                  $('#delete_id').val(id);
                });
                $('#delete-form').submit(function(e) {
                    e.preventDefault();
                    // $('.CreateRoleBtn').props('disabled',true);
                    var formdata = $(this).serialize();

                    $.ajax({
                        url: "{{ route('deletePermissionRoute') }}",
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

                });

            });
        </script>
    @endpush
