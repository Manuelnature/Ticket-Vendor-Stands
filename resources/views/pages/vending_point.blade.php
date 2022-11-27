@extends('layouts.main')
@section('content')
<nav class="navbar bg-dark">
    <div class="container-fluid">
        <h2 class="navbar-text text-white" id="nav_text">  {{ $organizer_name }}</h2>
      {{-- <span class="navbar-text text-white">

      </span> --}}
    </div>
</nav>

    <div class="container" style="margin-top: 5rem !important">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <h4 class="title text-center">Set Up Vending Point</h4>
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <form method="post" action="{{ route('add_vending_point') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="txt_name" class="form-label" id="label">Vending Point Name</label>
                        <input type="text" class="form-control" id="txt_name" name="txt_name">
                    </div>
                    <span class="text-danger">@error('txt_name') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="txt_location" class="form-label" id="label">Location</label>
                        <input type="text" class="form-control" id="txt_location" name="txt_location">
                    </div>
                    <span class="text-danger">@error('txt_location') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-3"></div>
            </div>
            {{-- <div class="row mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="txt_user_id" class="form-label" id="label">Assign A User</label>
                        <select class="form-select" aria-label="Default select example" name="txt_user_id">
                            <option disabled selected>Select Users</option>
                            @foreach ($all_users as $users)
                                <option value="{{ $users->id }}">{{ $users->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger">@error('txt_user_id') {{ $message }} @enderror</span>
                </div>
                <div class="col-md-6"></div>
            </div> --}}

            <div class="row mb-4">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn--veeticket btn-block" id="submit">Continue</button>
                </div>
                <div class="col-md-3"></div>
            </div>

        </form>
    </div>


    <div class="container" style="margin-top: 3rem !important">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="text-center mb-5">All Vending Points</h2>
                <table id="table1" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        {{-- <th scope="col">#</th> --}}
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_vending_point as $vending_point)
                            <tr>
                                {{-- <th scope="row">{{ $vending_point->id }}</th> --}}
                                <td>{{ $vending_point->name }}</td>
                                <td>{{ $vending_point->location }}</td>
                                <td> <a href="{{ url('assign_event', $vending_point->id) }}" class="text-success">Assign Event</a> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
    </div>


    <script>
        $(document).ready(function () {
            $('#table1').DataTable({
            "responsive": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "scrollX": true,
            });
        });
    </script>

@endsection
