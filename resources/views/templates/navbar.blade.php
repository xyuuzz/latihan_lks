<nav class="navbar navbar-expand-lg navbar-light bg-light container">
  <a class="navbar-brand" href="#">XXI Coorporation</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route("index") }}">Home<span class="sr-only">(current)</span></a>
      </li>
      @if( Auth::user()?->role === "admin" )
        <li class="nav-item">
            <a class="nav-link" href="{{ route("movie.index") }}">Daftar Film</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Kelola Cabang & Studio
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route("branch.index") }}">Cabang</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route("schedule.index") }}">Jadwal Studio</a>
                <a class="dropdown-item" href="{{ route("studio.index") }}">Studio</a>
            </div>
        </li>
      @endif
    </ul>

    @if(Auth::check())
        <div class="nav-item">
            <a class="text-dark" href="{{ route("logout") }}">Logout</a>
        </div>
    @else
        <div class="nav-item">
            <a class="text-dark" href="{{ route("login") }}">Login</a>
        </div>
    @endif
  </div>
</nav>
