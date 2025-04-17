@extends('admin.layout')
<style>
    footer.main-footer{
        position: fixed !important;
    }
</style>
@section('content')
    <div class="content-wrapper d-flex justify-content-center" style="height: 100%;">
        <div class="container-fluid d-flex justify-content-center  w-100" style="height: 100%;">
            <div class="row mt-4 w-100">
                <div class="col-12">


                      <div class="btn-box text-right">
                          <a href="{{route('admin.addUser')}}" class="btn btn-dark text-light my-3 px-3 py-2 " style="font-size:18px; font-weight: 600 !important;">Add</a>
                    </div>


                  <div class="card" style="padding: 10px;">
                    <div class="card-header">
                      <h3 class="card-title">Users Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="margin-bottom: 4rem">
                      <table class="table text-nowrap" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-start">Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Roles</th>
                                <th>Actions</th>
                              </tr>
                        </thead>
                        <tbody>
                            @php
                                $sno = 0;
                            @endphp
                            @foreach ($users as $user )
                                @php
                                    $sno++;
                                @endphp
                         <tr>
                            <td>{{ $sno }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td> {{$user->usertype === "0" ? "User" : 'Admin'}}</td>
                            <td>
                                @if ($user->getRoleNames()->isEmpty())
                                    <label class="">No Role Assigned</label>
                                @else
                                    @foreach ($user->getRoleNames() as $roleName)
                                        <label class="badge badge-light">{{ $roleName }}</label>
                                    @endforeach
                                @endif
                            </td>


                                <td>
                                    {{-- <div class="d-inline">
                                    <a href="{{route('admin.productDetail', $product->id)}}" class="text-white mr-2"><i class="fas fa-eye text-white"></i></a>
                                    </div> --}}
                                    <div class="d-inline">
                                    <a href="{{route('admin.editUser', $user->id)}}" class="text-white ml-2"><i class="fas fa-edit text-primary"></i></a>
                                    </div>
                                    <div class="d-inline">
                                        <form id="deleteForm{{$user->id}}" action="{{route('admin.deleteUser', $user->id)}}" method="post" class="d-inline">
                                            @csrf
                                            @method("DELETE")
                                        <button type="button" class="btn btn-md text-danger" onclick="showDeleteModal({{ $user->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        </form>
                                    </div>
                                      </td>
                    </tr>
                          @endforeach
                        </tbody>

                    </table>
                </div>
                  <!-- /.card -->
                </div>
              </div>
          </div>
    </div>




      <!-- Bootstrap Modal for delete Category Confirmation -->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Are you sure you want to delete this User? This action cannot be undone.
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
        </div>
    </div>


<script>
function showDeleteModal(userId) {
    // Show the modal
    $('#deleteModal').modal('show');

    // When the delete button in the modal is clicked, submit the form
    document.getElementById('confirmDeleteButton').onclick = function () {
        document.getElementById('deleteForm' + userId).submit();
    };
}
</script>



@endsection
