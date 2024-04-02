
@extends('layout')
@section('title')
    <title>{{__('user.Register')}}</title>
@endsection
@section('meta')
    <meta name="description" content="{{__('user.Register')}}">
    <style>
        .loader {
            border: 20px solid rgba(0, 0, 0, 0.1);
            border-top: 20px solid #3498db;
            border-radius: 50%;
            width: 100px;
            height: 100px;
            animation: rotate 2s linear infinite;
            margin: 0 auto;
            margin-top: 100px;
            margin-bottom: 100px;
        }

        @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
        }

    </style>
@endsection

@section('public-content')

    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="tf__breadcrumb" style="background: url({{ asset($breadcrumb) }});">
        <div class="tf__breadcrumb_overlay">
            <div class="container">
                <div class="tf__breadcrumb_text">
                    <h1>{{__('user.Register')}} / Login</h1>
                    <ul>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->

            <!--=========================
        SIGNIN START
    ==========================-->

    <div class="tf__login_area">
        <div class="loader"></div>
    </div>

    <form action="{{ route('verifyRegister') }}" id="myForm"method="POST">
    </form>
    <!--=========================
        SIGNIN END
    ==========================-->

    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <script>


        function parseAccessToken() {
            var hash = window.location.hash.substring(1);
            var params = new URLSearchParams(hash);
            return params.get('access_token');
        }

            // Make an API request to retrieve the user's email
        function getUserEmail(accessToken) {
            return fetch('https://www.googleapis.com/oauth2/v1/userinfo?alt=json', {
                    headers: {
                    'Authorization': 'Bearer ' + accessToken
                    }
                })
                .then(response => response.json())
                .then(data => data.email)
                .catch(error => {
                console.error('Error retrieving user email:', error);
                return null;
                });
        }

            // Check if the URL contains the access token
            var accessToken = parseAccessToken();
            if (accessToken) 
            {
                getUserEmail(accessToken)
                    .then(email => {
                        console.log(email);

                        var emails = {!! json_encode($emails) !!};
                        var emailMatch = emails.includes(email);
                        console.log(emailMatch); // Log the result to console
                        if (emailMatch) {
                            console.log('true');
                            window.location.href = 'http://localhost/foodhat/main_files/login?email=' + email;
                        } else {
                            console.log('false');
                            window.location.href = 'http://localhost/foodhat/main_files/register?email=' + email;
                            // Do something if email does not match
                        }
                    });
            }
            else{
                window.location.href = 'http://localhost/foodhat/main_files/auth';
            }

    </script>

@endsection
