<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>




    <!DOCTYPE html>
    <html lang="en">


    <head>
        <title>Soft Delete Data Table</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


        <style>
            .bordered-box {
                border: 1px solid #007bff;
                border-radius: 5px;
                padding: 20px;
                margin: 20px auto;
                max-width: 1000px;
                /* Adjust width as needed */
            }
        </style>

    </head>

    <body>

        <div class="container mt-5">

            <div class="bordered-box">
                <h2>Soft Delete Data Table</h2>



                <div style="margin-bottom: 21px; padding:0px;"> <a class="btn btn-secondary btn-sm pl-4 pr-4"
                        href="{{ URL::to('pds') }}">
                        <i class="fa fa-backward backIcon" aria-hidden="true"></i>
                        <span id="backWritten"> Back to Personal Data Record </span>
                    </a>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Age</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pds as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->fullName }}</td>
                                <td>{{ $record->email }}</td>
                                <td>{{ $record->phone }}</td>
                                <td>{{ $record->address }}</td>
                                <td>{{ $record->age }}</td>
                                <td>{{ $record->deleted_at }}</td>

                                <td>
                                    <div style="width:120px">
                                        <!-- Restore Button -->
                                        <form action="{{ route('restore', ['id' => $record->id]) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-icon-only btn-info tooltips"
                                                style="padding: 1px 6px; margin-bottom: 2px; width: 31px; height: 30px;"
                                                title="Restore">
                                                <i class="fa fa-recycle" style="margin-right: -2px;"></i>

                                            </button>
                                        </form>

                                        <!-- Delete Button -->
                                        <form action="{{ route('forceDelete', ['id' => $record->id]) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-xs btn-icon-only btn-danger tooltips vcenter delete"
                                                style="padding: 1px 6px; margin-bottom: 2px; width: 31px; height: 30px;"
                                                title="Permanently Delete">
                                                <i class="fa fa-trash" style="margin-right: -2px;"></i>
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </body>

    </html>


</x-app-layout>
