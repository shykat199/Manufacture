@extends('admin.layout.master')

@section('title','Create Raw Product')
@section('page-breadcrumb','Create Raw Product')


@section('admin.content')
    <div class="card pd-20 pd-sm-40">
        <form method="post"
              action="{{isset($getProduct) && !empty($getProduct)? route('admin.update.product',$getProduct->prefix) : route('admin.store.product')}}">
            @csrf
            <h6 class="card-body-title">Create New Raw Product</h6>

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                            <input class="form-control name" type="text" name="name"
                                   value="{{isset($getProduct) && !empty($getProduct)?$getProduct->name:'John Paul'}}"
                                   placeholder="Enter name">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product slug: <span class="tx-danger">*</span></label>
                            <input class="form-control slug" autocomplete="false" readonly type="text" name="slug"
                                   value="{{isset($getProduct) && !empty($getProduct)?$getProduct->prefix:'John Paul'}}"
                                   placeholder="Enter slug">
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Price: <span class="tx-danger">*</span></label>
                            <input class="form-control price" type="number" name="price"
                                   value="{{isset($getProduct) && !empty($getProduct)?$getProduct->price:'0.0'}}"
                                   placeholder="Enter price">
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">status: <span class="tx-danger">*</span></label>
                            <select name="status" class="form-control select2" data-placeholder="Choose status">
                                <option label="Choose country"></option>
                                <option
                                    value="{{ACTIVE_STATUS}}"{{isset($getProduct) && !empty($getProduct) && $getProduct->status == ACTIVE_STATUS ?'selected':''}}>
                                    Active
                                </option>
                                <option
                                    value="{{IN_ACTIVE_STATUS}}"{{isset($getProduct) && !empty($getProduct) && $getProduct->status == IN_ACTIVE_STATUS ?'selected':''}}>
                                    Inactive
                                </option>
                            </select>
                            @error('status')
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
@endsection

@push('admin.custom.script')
    <script>
        document.querySelector('.name').addEventListener('input', (event) => {
            document.querySelector('.slug').value = event.target.value.toLowerCase().replace(/[^\w-]+/g, '-')

        })

        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });
    </script>
@endpush
