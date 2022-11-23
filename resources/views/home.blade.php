<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Promo Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        #logo{
                width: 300px !important;
            }

        #submit{
            width: 100px;
            font-size: 20px;
            margin-left: 300px;
            padding: 3px 12px 6px 12px;
            background-color: #4F2B74;
            border: none;
        }

        #terms{
            background-color: #4F2B74;
            border: none;
        }

        #label {
            color: #4F2B74;
        }

        @media screen and (max-width: 69.5em) {
            #logo{
                width: 200px !important;
            }

            #submit{
                margin-left: 220px;
            }
        }
    </style>
  </head>
  <body>
    <div class="container" style="margin-top: 3rem !important">
        <img src="img/vee_logo.png" class="rounded mx-auto d-block" id="logo" alt="..."><br/><br/>
        <form method="post" action="{{ route('subscribe') }}">
            @csrf
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="txt_name" class="form-label" id="label">Full Name</label>
                        <input type="text" class="form-control" id="txt_name" name="txt_name">
                    </div>
                    <div class="mb-3">
                        <label for="txt_email" class="form-label" id="label">Email address</label>
                        <input type="email" class="form-control" id="txt_email" aria-describedby="emailHelp" name="txt_email">
                        {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                    </div>
                    <div class="mb-3">
                        <label for="txt_phone_number" class="form-label"id="label">Telephone Number</label>
                        <input type="number"  class="form-control" id="txt_phone_number" name="txt_phone_number">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" value="Agreed" checked>
                        <label class="form-check-label" for="terms" id="label">I agree to your <a href="https://veetickets.com/Home/Terms">Terms & Conditions</a></label>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
