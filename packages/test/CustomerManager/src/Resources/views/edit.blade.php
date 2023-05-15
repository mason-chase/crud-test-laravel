@extends('bace::layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Edit Product</h2>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('web.customer.update',$customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-2">
                    <div class="col-md-6 form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" value="{{ $customer->first_name }}"
                               class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter first name">
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" value="{{ $customer->last_name }}"
                               class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter last name">
                        @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ $customer->email }}"
                               class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" >
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="tel" name="phone_number" value="{{ $customer->phone_number }}"
                               class="form-control @error('phone_number') is-invalid @enderror"
                               placeholder="Enter phone number" >
                        @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ $customer->date_of_birth }}"
                               class="form-control @error('date_of_birth') is-invalid @enderror"
                               placeholder="Enter date of birth" >
                        @error('date_of_birth')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="bank_account_number">Bank Account Number</label>
                        <input type="text" name="bank_account_number" value="{{ $customer->bank_account_number }}"
                               class="form-control @error('bank_account_number') is-invalid @enderror"
                               placeholder="Enter bank account number" maxlength="10">
                        @error('bank_account_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-outline-primary" href="{{ route('web.customer.index') }}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </form>
        </div>
    </div>

@endsection