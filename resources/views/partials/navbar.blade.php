<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{  route('home') }}">TOPGEAR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{  route('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{  route('home') }}">Link</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="{{ route('cars.index') }}" method="get" ">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q" value="{{ request()->q }}">
                <input type="hidden" name="category" value="{{ request()->category }}">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
