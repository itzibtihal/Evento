<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event | Evento</title>
    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100vh;
            background-image: url("https://wallpapercave.com/wp/wp7488244.jpg");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .card {
            padding: 30px 40px;
            margin-top: 60px;
            margin-bottom: 60px;
            border: none !important;
            box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2);
        }

        .blue-text {
            color: #00BCD4;
        }

        .form-control-label {
            margin-bottom: 0;
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
            font-weight: 300;
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #00BCD4;
            outline-width: 0;
            font-weight: 400;
        }

        .btn-block {
            text-transform: uppercase;
            font-size: 15px !important;
            font-weight: 400;
            height: 43px;
            cursor: pointer;
        }

        .btn-block:hover {
            color: #fff !important;
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <script src="https://cdn.tiny.cloud/1/w6m0m285hh0drcb9qbhma571hq921g1xvecati3kn2jim3wz/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

</head>

<body>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card" style="height: 700px; overflow-y: auto;">

                    <form class="form-card" action="{{ route('events.update', $event->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <input type="hidden" name="verified" value="no">
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">

                        <div class="form-group col-sm-12 flex-column d-flex">
                            <label class="form-control-label px-3">Event Banner<span class="text-danger">*</span></label>
                            <input type="file" name="event_banner" accept="image/*" >
                        </div>

                        <!-- Add your form fields here -->
                        <div class="form-group col-sm-12 flex-column d-flex">
                            
                                <label class="form-control-label px-3">Title<span class="text-danger"> *</span></label>
                                <input type="text" name="title" value="{{ old('title', $event->title) }}">
                            
                            
                        </div>

                        <div class="form-group col-sm-12 flex-column d-flex">
                            <label class="form-control-label px-3">Description<span class="text-danger">*</span></label>
                            <textarea name="description" id="description"  rows="4">{{ old('description', $event->description) }}</textarea>
                        </div>


                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Date<span class="text-danger"> *</span></label>
                                <input type="date" name="date" value="{{ old('date', $event->date) }}" required>
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Hour<span class="text-danger"> *</span></label>
                                <input type="time" name="hour" value="{{ old('hour', $event->hour) }}" required>
                            </div>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Ticket Price<span class="text-danger">
                                        *</span></label>
                                <input type="number" name="ticket_price" value="{{ old('ticket_price', $event->ticket_price) }}">
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Lieu<span class="text-danger"> *</span></label>
                                <input type="text" name="lieu" value="{{ old('lieu', $event->lieu) }}">
                            </div>
                        </div>

                        <!-- Add more form fields -->
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Total Tickets<span class="text-danger">
                                        *</span></label>
                                <input type="number" name="total_tickets" value="{{ old('total_tickets', $event->total_tickets) }}">
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Available Tickets<span class="text-danger">
                                        *</span></label>
                                <input type="number" name="available_tickets" value="{{ old('available_tickets', $event->available_tickets) }}">
                            </div>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Category Name<span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Duration (h)<span class="text-danger">
                                        *</span></label>
                                <input type="number" name="duration_of_event" value="{{ old('duration_of_event', $event->duration_of_event) }}">
                            </div>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Status<span class="text-danger">
                                        *</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_event" value="auto-accepted"
                                        {{ old('status_event', $event->status_event) == 'auto-accepted' ? 'checked' : '' }}>
                                    <label class="form-check-label">Auto-Accepted</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_event" value="needs-acceptation"
                                        {{ old('status_event', $event->status_event) == 'needs-acceptation' ? 'checked' : '' }}>
                                    <label class="form-check-label">Needs Acceptation</label>
                                </div>
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Type<span class="text-danger"> *</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" value="online"
                                        {{ old('type', $event->type) == 'online' ? 'checked' : '' }}>
                                    <label class="form-check-label">Online</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" value="presentiel"
                                        {{ old('type', $event->type) == 'presentiel' ? 'checked' : '' }}>
                                    <label class="form-check-label">Presentiel</label>
                                </div>
                            </div>
                        </div>

                        <!-- Add more form fields -->

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
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant")),
        });
    </script>
</body>

</html>
