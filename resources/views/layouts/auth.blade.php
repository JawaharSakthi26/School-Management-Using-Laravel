<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/simple-calendar/simple-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery_datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/multiselect/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <style>
        .error-input {
            border: 1px solid red !important;
        }

        .fc-widget-content {
            background-color: #80B3FF;
        }

        .fc-sun {
            background-color: #687EFF;
        }

        .fc-day-number {
            font-size: 18px;
            color: #000;
        }

        .fc-day-header {
            color: #3D30A2;
        }

        .error-message {
            color: red;
        }
    </style>

</head>

<body>

    @if (Auth::check())
        @include('layouts.include.sidebar_and_navbar')
    @endif

    @yield('content')

    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simple-calendar/jquery.simple-calendar.js') }}"></script>
    <script src="{{ asset('assets/js/calander.js') }}"></script>
    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/jquery_datatables/datatables.js') }}"></script>
    <script src="{{ asset('assets/plugins/multiselect/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.js') }} "></script>
    <script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/mask.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    @if (Session::has('message'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.error("{{ Session::get('error') }}");
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.multi-select').select2();
            $('#datatable').DataTable();
        });
    </script>

    @if (Auth::check())
        <script>
            var categoryColors = {
                '1': 'red', 
                '2': 'blue', 
                '3': 'sky blue', 
                '4': 'purple', 
                '5': 'orange', 
                '6': 'green', 
                '7': 'gray', 
            };

            var userRole = @json(Auth::user()->roles->pluck('name')->first());

            $(document).ready(function() {
                var calendar = $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'
                    },
                    navLinks: true,
                    editable: true,
                    events: {
                        url: "calendar",
                        method: "GET"
                    },
                    displayEventTime: false,
                    eventRender: function(event, element, view) {
                        if (event.allDay === 'true') {
                            event.allDay = true;
                        } else {
                            event.allDay = false;
                        }

                        if (event.start.day() === 0) {
                            element.addClass('sunday-holiday');
                        }

                        if (event.category && categoryColors[event.category]) {
                            element.css('background-color', categoryColors[event.category]);
                        }
                    },
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end, allDay) {
                        if (userRole == 'Admin') {
                            $('#eventModal').modal('show');

                            $('#saveEventBtn').on('click', function() {
                                var title = $('#eventTitle').val();
                                var category = $('#eventCategory').val();
                                var user_id = $('#user_id').val();

                                if (title && category) {
                                    var title = title;
                                    var startFormatted = moment(start, 'DD.MM.YYYY').format(
                                        'YYYY-MM-DD');
                                    var endFormatted = moment(end, 'DD.MM.YYYY').format(
                                        'YYYY-MM-DD');
                                    var category = category;
                                    var user_id = user_id;
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ route('event.store') }}',
                                        data: 'title=' + title + '&start=' +
                                            startFormatted +
                                            '&end=' + endFormatted + '&category=' +
                                            category +
                                            '&user_id=' + user_id + '&_token=' +
                                            "{{ csrf_token() }}",
                                        type: "post",
                                        success: function(data) {
                                            console.log(data);
                                            $('#calendar').fullCalendar(
                                                'refetchEvents');
                                        }
                                    });
                                }
                                $('#eventModal').modal('hide');
                                $('#eventTitle').val('');
                                $('#eventCategory').val('');
                            });
                        }
                    },
                    eventClick: function(event) {
                        if (userRole == 'Admin') {
                            console.log(event.id);
                            var deleteMsg = confirm("Do you really want to delete?");
                            if (deleteMsg) {
                                $.ajax({
                                    type: "DELETE",
                                    url: '{{ route('event.destroy', 'event.id') }}',
                                    data: "&id=" + event.id + '&_token=' + "{{ csrf_token() }}",
                                    success: function(data) {
                                        if (parseInt(data) > 0) {
                                            $('#calendar').fullCalendar('removeEvents', event
                                                .id);
                                        }
                                    }
                                });
                            }
                        }
                    }
                });
            });
        </script>
    @endif
</body>

</html>
