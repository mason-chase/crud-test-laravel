@extends('customers::layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-4">
                <h2>List Of Customers</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success mb-4" href="{{ route('customers.create') }}"> Create New Customer</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Date Of Birth</th>
            <th>Bank Account Number</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $customer->first_name }}</td>
                <td>{{ $customer->last_name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone_number }}</td>
                <td>{{ $customer->date_of_birth }}</td>
                <td>{{ $customer->bank_account_number }}</td>
                <td>
                    <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('customers.show',$customer->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('customers.edit',$customer->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $customers->links() !!}

@endsection