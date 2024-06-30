@extends('layout.layout')
@section('contentes')
    <div class="container mt-4">
        <h2>Manage Permission</h2>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPermissionModal">
            Create Permission
        </button>
        <div class="col-md-12">
            <div class="row">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Permission</th>
                <th scope="col">Action</th>

              </tr>
            </thead>
            <tbody>
                @php
                    $x = 0
                @endphp
                @foreach ($permission as $permission)
                <tr>
                  <th scope="row">{{ ++$x }}</th>
                  <td>{{ $permission->name }}</td>
                  <td>
                    <button class="btn btn-primary updatepermissionEditbtn" data-id="{{ $permission->id }}" data-name="{{ $permission->name }}" data-toggle="modal" data-target="#updatePermissionModal" >Edit</button>
                    <button class="btn btn-danger DeletePermissionModal" data-id="{{ $permission->id }}" data-name="{{ $permission->name }}" data-toggle="modal" data-target="#DeletePermissionModal"  >Delete</button>
                  </td>
                </tr>

                @endforeach

            </tbody>
          </table>
        </div>
    </div>

        <!-- Create Permmission Modal -->
        <div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="createPermissionForm">
                    @csrf <!-- Laravel CSRF directive -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Create Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Permission</label>
                            <input type="text" class="form-control" name="permission_name" placeholder="Enter permission" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary CreatePermissionBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

         <!-- Update Permission Modal -->
      <div class="modal fade" id="updatePermissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <form  id="updatePermission">
                     @csrf
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Update Permission</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="form-group">
                         <label >Permission</label>
                         <input type="text" class="form-control" name="permission" placeholder="enter permission" id="updatepermissionName" required >
                         <input type="hidden" name="permission_id" id="updatepermissionid" >

                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary UpdatepermissionBtn">Update </button>
                 </div>
             </form>
             </div>
         </div>
     </div>

      <!-- Delete Modal -->
  <div class="modal fade" id="DeletePermissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="deleteform">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Permission</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="Permission_id" id="deletePermissionId" >
            <p>Are You Sure, You Want To Delete The <span class="delete-Permission"></span> Permission?,
            If you will Delete this permission, then this is deleted from All Users. </p>
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
    $(document).ready(function(){
        $('#createPermissionForm').submit(function(e){
        e.preventDefault();

        var token = $('meta[name="csrf-token"]').attr('content');
        var formdata = $(this).serialize();
        console.log(formdata);

        $.ajax({
            url: "{{ route('createPermission') }}",
            type: "post",
            data: formdata + "&_token=" + token, // Append CSRF token to form data
            success: function(res){
                if(res.success){
                    alert(res.msg);
                    location.reload();
                }else{
                    alert(res.msg);
                }
            }
        });
     });

        $('.DeletePermissionModal').click(function(){
        var   $permissionid = $(this).data('id');
          var $permissionname = $(this).data('name');

          $('.delete-Permission').text($permissionname)
          $('#deletePermissionId').val($permissionid)

          $('#deleteform').submit(function(e){
            e.preventDefault();
            // $('.CreateRoleBtn').props('disabled',true);
            var formdata = $(this).serialize();

            $.ajax({
                url: "{{ route('deletePermission') }}",
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


   });
        $('.updatepermissionEditbtn').click(function(){
            var permissionId = $(this).data('id');
          var permissionName =  $(this).data('name');

          $('#updatepermissionName').val(permissionName);
          $('#updatepermissionid').val(permissionId);

        });
        $('#updatePermission').submit(function(e){
            e.preventDefault();
            // $('.CreateRoleBtn').props('disabled',true);
            var formdata = $(this).serialize();

            $.ajax({
                url: "{{ route('updatePermission') }}",
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



    }); //  document ready
</script>

@endpush
