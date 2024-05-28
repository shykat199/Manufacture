@extends('admin.layout.master')

@section('title','Create User')
@section('page-breadcrumb','Create User')


@section('admin.content')
    <div class="card pd-20 pd-sm-40">
        <form method="post" action="{{route('admin.store.user')}}" >
            @csrf
            <h6 class="card-body-title">Create New User</h6>
productWareHouseId
            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="John Paul" placeholder="Enter name">
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="email" name="email" value="johnpaul@yourdomain.com" placeholder="Enter email address">
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="Password" name="password" value="johnpaul@yourdomain.com" placeholder="Enter user password">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Role: <span class="tx-danger">*</span></label>
                            <select name="role" class="form-control select2" data-placeholder="Choose role">
                                <option label="Choose role"></option>
                                @foreach($allRoles as $key => $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
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
</script>
@endpush
