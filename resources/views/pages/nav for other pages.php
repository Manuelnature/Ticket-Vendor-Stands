<nav class="navbar navbar-expand-lg navbar-dark p-3 bg-dark" id="headerNav">
    <div class="container-fluid">
      <a class="navbar-brand d-block d-lg-none" href="#">
        {{-- <h2 class="navbar-text text-white"> {{ Str::upper($organizer_name) }}</h2> --}}
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto ">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link mx-2" href="#">
              {{-- <h6 class="navbar-text text-white mt-3"> {{ Str::upper($username) }}</h6> --}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 mt-4" href="{{ url('add_event') }}">Add New Event</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 mt-4" href="{{ url('admin') }}">All Events</a>
         </li>
          <li class="nav-item">
            <a class="nav-link mx-2 mt-4" href="{{ url('vending_point') }}">Add Vending Point</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 mt-4" href="{{route('logout')}}">logout</a>
          </li>
        </ul>
      </div>
    </div>
</nav>


======vending Point{{-- <nav class="navbar bg-dark">
  <div class="container-fluid">
      <h2 class="navbar-text text-white" id="nav_text">  {{ Str::upper($organizer_name) }}</h2>
  </div>
</nav> --}}

<nav class="navbar navbar-expand-lg navbar-dark p-3 bg-dark" id="headerNav">
  <div class="container-fluid">
    <a class="navbar-brand d-block d-lg-none" href="#">
      <h2 class="navbar-text text-white"> {{ Str::upper($organizer_name) }}</h2>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class=" collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mx-auto ">
          {{-- <li class="nav-item">
              <a class="nav-link mx-2 mt-4" href="{{ url('organizer') }}">My Events</a>
          </li> --}}
        <li class="nav-item d-none d-lg-block">
          <a class="nav-link mx-2" href="#">
            <h2 class="navbar-text text-white"> {{ Str::upper($organizer_name) }}</h2>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 mt-4" href="{{ url('organizer') }}">My Events</a>
       </li>
        <li class="nav-item">
          <a class="nav-link mx-2 mt-4" href="{{ url('vending_point') }}">Add Vending Point</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 mt-4" href="{{route('logout')}}">logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
