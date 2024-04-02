
@extends('layout')
@section('title')
    <title>{{__('user.Login')}}</title>
@endsection
@section('meta')
    <meta name="description" content="{{__('user.Login')}}">
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
                        
                        <form id = "loginForm" action="{{ route('store-login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="tf__login_imput">
                                        <input type="hidden" type="email" name="email"id="email" value="dhiraj@gmail.com">
                                    </div>
                                </div>

                                
                            </div>
                        </form>
    <!--=========================
        SIGNIN END
    ==========================-->

    <script>
        function isValidEmail(email) {
            // Regular expression for validating an email address
            var emailRegex = /\S+@\S+\.\S+/;
            return emailRegex.test(email);
        }

        // Function to get email address from the URL
        function getEmailFromURL() {
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('email');
        }

        // Function to handle form submission
        function submitForm() {
            var email = getEmailFromURL();
            if (email && isValidEmail(email)) {
                // Set the email value to the hidden input field
                console.log(email);
                document.getElementById('email').value = email;
                // Submit the form
                document.getElementById('loginForm').submit();
            } else {
                // Redirect to the authentication page
                window.location.href = 'http://localhost/foodhat/main_files/auth';
            }
        }

        // Call the submitForm function when the page loads
        window.onload = function() {
            submitForm();
        };
    </script>

@endsection
