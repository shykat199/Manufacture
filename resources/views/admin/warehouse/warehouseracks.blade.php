@extends('admin.layout.master')

@section('title','Create Ware House Racks')
@section('page-breadcrumb','Create Ware House Racks')


@section('admin.content')
    <div class="card pd-20 pd-sm-40">
        <form method="post"
              action="{{isset($productSizeDetails) && !empty($productSizeDetails)? route('admin.update.raw.product.size',[$productSizeDetails->id]) :route('admin.store.warehouse.rack')}}">
            @csrf
            <h6 class="card-body-title">Create Product Warehouse Racks</h6>

            <div class="form-layout">
                <div class="row mg-b-25">

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Warehouse List: <span class="tx-danger">*</span></label>
                            <select name="ware_house_id" class="form-control select2" data-placeholder="Choose warehouse">
                                <option label="Choose warehouse"></option>
                                @foreach($allWareHouses as $product)
                                    <option label="Choose warehouse"
                                            {{isset($productSizeDetails) && !empty($productSizeDetails) && $productSizeDetails ->product_id == $product->id ? 'selected':''}}
                                            value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                            @error('ware_house_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div><!-- row -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Warehouse Rack Number: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control price" type="number" name="rack"
                                   value="{{isset($productSizeDetails) && !empty($productSizeDetails)?$productSizeDetails->rack:'0'}}"
                                   placeholder="Enter staff">
                            @error('rack')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4">
                        <button class="btn btn-info mg-r-5">Submit</button>
                    </div>


                </div><!-- form-layout -->
            </div>
        </form>
    </div>

    <div class="card pd-20 pd-sm-40 mt-1">
        <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
                <thead>
                <tr>
                    <th class="wd-15p">Id</th>
                    <th class="wd-15p">Warehouse Name</th>
                    <th class="wd-15p">Warehouse Racks</th>
                    <th class="wd-10p">Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($allWareHouseRacks as $key => $product)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$product->wareHouse->name}}</td>
                        <td>{{$product->rack}}</td>
                        <td>
                            <div class="button-group">
                                <a href="{{route('admin.update.product.size',[$product->id])}}"
                                   class="btn btn-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger"
                                   onclick="deleteUser('{{$product->id}}')"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
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


        function deleteUser(id) {
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

                    let userDltRoute = '{{route('admin.warehouse.rack.delete',['id'=>':id'])}}'
                    userDltRoute = userDltRoute.replace(':id', id);
                    window.location = userDltRoute
                }
            });
        }

    </script>
@endpush
