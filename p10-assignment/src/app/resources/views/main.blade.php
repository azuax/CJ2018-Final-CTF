<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Assignment Submission</title>


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: "Open sans", "Segoe UI", "Segoe WP", Helvetica, Arial, sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <img src="img/logo.png" width="10%" height="10%">
                <div class="title m-b-md">
                    Assignment Submission
                </div>
                <p>Please upload all of your exploit (.c/.cpp/.py/.sh) as archive (.tar/.zip/.phar)</p>
                <form class="form" method="POST" action="" enctype="multipart/form-data" id="form">
                   <p class="file">
                    <input type="file" name="file" id="file" />
                    <label for="file">Upload Archive</label>
                  </p>
                </form>
                <p>
                    @isset($error)
                        {{ $error }}
                    @endisset

                    @isset($result)
                        <b>Submitted</b>
                        <br>
                        @foreach ($result as $key => $value)
                            <li>{{ $key }}: {{ $value }}</li>
                        @endforeach
                    @endisset
                </p>
            </div>
        </div>
        <script type="text/javascript">
          document.getElementById("file").onchange = function() {
              document.getElementById("form").submit();
          };
        </script>
    </body>
</html>
