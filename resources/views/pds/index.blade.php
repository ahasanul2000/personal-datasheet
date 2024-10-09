<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>




    <!DOCTYPE html>
    <html lang="en">


    <head>
        <title>Personal Data Table</title>
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
                <h2>Personal Data Records</h2>



                <div style="margin-bottom: 21px; padding:0px;"><a class="btn btn-default btn-sm create-new"
                        style="margin-left: 20px; background-color:#00A896;color:white;" title=" Create New Trainee"
                        href="{{ URL::to('/creatPds') }}"> <i class="fa fa-plus create-new"></i></i>New Record</a>
                    <a href="{{ route('softDeleted') }}" class="btn btn-warning btn-sm">View Soft Deleted Records</a>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Age</th>
                            <th style="height: 60px;width: 82px;"> Picture</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($personalData as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->fullName }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->address }}</td>
                                <td>{{ $data->age }}</td>
                                <td> <img src="{{ asset('images/' . $data->image) }}" alt="Uploaded Image"
                                        width="150"></td>
                                <td>
                                    <div style="width:120px">
                                        <a href="{{ URL::to('/viewPdsData', ['id' => $data->id]) }}"
                                            class="btn btn-sm btn-icon-only btn-info tooltips"
                                            style="padding: 1px 6px; margin-bottom: 2px; width: 31px; height: 30px;"
                                            title="View" aria-label="View">
                                            <i class="fa fa-eye" style="margin-right: -2px;"></i>
                                        </a>
                                        <!-- Edit Button -->
                                        <a href="{{ URL::to('/editPds', ['id' => $data->id]) }}"
                                            class="btn btn-sm btn-icon-only btn-primary tooltips vcenter"
                                            style="padding: 1px 6px; margin-bottom: 2px; width: 31px; height: 30px;"
                                            title="Edit" aria-label="Edit">
                                            <i class="fa fa-edit" style="margin-right: -2px;"></i>
                                        </a>

                                        <!-- Delete Button  -->
                                        <a href="{{ URL::to('/deletePds', ['id' => $data->id]) }}"
                                            class="btn btn-xs btn-icon-only btn-danger tooltips vcenter delete"
                                            style="padding: 1px 6px; margin-bottom: 2px; width: 31px; height: 30px;"
                                            title="Delete">
                                            <i class="fa fa-trash" style="margin-right: -2px;"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </body>

    </html>


</x-app-layout>
