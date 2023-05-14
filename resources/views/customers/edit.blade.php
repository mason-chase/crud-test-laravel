<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->

    <style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            /* Additional styles for demonstration purposes */
            width: 200px;
            height: 200px;
            background-color: lightgray;
        }
        /* Center the form */
        .container {
            margin-top: 50px;
        }

        .card-header {
            font-size: 24px;
            font-weight: bold;
        }

        /* Style the form fields */
        .form-control {
            border-radius: 0;
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 16px;
            color: #495057;
        }

        /* Style the error messages */
        .invalid-feedback {
            display: block;
            font-size: 14px;
            color: #dc3545;
            margin-top: 5px;
        }

        /* Style the submit button */
        .btn-primary {
            border-radius: 0;
            margin-top: 20px;
            background-color: #007bff;
            border-color: #007bff;
            font-size: 16px;
        }

        /* Style the form labels */
        .col-form-label {
            font-weight: bold;
            font-size: 16px;
            color: #495057;
        }

        /* Style the form input fields */
        .form-group input[type=text],
        .form-group input[type=date],
        .form-group input[type=email],
        .form-group input[type=tel] {
            background-color: #fff;
            border-radius: 4px;
        }

        /* Style the form field containers */
        .form-group {
            margin-bottom: 20px;
        }

        /* Style the form field containers for smaller screens */
        @media (max-width: 576px) {
            .form-group {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body class="antialiased center">

<div class="container">
    <h1>Edit Customer</h1>

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="{{ $customer->first_name }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="{{ $customer->last_name }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $customer->email }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="bank_account_number">Bank Account Number:</label>
            <input type="text" id="bank_account_number" name="bank_account_number" value="{{ $customer->bank_account_number }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ $customer->phone_number }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ $customer->date_of_birth }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>