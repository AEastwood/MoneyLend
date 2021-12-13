@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        @if(session('message'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-6">
                <h3>Lender Details</h3>
            </div>
            <div class="col-3 text-end">
                <form action="{{ route('lender.destroy',$lender->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete Client</button>
                </form>
            </div>
            <div class="col-3">
                Outstanding
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('lender.update', $lender->id) }}" method="post" id="updateLenderForm">
                            @csrf
                            <input type="hidden" name="_method" value="put"/>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       aria-describedby="firstNameInput"
                                       autocomplete="off" value="{{ $lender->first_name }}">
                            </div>
                            <div class="form-group mt-2">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       autocomplete="off" value="{{ $lender->last_name }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center py-4">
                        <h1>£{{ $lender->outstandingLoans }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-9 text-end">
                <a type="submit" class="btn btn-danger btn-sm mt-1" href="{{ route('home') }}">
                    Cancel
                </a>
                <button type="submit" class="btn btn-success btn-sm mt-1" form="updateLenderForm">
                    Save Lender
                </button>
            </div>
        </div>

        <hr class="my-4">

        <div class="row">
            <div class="col-md-3">
                <h3>Loans</h3>
            </div>
            <div class="col-md-3 text-end">
                <a class="btn btn-danger btn-sm" href="{{ route('loan.create', ['lender_id' => $lender->id]) }}">
                    Add Loan
                </a>
            </div>
            <div class="col-md-3">
                <h3>Payments</h3>
            </div>
            <div class="col-md-3 text-end">
                <a class="btn btn-success btn-sm" href="{{ route('payment.create', ['lender_id' => $lender->id]) }}">
                    Add Payment
                </a>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-md-6">
                @if($lender->loans->count())

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($lender->loans as $loan)
                                    <tr>
                                        <th scope="row">{{ $loan->id }}</th>
                                        <td>£{{ number_format($loan->amount, 2) }}</td>
                                        <td>{{ $loan->created_at->format('d/m/Y H:i:s') }}</td>
                                        <td>
                                            <form class="d-grid" action="{{ route('loan.destroy', $loan->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        This lender has had no loans
                    </div>
                @endif
            </div>
            <div class="col-12 col-md-6">
                @if($lender->payments->count())

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($lender->payments as $payment)
                                    <tr>
                                        <th scope="row">{{ $payment->id }}</th>
                                        <td>£{{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ $payment->created_at->format('d/m/Y H:i:s') }}</td>
                                        <td>
                                            <form class="d-grid" action="{{ route('payment.destroy', $payment->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        This lender has made no payments
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
