@extends('admin.auth.layout.master')
@section('admin.auth.section')
    <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">starlight <span class="tx-info tx-normal">admin</span></div>
        <div class="tx-center mg-b-60">Professional Admin Template Design</div>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter your name">
        </div><!-- form-group -->
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Enter your password">
        </div><!-- form-group -->
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Enter your email">
        </div><!-- form-group -->

        <button type="submit" class="btn btn-info btn-block">Sign Up</button>

    </div><!-- login-wrapper -->
@endsection
