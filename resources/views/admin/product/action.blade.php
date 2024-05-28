@extends('admin.layout.master')

@section('title','Create Product')
@section('page-breadcrumb','Create Product')


@section('admin.content')
    <div class="card pd-20 pd-sm-40">
        <form method="post" action="{{route('admin.warehouse.product.store')}}" >
            @csrf
            <h6 class="card-body-title">Create New Product</h6>

            <div class="form-layout">
                <div class="row mg-b-25">

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Raw Product: <span class="tx-danger">*</span></label>
                            <select name="rawProductId" class="form-control select2 rawProductId" data-placeholder="Choose product">
                                <option label="Choose product"></option>
                                @if(!empty($allRawProducts))
                                    @foreach($allRawProducts as $key => $product)
                                        <option {{isset($getProductLists) && !empty($getProductLists->product_id) && $getProductLists->product_id == $product->id ?'selected':'' }}  value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                @endif
                                @error('rawProductId')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </select>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                            <select name="rawProductSize" class="form-control select2" data-placeholder="Choose product size">

                            </select>
                            @error('rawProductSize')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Product qty: <span class="tx-danger">*</span></label>
                            <input class="form-control" value="{{isset($getProductLists) && !empty($getProductLists) ? $getProductLists->product_qty:''}}" name="productQty" placeholder="Product qty" type="number">
                            @error('productQty')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div><!-- col-4 -->

                </div><!-- row -->

                <div class="row mg-b-25">

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Product Weight: <span class="tx-danger">*</span></label>
                            <input class="form-control" value="{{isset($getProductLists) && !empty($getProductLists) ? $getProductLists->product_weight:''}}" name="productWeight" placeholder="Product weight" type="number">
                            @error('productWeight')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Product Price: <span class="tx-danger">*</span></label>
                            <input class="form-control" value="{{isset($getProductLists) && !empty($getProductLists) ? $getProductLists->product_price:''}}" name="productPrice" placeholder="Product price" type="number">
                            @error('productPrice')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Product Total Price: <span class="tx-danger">*</span></label>
                            <input class="form-control" value="{{isset($getProductLists) && !empty($getProductLists) ? $getProductLists->product_total_price:''}}" name="productTotalPrice" placeholder="Product Total price" type="number">
                            @error('productTotalPrice')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div><!-- row -->

                <div class="row mg-b-25">

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Product Warehouse: <span class="tx-danger">*</span></label>
                            <select name="productWareHouseId" class="form-control select2 productWareHouseId" data-placeholder="Choose product warehouse">
                                <option label="Choose product warehouse"></option>
                                @if(!empty($allProductWareHouse))
                                    @foreach($allProductWareHouse as $key => $warehouse)
                                        <option {{isset($getProductLists) && !empty($getProductLists->product_ware_house) && $getProductLists->product_ware_house == $warehouse->id ?'selected':'' }} value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('productWareHouseId')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Product Warehouse Rack: <span class="tx-danger">*</span></label>
                            <select name="productWareHouseRackId" class="form-control select2" data-placeholder="Choose product warehouse rack">

                            </select>
                            @error('productWareHouseRackId')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div><!-- col-4 -->


                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5">Submit</button>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
        </form>

    </div>
@endsection

@push('admin.custom.script')
    <script>
        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });

        @if(isset($getProductLists) && !empty($getProductLists))
        let productId ='{{$getProductLists->product_id}}'
        let url = '{{route('admin.warehouse.product.size',['id' => ':id'])}}'
        url= url.replace(':id',productId)
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                let productSize = response.data
                if(productSize[0].product){
                    document.querySelector('input[name="productPrice"]').value = productSize[0].product.price
                }

                let optionHtml =''
                optionHtml+=`<option label="Choose product"></option>`
                Object.values(productSize).forEach((size)=>{
                    optionHtml+=` <option ${productId == size.id ? 'selected':''} value="${size.id}">${size.productSize}</option>`
                })

                document.querySelector('select[name="rawProductSize"]').insertAdjacentHTML('afterbegin',optionHtml)

                document.querySelector('input[name="productQty"]').addEventListener('keyup',(event)=>{
                    let productQty = document.querySelector('input[name="productQty"]').value
                    let productPrice = document.querySelector('input[name="productPrice"]').value
                    let productTotalPrice = document.querySelector('input[name="productTotalPrice"]')
                    if(productQty && productPrice){
                        productTotalPrice.value = parseInt(productQty) * parseInt(productPrice)
                    }
                })

            }
        });

        let warehouseId ='{{$getProductLists->product_ware_house}}'
        let warehouseRackId ='{{$getProductLists->rack}}'
        let warehouseUrl = '{{route('admin.product.warehouse.rack',['id' => ':id'])}}'
        warehouseUrl= warehouseUrl.replace(':id',warehouseId)
        $.ajax({
            type: "GET",
            url: warehouseUrl,
            success: function (response) {
                let productSize = response.data

                let optionHtml =''
                optionHtml+=`<option label="Choose size"></option>`
                Object.values(productSize).forEach((size)=>{
                    optionHtml+=` <option ${warehouseRackId == size.id ? 'selected':''} value="${size.id}">${size.rack}</option>`
                })

                document.querySelector('select[name="productWareHouseRackId"]').insertAdjacentHTML('afterbegin',optionHtml)

            }
        });

        @endif

        // document.querySelector('input[name="userId"]').value = data.data.id
        $(document).on('change','.rawProductId',function (event){
           let productId =$(this).val();
           let url = '{{route('admin.warehouse.product.size',['id' => ':id'])}}'
            url= url.replace(':id',productId)
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    let productSize = response.data
                    if(productSize[0].product){
                        document.querySelector('input[name="productPrice"]').value = productSize[0].product.price
                    }

                    let optionHtml =''
                    optionHtml+=`<option label="Choose product"></option>`
                    Object.values(productSize).forEach((size)=>{
                        optionHtml+=` <option value="${size.id}">${size.productSize}</option>`
                    })

                    document.querySelector('select[name="rawProductSize"]').insertAdjacentHTML('afterbegin',optionHtml)

                    document.querySelector('input[name="productQty"]').addEventListener('keyup',(event)=>{
                        let productQty = document.querySelector('input[name="productQty"]').value
                        let productPrice = document.querySelector('input[name="productPrice"]').value
                        let productTotalPrice = document.querySelector('input[name="productTotalPrice"]')
                        if(productQty && productPrice){
                            let price = parseInt(productQty) * parseInt(productPrice)
                            productTotalPrice.value = price
                        }
                    })

                }
            });
        })

        $(document).on('change','.productWareHouseId',function (event){
            let productId =$(this).val();
            let url = '{{route('admin.product.warehouse.rack',['id' => ':id'])}}'
            url= url.replace(':id',productId)
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    let productSize = response.data

                    let optionHtml =''
                    optionHtml+=`<option label="Choose size"></option>`
                    Object.values(productSize).forEach((size)=>{
                        optionHtml+=` <option value="${size.id}">${size.rack}</option>`
                    })

                    document.querySelector('select[name="productWareHouseRackId"]').insertAdjacentHTML('afterbegin',optionHtml)

                }
            });
        })
    </script>
@endpush
