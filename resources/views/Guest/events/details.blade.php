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
                            <li><a href="{{ route('guest.event.index') }}" class="active">Shows & Events</a></li>
                            <li><a href="{{ route('mytickets') }}" > My Tickets</a></li>
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
                    <h2>Tickets On Sale Now!</h2>
                    <span>Check out upcoming and past shows & events and grab your ticket right now.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="ticket-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-image">
                        <img src="{{ asset('assets/images/ticket-details.jpg') }}" alt="Event Image">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <h4>{{ $event->title }}</h4>
                        <span>{{ $event->available_tickets }} Tickets still available</span>
                        <ul>
                            <li><i class="fa fa-clock-o"></i> {{ $event->date }}  at {{ $event->hour }}</li>
                            <li><i class="fa fa-clock-o"></i> {{ $event->duration_of_event }} (h)</li>
                            <li><i class="fas fa-handshake"></i> {{ $event->organizer->organisation }} </li>
                            <li><i class="fa fa-tag"></i>{{ $event->category->name }}</li>
                            <li><i class="fa fa-map-marker"></i>{{ $event->lieu }}</li>
                        </ul>
                        
                        <div class="quantity-content">
                            <div class="left-content">
                                <h6>Standard Ticket</h6>
                                <p>${{ $event->ticket_price }} per ticket</p>
                            </div>
                            <div class="right-content">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" step="1" min="1" max="1" name="quantity" value="1" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode="">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>
                        </div>
                        
                            <div class="total">
                                <h4>Total: ${{ $event->ticket_price }}</h4>
                                <div class="main-dark-button" id="purchaseTicketsBtn" data-event-id="{{ $event->id }}">
                                    <a href="#">Purchase Tickets</a>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    // Set up CSRF token for AJAX requests
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                            
                                    $('#purchaseTicketsBtn').on('click', function (e) {
                                        e.preventDefault();
                            
                                        var eventId = $(this).data('event-id');
                            
                                        // AJAX request to create a booking
                                        $.ajax({
                                            url: '{{ route("create.booking") }}',
                                            method: 'POST',
                                            data: { event_id: eventId },
                                            success: function (response) {
                                                console.log('Success:', response);
                            
                                                // Check for a specific success message or indicator in the response
                                                if (response.message === 'Booking created successfully') {
                                                    // Display a SweetAlert success 
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Booking Successful!',
                                                        text: 'Your booking has been created successfully. Check the "My Tickets" section.',
                                                    });
                                                } else if (response.error === 'Tickets are sold out.') {
                                                    
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Booking Failed!',
                                                        text: 'Tickets are sold out for this event.',
                                                    });
                                                } else if (response.error === 'You have already booked a ticket for this event.') {
                                                   
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Booking Failed!',
                                                        text: 'You have already booked a ticket for this event.',
                                                    });
                                                } else if (response.error === 'Event date and time are in the past.') {
                                                    // Display a SweetAlert 
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Booking Failed!',
                                                        text: 'The event date is in the past. Please wait for the next event.',
                                                    });
                                                }
                                            },
                                            error: function (error) {
                                                console.error('Error:', error);
                            
                                                // Display a SweetAlert error 
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Booking Failed',
                                                    text: 'An error occurred while processing your booking. Please try again.',
                                                });
                                            }
                                        });
                                    });
                                });
                            </script>
                            
                        
                        <div class="warn">
                            <p>*You Can Only Buy 1 Ticket For This Show</p>
                        </div>
                    </div>
                    
                </div>
            </div>
     <br> <br>
     <div>
        {!! $event->description !!}
    </div>
        </div>
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
