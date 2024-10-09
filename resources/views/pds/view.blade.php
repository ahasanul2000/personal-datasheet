<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Personal Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .bordered-box {
            border: 1px solid #007bff;
            /* Bootstrap primary color */
            border-radius: 5px;
            padding: 20px;
            margin: 20px auto;
            max-width: 500px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="bordered-box">
            <h2>View Personal Data</h2>
            <div class="actions" style="margin-left: 405px;">
                <a class="btn btn-secondary btn-sm pl-4 pr-4" href="{{ URL::to('pds') }}">
                    <i class="fa fa-backward backIcon" aria-hidden="true"></i>
                    <span id="backWritten"> Back </span>
                </a>
            </div>
            <div class="mb-3">
                <img src="{{ asset('images/' . $personalData->image) }}" alt="Uploaded Image" width="150">
            </div>
            <div class="mb-3">
                <p id="fullName"><strong>Name:</strong> {{ $personalData->fullName }}</p>
            </div>

            <div class="mb-3">
                <p id="email"><strong>Email:</strong> {{ $personalData->email }}</p>
            </div>

            <div class="mb-3">
                <p id="phone"><strong>Phone Number:</strong> {{ $personalData->phone }}</p>
            </div>

            <div class="mb-3">
                <p id="age"><strong>Age:</strong> {{ $personalData->age }}</p>
            </div>

            <div class="mb-3">
                <p id="address"><strong>Address:</strong> {{ $personalData->address }}</p>
            </div>


        </div>
    </div>

</body>

</html>
