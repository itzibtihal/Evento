<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
    <link href="{{asset('assets/css/Welcome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script type="module" src="https://unpkg.com/ionicons@latest/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@latest/dist/ionicons/ionicons.js"></script>

     <style>
        .bg-custom-color {
    background-color: #45484a;
}

     </style>
    <title> EVENTO | Auth Section</title>
</head>

<body>

    <!-- blue circle background -->
    <div class="d-none d-md-block ball login bg-custom-color position-absolute rounded-circle "></div>

    
    <header id="header" class="fixed-top header-inner-pages">
      <div class="container d-flex align-items-center justify-content-between">

          <h1 class="logo"><a href="{{ url('/') }}">EVENTO</a></h1>

          <nav id="navbar" class="navbar">
              <ul>
                @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        
              </ul>

              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav>


      </div>
  </header>

    <!-- logo name -->
    <!-- <div class="position-absolute top-0 start-0 p-3">
        <span>
            <a href="" class="text-decoration-none fw-bold fs-5" style="color: black;"><ion-icon name="home-outline"></ion-icon> &nbsp; Home</a>
        </span>
    </div> -->

    <!-- Login Section -->
    <div class="container login__form active">
        <div class="row vh-100 w-100 align-self-center">
            <div class="col-12 col-lg-6 col-xl-6 px-5">
                <div class="row vh-100">
                    <div class="col align-self-center p-5 w-100">
                        <h3 class="fw-bolder">WELCOME BACK !</h3>
                        <p class="fw-lighter fs-6">Don't have an account, <span id="signUp" role="button" class="text-primary"> <a href="{{ route('register') }}">Sign Up</a></span></p>
                        <!-- form login section -->
                        <form method="POST" action="{{ route('login') }}" class="mt-5" >
                        @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3 @error('email') is-invalid @enderror" name="email"  id="email"  value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com" >
                                <div id="emailError" class="text-danger">
                                  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="d-flex position-relative">
                                    <input type="password" name="password" class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"" id="password" placeholder="password">
                                    
                                </div>
                                <div id="passwordError" class="text-danger">
                                  @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                                </div>
                            </div>
                            <div class="col text-center">
                                <button type="submit" class="btn btn-outline-dark btn-lg rounded-pill mt-4 w-100">Login</button>
                            </div>

                            <div class="row mb-0">
                              <div class="col-md-8 offset-md-4">
                                
  
                                  @if (Route::has('password.request'))
                                      <a class="btn btn-link" href="{{ route('password.request') }}">
                                          {{ __('Forgot Your Password?') }}
                                      </a>
                                  @endif
                              </div>
                          </div>

                        </form>

                        <p class="mt-5 text-center">Or Sign in with social platforms</p>
                        <div class="row text-center">
                            <div class="col mt-3">
                                <a href="" class="btn btn-outline-dark border-2 rounded-circle"><i class="bi bi-facebook fs-5"></i></a>
                            </div>
                            <div class="col mt-3">
                                <a href="" class="btn btn-outline-dark border-2 rounded-circle"><i class="bi bi-linkedin fs-5"></i></a>
                            </div>

                            <div class="col my-3">
                                <a href="" class="btn btn-outline-dark border-2 rounded-circle"><i class="bi bi-google fs-5"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block col-lg-6 col-xl-6 p-5">
                <div class="row vh-100 p-5">
                    <div class="col align-self-center p-5 text-center">
                        <img src="{{asset('assets/login.png')}}" class="bounce" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Section -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script>
      const signUp = document.querySelector("#signUp");
const signIn = document.querySelector("#signIn");
const passwordIcon = document.querySelectorAll('.password__icon')
const authPassword = document.querySelectorAll('.auth__password')

// when click sign up button
signUp.addEventListener('click', () => {
    document.querySelector('.login__form').classList.remove('active')
    document.querySelector('.register__form').classList.add('active')
    document.querySelector('.ball').classList.add('register')
    document.querySelector('.ball').classList.remove('login')
});

