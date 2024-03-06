<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento</title>
    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100vh;
            background-image: url("https://wallpapercave.com/wp/wp7488244.jpg");
            background-repeat: no-repeat;
            background-size: 100% 100%
        }

        .card {
            padding: 30px 40px;
            margin-top: 60px;
            margin-bottom: 60px;
            border: none !important;
            box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2)
        }

        .blue-text {
            color: #00BCD4
        }

        .form-control-label {
            margin-bottom: 0
        }

        input,
        textarea,
        button {
            padding: 8px 15px;
            border-radius: 5px !important;
            margin: 5px 0px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            font-size: 18px !important;
            font-weight: 300
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #00BCD4;
            outline-width: 0;
            font-weight: 400
        }

        .btn-block {
            text-transform: uppercase;
            font-size: 15px !important;
            font-weight: 400;
            height: 43px;
            cursor: pointer
        }

        .btn-block:hover {
            color: #fff !important
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    
</head>

<body>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">

                <form class="form-card" action="{{ route('admin.events.update', ['event' => $event->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="row justify-content-between text-left">
        <div class="form-group col-sm-6 flex-column d-flex">
            <label class="form-control-label px-3">Title<span class="text-danger"> *</span></label>
            <input type="text" name="title" value="{{ $event->title }}" readonly>
        </div>

        <div class="form-group col-sm-6 flex-column d-flex">
            <label class="form-control-label px-3">Available Tickets<span class="text-danger"> *</span></label>
            <input type="number" name="available_tickets" value="{{ $event->available_tickets }}" readonly>
        </div>
    </div>

    <div class="row justify-content-between text-left">
        <div class="form-group col-sm-6 flex-column d-flex">
            <label class="form-control-label px-3">Date<span class="text-danger"> *</span></label>
            <input type="date" name="date" value="{{ $event->date }}" readonly>
        </div>

        <div class="form-group col-sm-6 flex-column d-flex">
            <label class="form-control-label px-3">Ticket Price<span class="text-danger"> *</span></label>
            <input type="number" name="ticket_price" value="{{ $event->ticket_price }}" readonly>
        </div>
    </div>

    <div class="row justify-content-between text-left">
        <div class="form-group col-sm-6 flex-column d-flex">
            <label class="form-control-label px-3">Lieu<span class="text-danger"> *</span></label>
            <input type="text" name="lieu" value="{{ $event->lieu }}" readonly>
        </div>

        <div class="form-group col-sm-6 flex-column d-flex">
            <label class="form-control-label px-3">Total Tickets<span class="text-danger"> *</span></label>
            <input type="number" name="total_tickets" value="{{ $event->total_tickets }}" readonly>
        </div>
    </div>

    
    <div class="row justify-content-between text-left">
        <div class="form-group col-sm-6 flex-column d-flex">
            <label class="form-control-label px-3">Category Name<span class="text-danger"> *</span></label>
            <input type="text" name="category_name" value="{{ $event->category->name }}" readonly>
        </div>

        <div class="form-group col-sm-6 flex-column d-flex">
            <label class="form-control-label px-3">Created By Name<span class="text-danger"> *</span></label>
            <input type="text" name="created_by" value="{{ $event->organizer->name }}" readonly>
        </div>
    </div>

    <div class="row justify-content-between text-left">
        <div class="form-group col-sm-6 flex-column d-flex">
            <label class="form-control-label px-3">Duration (h)<span class="text-danger"> *</span></label>
            <input type="number" name="duration_of_event" value="{{ $event->duration_of_event }}" readonly>
        </div>

        <div class="form-group col-sm-6 flex-column d-flex">
    <label class="form-control-label px-3">Type<span class="text-danger"> *</span></label>
    <input type="text" name="type" class="form-control" value="{{ $event->type }}" readonly>
</div>

    </div>


    <div class="row justify-content-between text-left">
        <div class="form-group col-sm-6 flex-column d-flex">
            <label class="form-control-label px-3">Verified<span class="text-danger"> *</span></label>
            <select name="verified" class="form-control">
                <option value="yes" {{ $event->verified == 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ $event->verified == 'no' ? 'selected' : '' }}>No</option>
            </select>
        </div>
    </div>

    <!-- Continue adding your form fields with their respective values -->

    <div class="row justify-content-center">
        <div class="form-group col-sm-6">
            <button type="submit" class="btn-block" style="background-color: bisque;">Update Event</button>
        </div>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>