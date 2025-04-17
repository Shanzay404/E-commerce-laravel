@extends('admin.layout')

<style>
    .sno
    {
        text-align: start !important;
    }
</style>
@section('content')
    <div class="content-wrapper d-flex justify-content-center" style="height: 100%;">
        <div class="container-fluid d-flex justify-content-center  w-100" style="height: 100%;">
        <div class="row mt-4 w-100">
            <div class="col-12">



                  <div class="btn-box text-right">
                      <a href="{{url('roles/create')}}" class="btn btn-dark text-light my-3 px-3 py-2 " style="font-size:18px; font-weight: 600 !important;">Add</a>
                  </div>

              <div class="card" style="padding: 10px;">
                <div class="card-header">
                  <h3 class="card-title">Roles</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap" id="myTable">
                    <thead>
                      <tr>
                          <th class="sno">Sno</th>
                        <th>Role</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 0;
                        @endphp

                        @foreach ($roles as $role)
                            @php
                                $sno++;
                            @endphp

                        <tr>
                          <td class="sno">{{$sno}}</td>
                          <td>{{$role->name}}</td>
                          <td>
                            <div class="d-inline">
                                <a href="{{url('roles/'.$role->id."/give-permissions")}}" class="btn btn-md text-primary fw-bold">Add/Edit Permissions</a>
                            </div>
                            <div class="d-inline">
                                <a href="{{route('roles.edit', $role->id)}}" class="btn btn-md text-warning"><i class="fas fa-edit"></i></a>
                            </div>
                           <div class="d-inline">
                                <form id="deleteForm{{$role->id}}" action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-md text-danger" onclick="showDeleteModal({{ $role->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                           </div>
                        </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
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
                Are you sure you want to delete this Role? This action cannot be undone.
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
            </div>
        </div>


<script>
    function showDeleteModal(roleId) {
        // Show the modal
        $('#deleteModal').modal('show');

        // When the delete button in the modal is clicked, submit the form
        document.getElementById('confirmDeleteButton').onclick = function () {
            document.getElementById('deleteForm' + roleId).submit();
        };
    }
</script>

@endsection