// when click sign in button
signIn.addEventListener('click', () => {
    document.querySelector('.login__form').classList.add('active')
    document.querySelector('.register__form').classList.remove('active')
    document.querySelector('.ball').classList.add('login')
    document.querySelector('.ball').classList.remove('register')
});


            document.getElementById('signupForm').addEventListener('submit', function(event) {
                let hasError = false;

                document.getElementById('firstNameError').textContent = '';
                document.getElementById('lastNameError').textContent = '';
                document.getElementById('emailError').textContent = '';
                document.getElementById('passwordError').textContent = '';
                document.getElementById('confirm-passwordError').textContent = '';
                
                let firstName = document.getElementById('first-name').value;
                let lastName = document.getElementById('last-name').value;
                let email = document.getElementById('email').value;
                let password = document.getElementById('password').value;
                let confirmPassword = document.getElementById('confirm-password').value;

                if (!firstName) {
                    document.getElementById('firstNameError').textContent = 'Please enter your first name.';
                    hasError = true;
                }
                if (!lastName) {
                    document.getElementById('lastNameError').textContent = 'Please enter your last name.';
                    hasError = true;
                }
                if (!email || !email.includes('@')) {
                    document.getElementById('emailError').textContent = 'Please enter a valid email address.';
                    hasError = true;
                }
                if (password.length < 8) {
                    document.getElementById('passwordError').textContent = 'Password must be at least 8 characters.';
                    hasError = true;
                }
                if (password !== confirmPassword) {
                    document.getElementById('confirm-passwordError').textContent = 'Passwords do not match.';
                    hasError = true;
                }

                if (hasError) {
                    event.preventDefault();
                }
            });
        

// validation form




function validateName() {
    var name = document.getElementsByName('name')[0].value.trim();
    var nameError = document.getElementById('nameError');

    if (!name) {
        nameError.innerHTML = 'Please enter your name.';
        return false;
    } else {
        nameError.innerHTML = '';
        return true;
    }
}

function validateEmail() {
    var email = document.getElementsByName('email')[0].value.trim();
    var emailError = document.getElementById('emailError');
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!email || !email.match(emailRegex)) {
        emailError.innerHTML = 'Please enter a valid email address.';
        return false;
    } else {
        emailError.innerHTML = '';
        return true;
    }
}


function validatePassword() {
    var password = document.getElementsByName('password')[0].value;
    var passwordError = document.getElementById('passwordError');

    if (!password || password.length < 6) {
        passwordError.innerHTML = 'Password must be at least 6 characters long.';
        return false;
    } else {
        passwordError.innerHTML = '';
        return true;
    }
}

function validateConfirmPassword() {
    var password = document.getElementsByName('password')[0].value;
    var confirmPassword = document.getElementsByName('Confirmpassword')[0].value;
    var confirmPasswordError = document.getElementById('confirmPasswordError');

    if (password !== confirmPassword) {
        confirmPasswordError.innerHTML = 'Passwords do not match.';
        return false;
    } else {
        confirmPasswordError.innerHTML = '';
        return true;
    }
}


function validateLoginForm() {
    var isEmailValid = validateEmail();
    var isPasswordValid = validatePassword();

    if ( isEmailValid && isPasswordValid ) {
        return true;
    } else {
        return false;
    }
}


function validateRegisterForm() {
    var isNameValid = validateName();
    var isEmailValid = validateEmail();
    var isPasswordValid = validatePassword();
    var isConfirmPasswordValid = validateConfirmPassword();

    
    if (isNameValid && isEmailValid && isPasswordValid && isConfirmPasswordValid) {
        return true;
    } else {
        return false;
    }
}



// change hidden password to visible password
for (var i = 0; i < passwordIcon.length; ++i) {
    passwordIcon[i].addEventListener('click', (i) => {
        const lastArray = i.target.classList.length - 1
        if (i.target.classList[lastArray] == 'bi-eye-slash') {
            i.target.classList.remove('bi-eye-slash')
            i.target.classList.add('bi-eye')
            i.currentTarget.parentNode.querySelector('input').type = 'text'
        } else {
            i.target.classList.add('bi-eye-slash')
            i.target.classList.remove('bi-eye')
            i.currentTarget.parentNode.querySelector('input').type = 'password'
        }
    });
}
    </script>
    <Script>
        document.addEventListener("DOMContentLoaded", function() {
            const registerForm = document.getElementById("registerForm");

            registerForm.addEventListener("submit", function(event) {
                const nameInput = document.getElementById("name");
                const nameError = document.getElementById("nameError");

                if (nameInput.value.trim() === "") {
                    nameError.textContent = "Name cannot be empty";
                    event.preventDefault(); // Prevent form submission
                } else {
                    nameError.textContent = ""; // Clear previous error messages
                }
            });
        });
    </Script>
    <script src="{{asset('asset/js/main.js')}}"></script>

</body>

</html>