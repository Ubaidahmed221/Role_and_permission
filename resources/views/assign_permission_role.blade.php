@extends('layout.layout')
@section('contentes')
    <div class="container mt-4">
        <h2>Manage Role</h2>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assignPermissionRoleModal">
            Assign Permission To Role
        </button>
        <div class="col-md-12 p-5">
            <div class="row">
              <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Permission</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $x = 0;
                @endphp
                @foreach ($permissionwithrole as $permissionsse)
                <tr>
                    <td>{{ ++$x }}</td>
                    <td>{{ $permissionsse->name }}</td>
                    <td>
                        @foreach ($permissionsse->role as $rolese)
                        {{ $rolese->name }} ,
                        @endforeach

                    </td>
                    <td>
                        <button class="btn btn-info" data-toggle="modal" data-target="#UpdateassignPermissionRoleModal"
                        data-id="{{ $permissionsse->id }}"
                         data-roles="{{ $permissionsse->role }}" >Edit</button>
                        <button class="btn btn-danger deletebtns" data-toggle="modal" data-target="#deleteassignPermissionRoleModal"
                        data-id="{{ $permissionsse->id }}" >Delete</button>
                    </td>
                </tr>

                @endforeach

            </tbody>
          </table>
        </div>
    </div>

        <!-- Create Permission Role Modal -->
        <div class="modal fade" id="assignPermissionRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form  id="assignPermissionRoleForm">
                        @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Assign Permission To Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label >Permission</label>
                            <select name="permission_id" class="form-control" required >
                            <option value="">Select Permission</option>
                            @foreach ($permission as $permissionss)
                            <option value="{{ $permissionss->id }}">{{ $permissionss->name }}</option>

                            @endforeach
                        </select>

                        </div>
                        <div class="form-group">
                            <label >Role</label>
                            <select name="role_id" class="form-control" required >
                            <option value="">Select Role</option>
                            @foreach ($role as $roless)
                            <option value="{{ $roless->id }}">{{ $roless->name }}</option>

                            @endforeach
                        </select>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary assignPermissionRoleBtn">Assign</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

         <!-- Update Role Modal -->
         <div class="modal fade" id="UpdateassignPermissionRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <form  id="UpdateassignPermissionRoleForm">
                     @csrf
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle"> Update Assign Permission To Role</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="form-group">
                         <label >Permission</label>
                         <select name="permission_id" id="permission_id" class="form-control" required >
                         <option value="">Select Permission</option>
                         @foreach ($permission as $permissionss)
                         <option value="{{ $permissionss->id }}">{{ $permissionss->name }}</option>

                         @endforeach
                     </select>

                     </div>
                     {{-- <div class="form-group">
                         <label >Role</label>
                         <select class="form-control" data-mdb-select-init multiple>
                         @foreach ($role as $roless)
                         <option value="{{ $roless->id }}">{{ $roless->name }}</option>
                         @endforeach
                          </select>
                     </select>

                     </div> --}}
                     {{-- <div class="form-group">
                        <div class="col-md-8 col-lg-5 d-flex justify-content-center align-items-center">
                            <div class="d-flex text-left align-items-center w-100">
                                <strong class="sl">Select Language:</strong>
                            <select id="multiple-checkboxes" multiple="multiple">
                            <option value="php">PHP</option>
                            <option value="javascript">JavaScript</option>
                            <option value="java">Java</option>

                            </select>
                            </div>
                        </div>
                     </div> --}}
                     <div class="form-group">
                        <label >Permission</label>
                        <select  id="select-option-name" class="form-control" multiple >
                        <input type="hidden" name="roles" id="select-option" class="form-control"  >
                            @foreach ($role as $roless)
                            <option data-name="{{ $roless->name }}" value="{{ $roless->id }}">{{ $roless->name }}</option>
                            @endforeach
                    </input>

                    </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary assignPermissionRoleBtn">Assign</button>
                 </div>
             </form>
             </div>
         </div>
     </div>

     {{-- Delete Role MOdal --}}
     <div class="modal fade" id="deleteassignPermissionRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <form  id="deleteassignPermissionRoleForm">
                @csrf
            <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Delete Assign Permission To Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
         <input type="hidden" name="permission_id" id="permission_delete_id">
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
</div>


    </div>
@endsection
@push('script')

<script>



    $(document).ready(function(){
        $('#assignPermissionRoleForm').submit(function(e){
            e.preventDefault();
            // $('.CreateRoleBtn').props('disabled',true);
            var formdata = $(this).serialize();

            $.ajax({
                url: "{{ route('createPermissionRole') }}",
                type: "post",
                data: formdata,
                success: function(res){
                    // $('.CreateRoleBtn').props('disabled',false);
                    if(res.success){
                        alert(res.msg);
                        location.reload();
                    }else{
                        alert(res.msg);
                    }

                }
            })

        });

        // delete permission To Rule
        $('.deletebtns').click(function(){
            var permission_id = $(this).data('id');
            console.log(permission_id);
            $("#permission_delete_id").val(permission_id);

            $('#deleteassignPermissionRoleForm').submit(function(e){
            e.preventDefault();
            // $('.CreateRoleBtn').props('disabled',true);
            var formdata = $(this).serialize();

            $.ajax({
                url: "{{ route('deletePermissionrolese') }}",
                type: "post",
                data: formdata,
                success: function(res){
                    // $('.CreateRoleBtn').props('disabled',false);
                    if(res.success){
                        alert(res.msg);
                        location.reload();
                    }else{
                        alert(res.msg);
                    }

                }
            })

        })



        })





    }); //  document ready
</script>

@endpush
