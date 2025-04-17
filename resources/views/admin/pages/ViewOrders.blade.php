@extends('admin.layout')

@section('content')
    <div class="content-wrapper d-flex justify-content-center" style="height: 100%;">
        <div class="container-fluid d-flex justify-content-center  w-100" style="height: 100%;">
        <div class="row mt-4 w-100">
            <div class="col-12">


                {{-- @if(session()->has('success'))
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong class="text-white">Success! {{session()->get('success')}}.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif --}}



                {{-- <a href="{{route('admin.addCategoryPage')}}" class="btn btn-dark text-light my-3 px-3 py-2 " style="font-size:18px; font-weight: 600 !important;">Add Category</a> --}}
              <div class="card" style="padding: 10px;">
                <div class="card-header">
                  <h3 class="card-title">Order Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                  <table class="table table-hover text-nowrap" id="myTable">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Order Date</th>
                        <th>Total Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Delivered</th>
                        <th>Items</th>
                      </tr>
                    </thead>

                    <tbody>
                        @php
                            $sno = 0;
                        @endphp
                        @foreach ($orders as $order)
                        @php
                            $sno++;
                        @endphp
                        <tr>
                            <td>{{$sno}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>{{$order->total_price}}</td>
                            <td>{{$order->payment_status == 0 ? "Unpaid" : "Paid"}}</td>
                            <td>{{$order->delivery_status}}</td>
                            <td>
                                @if ($order->delivery_status == "processing")
                                    <a href="{{route('admin.orderDelivered', $order->id)}}"  class="btn btn-info btn-sm" onclick="return confirm('Are you sure this product is delivered ?')" >Delivered</a>
                                @else
                                <button class="btn btn-info btn-sm" type="button" disabled >Delivered</button>
                                @endif
                            </td>
                            <td>
                              <table class="table table-hover text-nowrap">
                                <thead>
                                  <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($order->OrderDetail as $item)
                                  <tr>
                                    <td>{{$item->item_id}}</td>
                                    <td>{{$item->item_name}}</td>
                                    <td>{{$item->item_price}}</td>
                                    <td>{{$item->item_quantity}}</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </td>
                        </tr>
                        @endforeach

                        {{-- @foreach ($category as $categoryItem)
                        <tr>
                          <td>{{$categoryItem->id}}</td>
                          <td>{{$categoryItem->category_name}}</td>
                          <td>{{$categoryItem->created_at}}</td>
                          <td>{{$categoryItem->no_of_posts}}</td>
                          <td><img src="/upload_category_images/{{$categoryItem->category_image}}" alt="" style="width: 40px; height:40px; border-radius:50%;"></td>
                          <td> <a href="{{route('admin.editCategory', $categoryItem->id)}}" class="btn btn-md text-warning"><i class="fas fa-edit"></i></a> </td>
                          <td>
                            <form id="deleteForm{{$categoryItem->id}}" action="{{ route('admin.deleteCategory', $categoryItem->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-md text-danger" onclick="showDeleteModal({{ $categoryItem->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                        </tr>
                        @endforeach --}}

                    </tbody>


                </table>
            </div>
            <!-- /.card-body -->
        </div>
    {{-- {{$category->links()}} --}}
    {{-- {{ $category->links('vendor.pagination.bootstrap-4') }} --}}
        <!-- /.card -->
            </div>
          </div>
          </div>
    </div>









@endsection
