@extends('admin.layout.master')

@section('title','Create Product Size')
@section('page-breadcrumb','Create Product Size')


@section('admin.content')
    <div class="card pd-20 pd-sm-40">
        <form method="post" action="{{isset($productSizeDetails) && !empty($productSizeDetails)? route('admin.update.raw.product.size',[$productSizeDetails->id]) :route('admin.store.product.size')}}">
            @csrf
            <h6 class="card-body-title">Create Product Size</h6>

            <div class="form-layout">
                <div class="row mg-b-25">

                    <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Product List: <span class="tx-danger">*</span></label>
                            <select name="product" class="form-control select2" data-placeholder="Choose product">
                                <option label="Choose product"></option>
                                @foreach($rawProduct as $product)

                                    <option label="Choose country" {{isset($productSizeDetails) && !empty($productSizeDetails) && $productSizeDetails ->product_id == $product->id ? 'selected':''}}
                                            value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                            @error('product')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                            <input class="form-control price" type="number" name="size"
                                   value="{{isset($productSizeDetails) && !empty($productSizeDetails)?$productSizeDetails->productSize:'0'}}"
                                   placeholder="Enter size">
                            @error('size')
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
                    <th class="wd-15p">Product Name</th>
                    <th class="wd-15p">Product Size</th>
                    <th class="wd-10p">Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($rawProductSize as $key => $product)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$product->product->name}}</td>
                        <td>{{$product->productSize}}</td>
                        <td>
                            <div class="button-group">
                                <a href="{{route('admin.update.product.size',[$product->id])}}" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteUser('{{$product->id}}')"><i class="fa-solid fa-trash"></i></a>
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

                    let userDltRoute = '{{route('admin.delete.product.size',['id'=>':id'])}}'
                    userDltRoute = userDltRoute.replace(':id', id);
                    window.location = userDltRoute
                }
            });
        }

    </script>
@endpush
