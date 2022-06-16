Please verify your Email

<form class="form-inline my-2 my-lg-0" action="{{ route('verification.send') }}" method="post">
    @csrf
    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">resend</button>
</form>
