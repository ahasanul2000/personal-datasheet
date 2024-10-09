<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
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
            <h2>Personal Data</h2>
            <div class="actions" style="margin-left: 405px;">
                <a class="btn btn-secondary btn-sm pl-4 pr-4" href="{{ URL::to('pds') }}"> <i
                        class="fa fa-backward backIcon" aria-hidden="true"></i> <span id="backWritten"> Back
                    </span>
                </a>
            </div>

            <form method="POST" action="{{ route('storePdsData') }}" enctype="multipart/form-data">
                @csrf <!-- Add CSRF token for security -->

                <div class="mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                        required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fullName">Full Name:</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Enter full name"
                        name="fullName" required>
                    @error('fullName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Enter phone number"
                        name="phone" required>
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="age">Age:</label>
                    <input type="number" class="form-control" id="age" placeholder="Enter age" name="age"
                        required>
                    @error('age')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter address" name="address"
                        required>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image">Picture:</label>
                    <input type="file" name="image" class="form-control" id="image"
                        placeholder="Choose an image">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>


        </div>

    </div>

</body>

</html>
