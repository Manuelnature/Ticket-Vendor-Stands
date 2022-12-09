@extends('layouts.main')
@section('content')

<div class="page-wrapper p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w400">
        <div class="card card-1">
            {{-- <div class="card-heading"></div> --}}
            <div class="card-body">
                <h2 class="title">Login Here</h2>
                {{-- <form method="POST" action="{{ route('login') }}"> --}}
                <form method="POST" action="https://virtualsolutionsgh.com/ticket_vendor/login">
                    @csrf
                    <div class="input-group">
                        <input class="input--style-1" type="text" placeholder="USERNAME" name="txt_username">
                    </div>
                    <div class="input-group">
                        <input class="input--style-1" type="password" placeholder="PASSWORD" name="txt_password">
                    </div>
                    <div class="p-t-20">
                        <button class="btn btn--radius btn--veeticket" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
