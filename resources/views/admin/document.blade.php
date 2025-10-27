@extends('admin.base')
@section('title', 'Document Tracking - Management Information System')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Document Tracking</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Document Tracking</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            <div class="title-action">
                <a data-toggle="modal" href="#modal-form" class="btn btn-primary">Add Request</a>
            </div>
            <div id="modal-form" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-sm-12">
                                    <h3 class="m-t-none m-b">Request Info</h3>

                                    <form role="form" action="{{ route('admin.document-add-request') }}" method="POST">
                                        @csrf()
                                        <div class="form-group d-none">
                                            <label>ID</label>
                                            <input type="text" name="admin_id" value="{{ Auth::id() }}" class="form-control"
                                                readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Request Date</label>
                                            <input type="date" name="request_date" value="{{ date('Y-m-d') }}"
                                                class="form-control" onfocus="this.showPicker()">
                                        </div>
                                        <div class="form-group">
                                            <label>Request Type</label>
                                            <select name="request_type" class="form-control" required>
                                                <option value="Transcript of Records" selected>Transcript of Records
                                                </option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="Certificate of Graduation">Certificate of Graduation</option>
                                                <option value="Others (WIP)">Others (WIP)</option>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <label>Student ID</label>
                                                    <input type="text" name="student_id" placeholder="" class="form-control"
                                                        required>
                                                </div>

                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" name="last_name" placeholder=""
                                                        class="form-control title-case-input" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" name="first_name" placeholder=""
                                                        class="form-control title-case-input" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <label>Middle Name</label>
                                                    <input type="text" name="middle_name" placeholder=""
                                                        class="form-control title-case-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Course</label>
                                                    <input type="text" name="course" placeholder="" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Year Graduated</label>
                                                    <input type="text" name="year_graduated"
                                                        placeholder="2023 / 2024 / 2025" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>OR Number</label>
                                            <input type="text" name="or_number" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>OR Date</label>
                                            <input type="date" name="or_date" class="form-control"
                                                onfocus="this.showPicker()">
                                        </div>
                                        <div class="form-group">
                                            <label>Purpose</label>
                                            <input type="text" name="purpose" placeholder=""
                                                class="form-control title-case-input">
                                        </div>
                                        <div class="form-group">
                                            <select name="status" class="form-control" required>
                                                <option value="Pending">Pending</option>
                                                <option value="For Signing" selected>For Signing</option>
                                                <option value="For Release">For Release</option>
                                                <option value="Released">Released</option>
                                            </select>
                                        </div>

                                        <div class="form-group text-center">
                                            <button class="btn btn-sm btn-primary m-t-n-xs w-100"
                                                type="submit"><strong>Submit</strong>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInDown">

        @include('components.message')

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Document Data</h5>
                    </div>
                    <div class="ibox-content">
                        <table id="documentTable" class="table table-bordered table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="wp-10">Request Date</th>
                                    <th class="wp-10">ID</th>
                                    <th class="wp-20">Name</th>
                                    <th class="wp-2">Type of Request</th>
                                    <th class="wp-20">Purpose</th>
                                    <th class="wp-10">By</th>
                                    <th class="wp-10 text-center">Status</th>
                                    <th class="wp-20 text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td>{{  Carbon\Carbon::parse($d->request_date)->format('M d, Y') }}</td>
                                        <td> @shorten($d->student_id, 50) </td>
                                        <td> {{ $d->last_name }}, {{ $d->first_name }} {{ $d->middle_name }} </td>
                                        <td> {{ $d->request_type }} </td>
                                        <td> {{ $d->purpose }} </td>

                                        <td> {{ $d->username }} </td>
                                        @php
                                            $statusClass = match ($d->status) {
                                                'For Release' => 'success',
                                                'For Signing' => 'info',
                                                'On Process' => 'primary',
                                                default => 'info',
                                            };
                                        @endphp
                                        <td class="text-center">
                                            <H3><span class="label label-{{ $statusClass }}">{{ $d->status }}</span></H3>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.document-view', ['id' => $d->dr_id]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye text-white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="wp-10">Request Date</th>
                                    <th class="wp-10">ID</th>
                                    <th class="wp-20">Name</th>
                                    <th class="wp-10">Type of Request</th>
                                    <th class="wp-20">Purpose</th>
                                    <th class="wp-10">By</th>
                                    <th class="wp-20 text-center">Status</th>
                                    <th class="wp-20 text-center">View</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function () {
            $('#documentTable').DataTable({
                language: {
                    zeroRecords: "No Request Found"
                },
                pageLength: 25,
                order: [],
                responsive: true,
                columnDefs: [{
                    'orderable': false,
                    'targets': [5, 6]
                }],
                initComplete: function () {
                    const api = this.api();
                    if (api.data().count() > 0) {
                        api.columns([3, 5])
                            .every(function () {
                                var column = this;

                                var select = $('<select style="width: 100%;"><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        column
                                            .search($(this).val(), {
                                                exact: true
                                            })
                                            .draw();
                                    });

                                column
                                    .data()
                                    .unique()
                                    .sort()
                                    .each(function (d, j) {
                                        select.append(
                                            '<option value="' + d + '">' + d + '</option>'
                                        );
                                    });
                            });
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Target all input elements that have the class 'title-case-input'
            const inputs = document.querySelectorAll('.title-case-input');

            inputs.forEach(input => {
                input.addEventListener('input', function (event) {
                    const currentInput = event.target;
                    const originalValue = currentInput.value;

                    // 1. Trim leading/trailing whitespace and convert the whole string to lowercase.
                    //    We use .trimEnd() to allow a user to type a space to start the next word.
                    const cleanedValue = originalValue.trimEnd().toLowerCase();

                    // 2. Split the string by one or more whitespace characters (\s+).
                    //    This correctly handles single spaces, multiple spaces, etc.
                    const words = cleanedValue.split(/\s+/);

                    // 3. Map over the words and apply Title Case
                    const titleCaseWords = words.map(word => {
                        // If the word has content, capitalize the first letter and rejoin the rest.
                        if (word.length > 0) {
                            return word.charAt(0).toUpperCase() + word.slice(1);
                        }
                        return word; // Returns an empty string if there was extra whitespace
                    });

                    // 4. Rejoin the words with a single space.
                    let titleCaseValue = titleCaseWords.join(' ');

                    // 5. Preserve trailing space from original input if the user just typed it.
                    // This is critical for typing: "John" -> space -> "Mark"
                    if (originalValue.endsWith(' ') && originalValue.trim() !== '') {
                        titleCaseValue += ' ';
                    }

                    // 6. Update the input field only if the value is different.
                    if (currentInput.value !== titleCaseValue) {
                        // Preserve the cursor position if the change is internal (e.g., just changing case)
                        const cursorPosition = currentInput.selectionStart;
                        currentInput.value = titleCaseValue;
                        currentInput.setSelectionRange(cursorPosition, cursorPosition);
                    }
                });
            });
        });
    </script>
@endsection