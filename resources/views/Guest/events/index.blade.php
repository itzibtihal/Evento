<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Tooplate">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <title>EVENTO | GUEST </title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl-carousel.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/tooplate-artxibition.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination ul {
            display: inline-block;
            padding: 0;
            margin: 0;
        }

        .pagination li {
            display: inline;
            margin: 0 2px;
            text-align: center;
        }

        .pagination li a,
        .pagination .disabled {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: #333;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }

        .pagination li.active a {
            background-color: #007bff;
            color: #fff;
        }
    </style>

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
                            <li><a href="{{ route('guest.index') }}">Home</a></li>
                            <li><a href="{{ route('guest.event.index') }}" class="active">Shows & Events</a></li>
                            <li><a href="{{ route('mytickets') }}"> My Tickets</a></li>
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



    <div class="tickets-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="search-box">
                        <form id="subscribe" action="" method="get">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="search-heading">
                                        <h4>Sort The Upcoming Shows & Events By:</h4>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <select value="month">
                                                <option value="month">Month</option>
                                                <option name="June" id="June">June</option>
                                                <option name="July" id="July">July</option>
                                                <option name="August" id="August">August</option>
                                                <option name="September" id="September">September</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select value="location">
                                                <option value="location">Location</option>
                                                <option name="Brazil" id="Brazil">Brazil</option>
                                                <option name="Europe" id="Europe">Europe</option>
                                                <option name="US" id="US">US</option>
                                                <option name="Asia" id="Asia">Asia</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            
                                            <select id="priceFilter" name="priceFilter">
                                                <option value="all">All</option>
                                                <option value="0-50">$0 - $50</option>
                                                <option value="50-100">$50 - $100</option>
                                                <option value="up-to-100">$100~</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <fieldset>
                                                <button type="submit" id="form-submit"
                                                    class="main-dark-button">Submit</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Tickets Page</h2>
                    </div>
                </div>
                @foreach ($events as $event)
                    <div class="col-lg-4 ticket-filtre"  data-price="{{ $event->ticket_price }}">
                        <div class="ticket-item">
                            <div class="thumb">
                                @if ($event->getFirstMediaUrl('media/events'))
                                    <img src="{{ $event->getFirstMediaUrl('media/events') }}" alt="Event Image">
                                @else
                                    <img src="{{ asset('assets/images/ticket-03.jpg') }}" alt="Default Image">
                                @endif
                                <div class="price">
                                    <span>1 ticket<br>from <em>${{ $event->ticket_price }}</em></span>
                                </div>
                            </div>
                            <div class="down-content">
                                <span>There Are {{ $event->available_tickets }} Tickets Left For This Show</span>
                                <h4>{{ $event->title }}</h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> {{ $event->date }} at {{ $event->hour }}</li>
                                    <li><i class="fa fa-map-marker"></i>{{ $event->lieu }}</li>
                                </ul>
                                <div class="main-dark-button">
                                    <a href="{{ route('event.details', ['event' => $event->id]) }}">Purchase
                                        Tickets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-lg-12">
                <div class="pagination">
                    {{ $events->links() }}
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    <script>$(document).ready(function () {
        // Add an event listener to the price filter dropdown
        $('#priceFilter').change(function () {
            // Get the selected value
            var selectedPriceFilter = $(this).val();
    
            // Filter events based on the selected price range
            filterEvents(selectedPriceFilter);
        });
    
        // Function to filter events
        function filterEvents(priceFilter) {
            // Get all event items
            var events = $('.ticket-filtre');
    
            // Show all events initially
            events.show();
    
            // Check if a price filter is selected
            if (priceFilter !== 'all') {
                // Hide events that don't match the selected price range
                events.filter(function () {
                    var eventPrice = parseFloat($(this).data('price'));
                    return !isPriceInRange(eventPrice, priceFilter);
                }).hide();
            }
        }
    
        // Function to check if a price is in the selected range
        function isPriceInRange(price, range) {
            // Handle the "max up to 100" condition
            if (range === 'up-to-100') {
                return price > 100;
            }
    
            // For other ranges, parse and compare as before
            var rangeValues = range.split('-');
            var minPrice = parseFloat(rangeValues[0]);
            var maxPrice = parseFloat(rangeValues[1]);
    
            return price >= minPrice && price <= maxPrice;
        }
    });
    
    </script>
    










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
                                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                        placeholder="Your Email Address" required="">
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

    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/imgfix.min.js') }}"></script>
    <script src="{{ asset('assets/js/mixitup.js') }}"></script>
    <script src="{{ asset('assets/js/accordions.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
