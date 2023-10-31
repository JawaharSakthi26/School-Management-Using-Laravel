@extends('layouts.auth')
@section('title', 'PreSkool | My Calendar')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Events</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Events</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col"></div>
                    <div class="col-auto text-end float-end ms-auto">
                        <a href="{{ route('event.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $eventCategory = ['Academic Events', 'Extracurricular Activities', 'Social and Cultural Events', 'Community and Charity Events', 'Parent and Family Engagement', 'Special Celebrations'];
            @endphp

            <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eventModalLabel">Add Event</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="eventForm">
                                <div class="mb-3">
                                    <label for="eventTitle" class="form-label">Event Title:</label>
                                    <input type="text" class="form-control" id="eventTitle" required>
                                </div>
                                <div class="mb-3">
                                    <label for="eventCategory" class="form-label">Event Category:</label>
                                    <select class="form-select" name="category" id="eventCategory" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($eventCategory as $index => $event)
                                            <option value="{{ $index + 1 }}">{{ $event }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{ Auth::user()->id }}" id="user_id">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-success" id="saveEventBtn">Create event</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <footer>
            <p>Copyright © 2022 Dreamguys.</p>
        </footer>
    </div>
    </div>

    <script>
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
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    $('#eventModal').modal('show');

                    $('#saveEventBtn').on('click', function() {
                        var title = $('#eventTitle').val();
                        var category = $('#eventCategory').val();
                        var user_id = $('#user_id').val();

                        if (title && category) {
                            var title = title;
                            var startFormatted = moment(start, 'DD.MM.YYYY').format(
                                'YYYY-MM-DD');
                            var endFormatted = moment(end, 'DD.MM.YYYY').format('YYYY-MM-DD');
                            var category = category;
                            var user_id = user_id;
                            $.ajax({
                                type: 'POST',
                                url: '{{ route('event.store') }}',
                                data: 'title=' + title + '&start=' + startFormatted +
                                    '&end=' + endFormatted + '&category=' + category +
                                    '&user_id=' + user_id + '&_token=' +
                                    "{{ csrf_token() }}",
                                type: "post",
                                success: function(data) {
                                    console.log(data);
                                    $('#calendar').fullCalendar('refetchEvents');
                                }
                            });
                        }
                        $('#eventModal').modal('hide');
                        $('#eventTitle').val('');
                        $('#eventCategory').val('');
                    });
                },
                eventClick: function(event) {
                    console.log(event.id);
                    var deleteMsg = confirm("Do you really want to delete?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "DELETE",
                            url: '{{ route('event.destroy', 'event.id') }}',
                            data: "&id=" + event.id + '&_token=' + "{{ csrf_token() }}",
                            success: function(data) {
                                if (parseInt(data) > 0) {
                                    $('#calendar').fullCalendar('removeEvents', event.id);
                                }
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection