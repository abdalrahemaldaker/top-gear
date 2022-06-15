@extends('layouts.app')
@section('title','Forgot Password')
@section('content')
<section class="section layout_padding">
<div class="container ">
    <div class="row center">

            <div class="card  col-md-8 ">
            <div class="card-header">
                <h1>Forgot Password</h1>
            </div>
            <div class="card-body">
              <form action="{{ route('forgot-password') }}" method="post">@csrf
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
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="someont@example.com">
                  </div>
                  <input type="submit" class="btn btn-primary" value="send">
            </form>
            </div>
          </div>
    </div>
</div>


</section>
@endsection
