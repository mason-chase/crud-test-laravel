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
<h1>Create Customer</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Customer') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('customers.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text"
                                       class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                       value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text"
                                       class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                       value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_of_birth"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date"
                                       class="form-control @error('date_of_birth') is-invalid @enderror"
                                       name="date_of_birth" value="{{ old('date_of_birth') }}" required
                                       autocomplete="date_of_birth">

                                @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="tel"
                                       class="form-control @error('phone_number') is-invalid @enderror"
                                       name="phone_number" value="{{ old('phone_number') }}" required
                                       autocomplete="phone_number">

                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_account_number"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Bank Account Number') }}</label>

                            <div class="col-md-6">
                                <input id="bank_account_number" type="text"
                                       class="form-control @error('bank_account_number') is-invalid @enderror"
                                       name="bank_account_number" value="{{ old('bank_account_number') }}" required
                                       autocomplete="bank_account_number">

                                @error('bank_account_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>