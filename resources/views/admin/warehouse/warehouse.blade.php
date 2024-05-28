@extends('admin.layout.master')

@section('title','Create Ware House')
@section('page-breadcrumb','Create Ware House')


@section('admin.content')
    <div class="card pd-20 pd-sm-40">
        <form method="post" action="{{isset($productSizeDetails) && !empty($productSizeDetails)? route('admin.warehouse.update',[$productSizeDetails->id]) :route('admin.warehouse.store')}}">
            @csrf
            <h6 class="card-body-title">Create Product Warehouse</h6>

            <div class="form-layout">
                <div class="row mg-b-25">

                    <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Warehouse Name: <span class="tx-danger">*</span></label>
                            <input class="form-control price" type="text" name="name"
                                   value="{{isset($productSizeDetails) && !empty($productSizeDetails)?$productSizeDetails->name:''}}"
                                   placeholder="Enter warehouse name">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Warehouse Address: <span class="tx-danger">*</span></label>
                            <input class="form-control price" type="text" name="address"
                                   value="{{isset($productSizeDetails) && !empty($productSizeDetails)?$productSizeDetails->address:''}}"
                                   placeholder="Enter address">
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div><!-- row -->
                <div class="row mg-b-25">
                    <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Warehouse Staff: <span class="tx-danger">*</span></label>
                            <input class="form-control price" type="number" name="staff"
                                   value="{{isset($productSizeDetails) && !empty($productSizeDetails)?$productSizeDetails->staff:'0'}}"
                                   placeholder="Enter staff">
                            @error('staff')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5">Submit</button>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
        </form>
    </div>

    <div class="card pd-20 pd-sm-40 mt-1">
        <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
                <thead>
                <tr>
                    <th class="wd-15p">Id</th>
                    <th class="wd-15p">Warehouse Name</th>
                    <th class="wd-15p">Warehouse Address</th>
                    <th class="wd-15p">Warehouse Staff</th>
                    <th class="wd-10p">Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($allWareHouses as $key => $product)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->address}}</td>
                        <td>{{$product->staff}}</td>
                        <td>
                            <div class="button-group">
                                <a href="{{route('admin.warehouse.details',[$product->id])}}" class="btn btn-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteUser('{{$product->id}}')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('admin.custom.script')
    <script>

        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });
        $('#datatable1').DataTable({
            bLengthChange: true,
            searching: true,
            responsive: true
        });


        function deleteUser(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    let userDltRoute = '{{route('admin.warehouse.delete',['id'=>':id'])}}'
                    userDltRoute = userDltRoute.replace(':id', id);
                    window.location = userDltRoute
                }
            });
        }

    </script>
@endpush
