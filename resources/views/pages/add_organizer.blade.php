@extends('layouts.admin_layout')
@section('content')
{{-- <nav class="navbar bg-dark">
    <div class="container-fluid">
        <h2 class="navbar-text text-white" id="nav_text"> ADD ORGANIZER</h2>
    </div>
</nav> --}}

{{-- <nav class="navbar navbar-expand-lg navbar-dark p-3 bg-dark" id="headerNav">
    <div class="container-fluid">
      <a class="navbar-brand d-block d-lg-none" href="#">
        <h2 class="navbar-text text-white"> ADD ORGANIZER </h2>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto ">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link mx-2" href="#">
              <h2 class="navbar-text text-white">  ADD ORGANIZER </h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 mt-4" href="{{route('logout')}}">logout</a>
          </li>
        </ul>
      </div>
    </div>
</nav> --}}



    <div class="container" style="margin-top: 5rem !important">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <h4 class="title text-center">Set Up Event Organizer</h4>
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <form method="post" action="{{ route('add_new_organizer') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="txt_organizer_name" class="form-label" id="label">Organizer Name</label>
                        <input type="text" class="form-control" id="txt_organizer_name" name="txt_organizer_name">
                    </div>
                    <span class="text-danger">@error('txt_organizer_name') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn--veeticket btn-block" id="submit">Add</button>
                </div>
                <div class="col-md-3">
                </div>
            </div>

        </form>
    </div>


    <div class="container" style="margin-top: 3rem !important">
        <div class="row mb-4">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2 class="text-center mb-5">All Event Organizers</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_orgaizers as $organizers)
                            <tr>
                                <td>{{ $organizers->id }}</td>
                                <td>{{ $organizers->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            <div class="col-md-2"></div>
    </div>



@endsection
