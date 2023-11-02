@extends('layouts.app')
@section('content')
    <link href="{{ asset('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables.net-colreorder-bs5/css/colReorder.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables.net-rowreorder-bs5/css/rowReorder.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" />

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="table-basic-9">
            <!-- BEGIN panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title">Get In Touch</h4>

                <form action="{{ route('contact.us.export') }}" method="post">
                    @csrf
                    <div class="d-sm-flex align-items-center mb-3">
                        <input type="date" name="start_date" value="YYYY-MM-DD" style="display: none" id="dr">
                        <input type="date" name="end_date" value="YYYY-MM-DD" style="display: none" id="de">
                        <a href="#" class="btn btn-dark me-2 text-truncate" id="daterange-filter">
                            <i class="fa fa-calendar fa-fw text-white text-opacity-50 ms-n1"></i>
                            <span>1 Jun 2021 - 7 Jun 2021</span>
                            <b class="caret ms-1 opacity-5"></b>
                        </a>

                        <button class="btn btn-primary" type="submit">Export Data</button>
                    </div>
                </form>
                {{-- <div class="d-sm-flex align-items-center mb-3">
                    <a href="#" class="btn btn-dark me-2 text-truncate" id="daterange-filter">
                        <i class="fa fa-calendar fa-fw text-white text-opacity-50 ms-n1"></i>
                        <span>1 Jun 2021 - 7 Jun 2021</span>
                        <b class="caret ms-1 opacity-5"></b>
                    </a>
                </div> --}}
                {{-- <form action="{{ route('contact.us.export') }}" method="post">
                    @csrf
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date">

                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date">

                    <button class="btn btn-primary" type="submit">Export Data</button>
                </form> --}}
            </div>
            <!-- END panel-heading -->
            <!-- BEGIN panel-body -->
            <div class="panel-body">
                <table id="data-table-combine" class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th width="1%"></th>
                            <th width="1%" data-orderable="false">Name</th>
                            <th class="text-nowrap">Company Name</th>
                            <th class="text-nowrap">Contact Number</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Message</th>
                            <th class="text-nowrap">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($get_in_touches as $get_in_touch)
                            <tr class="odd gradeX">
                                <td width="1%" class="fw-bold text-dark">{{ $counter++ }}</td>
                                <td>{{ $get_in_touch->name }}</td>
                                <td>{{ $get_in_touch->company_name }}</td>
                                <td>{{ $get_in_touch->contact_number }}</td>
                                <td>{{ $get_in_touch->email }}</td>
                                <td>{{ $get_in_touch->message }}</td>
                                <td>
                                    @if ($get_in_touch->created_at)
                                        @if ($get_in_touch->created_at->isToday())
                                            <b style="color: green">Today</b>
                                        @elseif ($get_in_touch->created_at->isYesterday())
                                            <b style="color: orange">Yesterday</b>
                                        @else
                                            <b>{{ $get_in_touch->created_at->format('d/m/Y') }}</b>
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END panel-body -->
        </div>
        <!-- END panel -->
    </div>
    <!-- END #content -->

    <script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-colreorder/js/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-colreorder-bs5/js/colReorder.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-rowreorder/js/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-rowreorder-bs5/js/rowReorder.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-select-bs5/js/select.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/dist/jszip.min.js') }}"></script>

    <script>
        var options = {
            dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex me-0 me-md-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-md-5"i><"col-md-7"p>>>',
            buttons: [{
                    extend: 'copy',
                    className: 'btn-sm'
                },
                {
                    extend: 'csv',
                    className: 'btn-sm'
                },
                {
                    extend: 'excel',
                    className: 'btn-sm'
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm'
                },
                {
                    extend: 'print',
                    className: 'btn-sm'
                }
            ],
            responsive: true,
            colReorder: true,
            keys: true,
            rowReorder: true,
            select: true
        };

        if ($(window).width() <= 767) {
            options.rowReorder = false;
            options.colReorder = false;
        }
        $('#data-table-combine').DataTable(options);
    </script>
@endsection
