<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/invoice.css') }}">
</head>

<body>

    <div class = "invoice-wrapper" id = "print-area">
        <div class = "invoice">
            <div class = "invoice-container">
                <div class = "invoice-head">
                    <div class = "invoice-head-top">
                        <div class = "invoice-head-top-left text-start">
                            <img src = "{{ asset('assets/images/logo-envent.png') }}">
                        </div>
                        <div class = "invoice-head-top-right">
                            <h3>Invoice</h3>
                        </div>
                    </div>
                    <div class = "hr"></div>
                    <div class = "invoice-head-middle">
                        <div class="invoice-head-middle-left text-start">
                            <p><span class="text-bold">Date</span>: {{ $date }}</p>
                        </div>
                        <div class="invoice-head-middle-right text-end">
                            <p><span class="text-bold">Invoice No:</span> {{ $invoiceNo }}</p>
                        </div>
                    </div>
                    <div class = "hr"></div>
                    <div class = "invoice-head-bottom">
                        <div class = "invoice-head-bottom-left">
                            <ul>
                                <li class = 'text-bold'>Invoiced To:</li>
                                <li>{{ $userName }}</li>
                                <li>{{ $userEmail }}</li>

                            </ul>
                        </div>
                        <div class = "invoice-head-bottom-right">
                            <ul class = "text-end">
                                <li class='text-bold'>Pay To:</li>
                                <li>{{ $organizerName }}</li>
                                <li>{{ $organizationName }}</li>
                                <li>{{ $organizerEmail }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class = "overflow-view">
                    <div class = "invoice-body">
                        <table>
                            <thead>
                                <tr>
                                    <td class = "text-bold">Event</td>
                                    <td class = "text-bold">Date</td>
                                    <td class = "text-bold">Hour</td>
                                    <td class = "text-bold">localisation</td>
                                    <td class = "text-bold">Amount</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookedEvents as $event)
                                <tr>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->date }}</td>
                                    <td>{{ $event->hour }}</td>
                                    <td>{{ $event->lieu }}</td>
                                    <td class="text-end">${{ number_format($event->ticket_price, 2) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class = "invoice-body-bottom">
                            <div class = "invoice-body-info-item border-bottom">
                                <div class = "info-item-td text-end text-bold">Sub Total:</div>
                                <div class = "info-item-td text-end">${{ number_format($ticketPrice, 2) }}</div>
                            </div>
                            <div class = "invoice-body-info-item border-bottom">
                                <div class = "info-item-td text-end text-bold">Tax:</div>
                                <div class = "info-item-td text-end">$0.00</div>
                            </div>
                            <div class = "invoice-body-info-item">
                                <div class = "info-item-td text-end text-bold">Total:</div>
                                <div class = "info-item-td text-end">${{ number_format($ticketPrice, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "invoice-foot text-center">
                    <p><span class = "text-bold text-center">NOTE:&nbsp;</span>This is computer generated receipt and
                        does not require physical signature.</p>

                    <div class = "invoice-btns">
                        <button type = "button" class = "invoice-btn" onclick="printInvoice()">
                            <span>
                                <i class="fa-solid fa-print"></i>
                            </span>
                            <span>Print</span>
                        </button>
                        <button type = "button" class = "invoice-btn">
                            <span>
                                <i class="fa-solid fa-download"></i>
                            </span>
                            <span>Download</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/invoice.js') }}"></script>
</body>

</html>
