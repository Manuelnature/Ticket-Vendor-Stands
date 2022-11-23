@extends('layouts.main')
@section('content')

{{-- <div class="page-wrapper p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w680">
        <div class="card card-1">
            <div class="card-body">
                <h2 class="title">Registration Info</h2>
                <form method="POST">
                    <div class="input-group">
                        <input class="input--style-1" type="text" placeholder="NAME" name="name">
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-1 js-datepicker" type="text" placeholder="BIRTHDATE" name="birthday">
                                <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select name="gender">
                                        <option disabled="disabled" selected="selected">GENDER</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="rs-select2 js-select-simple select--no-search">
                            <select name="class">
                                <option disabled="disabled" selected="selected">CLASS</option>
                                <option>Class 1</option>
                                <option>Class 2</option>
                                <option>Class 3</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-1" type="text" placeholder="REGISTRATION CODE" name="res_code">
                            </div>
                        </div>
                    </div>
                    <div class="p-t-20">
                        <button class="btn btn--radius btn--green" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="page-wrapper p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w500">
        <div class="card card-1">
            <div class="card-body">
                <h2 class="title">Register User</h2>
                <form method="POST" action="{{ route('register_user') }}">
                    @csrf
                    <div class="input-group">
                        <input class="input--style-1" type="text" placeholder="USERNAME" name="txt_username">
                        <span class="text-danger">@error('txt_username') {{ $message }} @enderror</span>
                    </div>

                    <div class="input-group">
                        <div class="rs-select2 js-select-simple select--no-search" id="select">
                            <select name="role" id="role" onchange="display_role()">
                                <option disabled="disabled" selected="selected">REGISTER AS</option>
                                <option value="Organizer">ORGANIZER</option>
                                <option value="Vendor">VENDOR</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                        <span class="text-danger">@error('txt_password') {{ $message }} @enderror</span>
                    </div>

                    <!-- Organizer-->
                    <div class="input-group hidden" id="organizer">
                        <div class="rs-select2 js-select-simple select--no-search">
                            <select name="gender">
                                <option disabled="disabled" selected="selected">SELECT ORGANIZER NAME</option>
                                <option value="orgainzer">ORGANIZER</option>
                                <option value="vendor">VENDOR</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                        <span class="text-danger">@error('txt_password') {{ $message }} @enderror</span>
                    </div>

                     <!-- Vendor-->
                     <div class="input-group hidden" id="vendor">
                        <div class="rs-select2 js-select-simple select--no-search">
                            <select name="gender">
                                <option disabled="disabled" selected="selected">SELECT VENDING POINT</option>
                                <option>ORGANIZER</option>
                                <option>VENDOR</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                        <span class="text-danger">@error('txt_password') {{ $message }} @enderror</span>
                    </div>


                    <div class="input-group">
                        <input class="input--style-1" type="password" placeholder="PASSWORD" name="txt_password">
                        <span class="text-danger">@error('txt_password') {{ $message }} @enderror</span>
                    </div>
                    <div class="input-group">
                        <input class="input--style-1" type="number" placeholder="CONTACT" name="txt_contact">
                        <span class="text-danger">@error('txt_contact') {{ $message }} @enderror</span>
                    </div>
                    <div class="p-t-20">
                        <button class="btn btn--radius btn--veeticket" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}


<div class="page-wrapper p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w500">
        <div class="card card-1">
            <div class="card-body">
                <h2 class="title">Register User</h2>
                <form method="POST" action="{{ route('register_user') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="txt_username" class="form-label" id="label">Username</label>
                        <input type="text" class="form-control" id="txt_username" name="txt_username">
                        <span class="text-danger">@error('txt_username') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="txt_role" class="form-label" id="label">User Role</label>
                        <select class="form-select" aria-label="Default select example" name="txt_role" id="txt_role" onchange="display_role()">
                            <option disabled="disabled" selected="selected">Register as</option>
                            <option value="Organizer">Organizer</option>
                            <option value="Vendor">Vendor</option>
                        </select>
                        <span class="text-danger">@error('txt_role') {{ $message }} @enderror</span>
                    </div>

                    <div class="mb-4">
                        <div class="form-group hidden" id="organizer">
                            <label for="txt_organizer" class="form-label" id="label">Organizer</label>
                            <select class="form-select" aria-label="Default select example" name="txt_organizer" id="txt_organizer">
                                <option disabled="disabled" selected="selected">Select Organization</option>
                                @foreach ($all_organizers as $organizer)
                                    <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group hidden" id="vendor">
                            <label for="txt_vendor" class="form-label" id="label">Vending Point</label>
                            <select class="form-select" aria-label="Default select example" name="txt_vendor" id="txt_vendor">
                                <option disabled="disabled" selected="selected">Vending Point</option>
                                @foreach ($all_vending_points as $vending_point)
                                    <option value="{{ $vending_point->id }}">{{ $vending_point->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3" style="margin-top: -1rem">
                        <label for="txt_password" class="form-label" id="label">Password</label>
                        <input type="password" class="form-control" id="txt_password" name="txt_password">
                        <span class="text-danger">@error('txt_password') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="txt_contact" class="form-label" id="label">Contact</label>
                        <input type="text" class="form-control" id="txt_contact" name="txt_contact">
                        <span class="text-danger">@error('txt_contact') {{ $message }} @enderror</span>
                    </div>
                    <div class="p-t-20">
                        <button class="btn btn--radius btn--veeticket" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    function display_role() {
        var role = document.getElementById("txt_role").value;
        console.log(role);
        var organizer = document.getElementById("txt_organizer");
        var vendor = document.getElementById("txt_vendor");

        var organizer_class = organizer.classList
        var vendor_class = vendor.classList

        if (role == 'Organizer') {
            organizer_class.remove('hidden')
            organizer_class.add('visible')
            vendor_class.remove('visible')
            vendor_class.add('hidden')
            console.log("ORGAAAAAAAAA");
        }
        else if(role == 'Vendor') {
            vendor_class.remove('hidden')
            vendor_class.add('visible')
            organizer_class.remove('visible')
            organizer_class.add('hidden')
            console.log("Veeeeeeeeee");
        }
        else {
            vendor_class.add('hidden')
            organizer_class.add('hidden')
        }
    }
</script>

@endsection
