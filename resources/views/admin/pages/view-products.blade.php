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

{{--
                    @if(session()->has('success'))
                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <strong class="text-white">Success! {{session()->get('success')}}.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif --}}


                    {{-- @if(Session::has('success'))
                    <div class="border border-light p-5">
                        <script>
                            toastr.options = {
                                "progressBar" : true,
                                "closeButton" : true
                            };
                            toastr.success('{{Session::get("success")}}', 'Success!', {timeOut:1200000});
                        </script>
                    </div>
                @endif --}}




                      <div class="btn-box text-right">
                          <a href="{{route('admin.addProductPage')}}" class="btn btn-dark text-light my-3 px-3 py-2 " style="font-size:18px; font-weight: 600 !important;">Add</a>
                    </div>


                  <div class="card" style="padding: 10px;">
                    <div class="card-header">
                      <h3 class="card-title">Products Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="margin-bottom: 4rem">
                      <table class="table text-nowrap" id="myTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Actions</th>
                              </tr>
                        </thead>
                        <tbody>

                            @foreach ($products as $product )

                         <tr>
                            <td>
                                <img src="{{file_exists(public_path('upload_product_images/'.$product->product_image))
                                ? asset('upload_product_images/' . $product->product_image)
                                : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjf8KEchalHXDschnJIH0wZGSC9iM5BuSLZQ&s' }}" alt="" style="width: 40px; height: 40px; border-radius:50px;">
                            </td>
                            <td>{{$product->product_title}}</td>
                            {{-- <td>{{$product->category->category_name}}</td> --}}
                            <td>{{$product->category ? $product->category->category_name : 'No Category'}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->price}}</td>
                            <td> {{$product->discount_price ? "$product->discount_price%" : 'No Discount'}}</td>


                                <td>
                                    <div class="d-inline">
                                    <a href="{{route('admin.productDetail', $product->id)}}" class="text-white mr-2"><i class="fas fa-eye text-white"></i></a>
                                    </div>
                                    <div class="d-inline">
                                    <a href="{{route('admin.editProductPage', $product->id)}}" class="text-white ml-2"><i class="fas fa-edit text-white"></i></a>
                                    </div>
                                    <div class="d-inline">
                                        <form id="deleteForm{{$product->id}}" action="{{route('admin.deleteProduct', $product->id)}}" method="post" class="d-inline">
                                            @csrf
                                            @method("DELETE")
                                        <button type="button" class="btn btn-md text-danger" onclick="showDeleteModal({{ $product->id }})">
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
            Are you sure you want to delete this Product? This action cannot be undone.
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
        </div>
    </div>


<script>
function showDeleteModal(categoryId) {
    // Show the modal
    $('#deleteModal').modal('show');

    // When the delete button in the modal is clicked, submit the form
    document.getElementById('confirmDeleteButton').onclick = function () {
        document.getElementById('deleteForm' + categoryId).submit();
    };
}
</script>



@endsection
