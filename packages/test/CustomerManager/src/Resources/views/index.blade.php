@extends('bace::layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <h2>List of Customers</h2>
            <a class="btn btn-success mb-4" href="{{ route('web.customer.create') }}">Create New Customer</a>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>Phone Number</th>
            <th>Bank Account Number</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $customer->first_name }}</td>
                <td>{{ $customer->last_name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->date_of_birth }}</td>
                <td>{{ $customer->phone_number }}</td>
                <td>{{ $customer->bank_account_number }}</td>
                <td>
                    <form action="{{ route('web.customer.destroy', ['customer' => $customer->id]) }}" method="post">
                        <a class="btn btn-primary" href="{{ route('web.customer.edit', ['customer' => $customer->id]) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this customer?')">Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $customers->links('vendor.pagination.bootstrap-5') }}
@endsection