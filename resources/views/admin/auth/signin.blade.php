@extends('admin.auth.layout.master')
@section('admin.auth.section')
    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">starlight <span class="tx-info tx-normal">admin</span></div>
        <div class="tx-center mg-b-60">Professional Admin Template Design</div>
        <form method="post" action="{{route('sign-in')}}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Enter your email">
            </div><!-- form-group -->
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter your password">
                <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
            </div><!-- form-group -->
            <button type="submit" class="btn btn-info btn-block">Sign In</button>
        </form>


        <div class="mg-t-60 tx-center">Not yet a member? <a href="page-signup.html" class="tx-info">Sign Up</a></div>
    </div><!-- login-wrapper -->@endsection
