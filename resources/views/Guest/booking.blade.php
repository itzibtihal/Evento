<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Tooplate">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>EVENTO | Ticket Detail Page</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tooplate-artxibition.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
    <style>
        .ticket-details-page {
            text-align: center;
            padding: 20px;
        }
    
        table {
        margin: 0 auto;
        width: 80%; /* Adjust the width based on your preference */
    }
    
        h2 {
            margin-top: 20px; /* Adjust the margin based on your preference */
        }

        .custom-black-button {
        color: #000000; /* Black color */
        background-color: #ffffff; /* White background, you can adjust this as needed */
        border-color: #000000; /* Black border color */
    }

    .custom-black-button:hover {
        color: #ffffff; /* White color on hover */
        background-color: #000000; /* Black background on hover */
        border-color: #ffffff; /* White border color on hover */
    }
    .custom-invoice-button {
        color: #681111; /* Invoice button color */
        background-color: #ffffff; /* White background, you can adjust this as needed */
        border-color: #681111; /* Invoice button border color */
    }

    .custom-invoice-button:hover {
        color: #000000; /* Black color on hover */
        background-color: #681111; /* Invoice button background color on hover */
        border-color: #000000; /* Black border color on hover */
    }
    </style>
    <!--
<!--

Tooplate 2125 ArtXibition

https://www.tooplate.com/view/2125-artxibition

-->
    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->
    
    <!-- ***** Pre HEader ***** -->
    

    <!-- ***** Header Area Start ***** -->
    
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">EVEN<em>TO</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="{{ route('guest.index') }}" >Home</a></li>
                            <li><a href="{{ route('guest.event.index') }}" >Shows & Events</a></li>
                            <li><a href="{{ route('mytickets') }}" class="active"> My Tickets</a></li>
                            <li><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">logout</a>

                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** About Us Page ***** -->
    <div class="page-heading-shows-events">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Download Tickets Your Now!</h2>
                    <span>grab your ticket right now.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="ticket-details-page">
        @if ($userBookings->isEmpty())
            <h2>No booked events</h2>
            <p>Book an event now to view your details.</p>
        @else
            <h2>Your Booking Events</h2>
            <br>
        @endif
    
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Hour</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userBookings as $booking)
                    <tr>
                        <td>{{ $booking->event->title }}</td>
                        <td>{{ $booking->event->date }}</td>
                        <td>{{ $booking->event->hour }}</td>
                        <td>{{ $booking->event->lieu }}</td>
                        <td>
                            @if($booking->status === 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @elseif($booking->status === 'waiting')
                                <span class="badge bg-warning">Waiting</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('event.details', ['event' => $booking->event->id]) }}" class="btn btn-info custom-black-button">
                                <i class="fas fa-info-circle"></i> View Details
                            </a>
                            @if($booking->status === 'confirmed')
                            <a  href="{{ route('event.invoice') }}" class="btn btn-success custom-invoice-button">
                                <i class="fas fa-download"></i> Download Invoice
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
    


    <!-- *** Subscribe *** -->
    <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4>Subscribe Our Newsletter:</h4>
                </div>
                <div class="col-lg-8">
                    <form id="subscribe" action="" method="get">
                        <div class="row">
                          <div class="col-lg-9">
                            <fieldset>
                              <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address" required="">
                            </fieldset>
                          </div>
                          <div class="col-lg-3">
                            <fieldset>
                              <button type="submit" id="form-submit" class="main-dark-button">Submit</button>
                            </fieldset>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- *** Footer *** -->

    
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="address">
                        <h4>localisation</h4>
                        <span>Boulevard moulay youssef, Youssoufia, Maroc</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#">Info</a></li>
                            <li><a href="#">Venues</a></li>
                            <li><a href="#">Guides</a></li>
                            <li><a href="#">Videos</a></li>
                            <li><a href="#">Outreach</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hours">
                        <h4>Open Support</h4>
                        <ul>

                            <li>ibtihalboukhanchouch@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <p>Welcome to Evento</p>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <p class="copyright">Copyright 2024 EVENTO

                                    <br>Design: <a rel="nofollow" href="https://github.com/itzibtihal"
                                        target="_parent">itzibtihal</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="sub-footer">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="logo"><span>EVEN<em>TO</em></span></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu">
                                    <ul>
                                        <li><a href="index.html" class="active">Home</a></li>
                                        <li><a href="shows-events.html">Shows & Events</a></li>
                                        <li><a href="tickets.html">Tickets</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="social-links">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    

    <script src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/imgfix.min.js') }}"></script>
    <script src="{{ asset('assets/js/mixitup.js') }}"></script>
    <script src="{{ asset('assets/js/accordions.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>

    <!-- Global Init -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>

</html>
