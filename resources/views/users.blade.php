@extends('layout.layout')
@section('contentes')
    <div class="container mt-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmodel">
            Create User
        </button>

        <div class="col-md-12">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">User Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $x = 0;
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ ++$x }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>
                                    <button data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                         data-email="{{ $user->email }}"
                                        data-role_id="{{ $user->role->id }}"
                                        class="btn btn-info editUserbtn " data-toggle="modal" data-target="#updateUser" >Edit</button>
                                    <button data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        class="btn btn-danger deletebtn"  data-toggle="modal" data-target="#deleteUser">Delete</button>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

          <!-- Create User Modal -->
          <div class="modal fade" id="addmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <form  id="add-form">
                      @csrf
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Create User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label >User Name</label>
                          <input type="text" class="form-control" name="name" placeholder="enter user Name" required >

                      </div>
                      <div class="form-group">
                          <label >User Email</label>
                          <input type="email" class="form-control" name="email" placeholder="enter user Email" required >

                      </div>
                      <div class="form-group">
                          <label > Password</label>
                          <input type="password" class="form-control" name="password" placeholder="enter  password" required >

                      </div>
                      <div class="form-group">
                        <label >Select Role</label>
                        <select name="role" required class="form-control" >
                            <option value="">Select Role </option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>

                            @endforeach

                        </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary CreateBtn">Create</button>
                  </div>
              </form>
              </div>
          </div>
      </div>
          <!-- Update User Modal -->
          <div class="modal fade" id="updateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <form  id="update-form">
                      @csrf
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Update User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="id"  id="update-id"/>
                      <div class="form-group">
                          <label >User Name</label>
                          <input type="text" class="form-control" id="update-name" name="name" placeholder="enter user Name" required >

                      </div>
                      <div class="form-group">
                          <label >User Email</label>
                          <input type="email" class="form-control" name="email" id="update-email" placeholder="enter user Email" required >

                      </div>
                      <div class="form-group">
                          <label > Password</label>
                          <input type="password" class="form-control" id="update-password" name="password" placeholder="enter  password"  >

                      </div>
                      <div class="form-group">
                        <label >Select Role</label>
                        <select name="role" id="update-role-id" required class="form-control" >
                            <option value="">Select Role </option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>

                            @endforeach

                        </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary UpdateBtn">Update</button>
                  </div>
              </form>
              </div>
          </div>
      </div>

       <!-- Delete User Modal -->
       <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
       aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <form  id="delete-form">
                 @csrf
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
               <input type="hidden" name="id"  id="delete-id"/>
               <p>Are You Want To Delete this User <b id="delete-user-name"></b>?</p>
                
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary UpdateBtn">Update</button>
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
        $('#add-form').submit(function(e){
            e.preventDefault();
            var formdata = $(this).serialize();

            $.ajax({
                url: "{{ route('CreateUsers') }}",
                type: "post",
                data: formdata,
                success: function(res){
                    alert(res.msg);
                    if(res.success){
                        location.reload();
                    }

                }
            })

        });

        // user Update
        $('.editUserbtn').click(function(){
            $('#update-id').val($(this).data('id'));
            $('#update-name').val($(this).data('name'));
            $('#update-email').val($(this).data('email'));
            $('#update-role-id').val($(this).data('role_id'));
        });
        $('#update-form').submit(function(e){
            e.preventDefault();
            var formdata = $(this).serialize();

            $.ajax({
                url: "{{ route('updateUsers') }}",
                type: "post",
                data: formdata,
                success: function(res){
                    alert(res.msg);
                    if(res.success){
                        location.reload();
                    }

                }
            })

        });
         // user Delete
         $('.deletebtn').click(function(){
            $('#delete-id').val($(this).data('id'));
            $('#delete-user-name').text('('+$(this).data('name')+')');
          
        });
        $('#delete-form').submit(function(e){
            e.preventDefault();
            var formdata = $(this).serialize();

            $.ajax({
                url: "{{ route('deleteUsers') }}",
                type: "post",
                data: formdata,
                success: function(res){
                    alert(res.msg);
                    if(res.success){
                        location.reload();
                    }

                }
            })

        });

    }); //  document ready
</script>

@endpush
