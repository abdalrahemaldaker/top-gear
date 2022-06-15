@extends('layouts.app')
@section('title','Reset password')
@section('content')
<section class="section layout_padding">
<div class="container ">
    <div class="row center">


        <div class="card  col-md-8 ">
            <div class="card-header">
                <h1>Reset password </h1>
            </div>
            <div class="card-body">
              <form action="{{ route('password.update') }}" method="post">@csrf
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="form-group">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" class="form-control" id="email" name="email" value="{{ request()->query('email') }}">
                  </div>
                  <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="password">
                  </div>
                  <div class="form-group">
                    <label for="cpassword">Confirm password</label>
                    <input type="password" class="form-control" id="cpassword" name="password_confirmation" required placeholder="password">
                  </div>
                  <input type="submit" class="btn btn-primary" value="Login">
            </form>
            </div>
          </div>
    </div>
</div>


</section>
@endsection
