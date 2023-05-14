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
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f5f5f5;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #f2f2f2;
        }

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
<h1>Customers</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Customer') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Date Of Birth</th>
                            <th>Bank Account Number</th>
                            <th>Phone Number</th>
                            <th>ID</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer['first_name'] }}</td>
                                <td>{{ $customer['last_name'] }}</td>
                                <td>{{ $customer['email'] }}</td>
                                <td>{{ $customer['date_of_birth'] }}</td>
                                <td>{{ $customer['bank_account_number'] }}</td>
                                <td>{{ $customer['phone_number'] }}</td>
                                <td>
                                    <a style="display: inline-block" href="{{ route('customers.edit', ['id' => $customer['id']]) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>