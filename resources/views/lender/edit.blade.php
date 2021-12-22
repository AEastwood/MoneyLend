@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-8">
                <h4>{{ $lender->fullname }}</h4>
            </div>
            <div class="col-4 col-md-4 text-end">
                <form action="{{ route('lender.destroy',$lender->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete Client</button>
                </form>
            </div>

        </div>

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

        <div class="row mb-2">
            <div class="col-12 col-md-9">
                <h3>Details</h3>

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
                <div class="text-end my-2 my-md-1">
                    <button type="submit" class="btn btn-success btn-sm mt-1 full-width text-center "
                            form="updateLenderForm">
                        Save Lender
                    </button>
                </div>

            </div>
            <div class="col-12 col-md-3 mt-2 mt-md-0">
                <h4>Outstanding</h4>
                <div class="card">
                    <div class="card-body text-center py-4">
                        <h1>£{{ number_format($lender->outstandingLoans, 2) }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="row">
            <div class="col-12 col-md-6 my-2 my-md-0">
                <div class="row">
                    <div class="col-6">
                        <h3>Loans</h3>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn btn-success btn-sm"
                           href="{{ route('loan.create', ['lender_id' => $lender->id]) }}">
                            Add Loan
                        </a>
                    </div>
                </div>
                @if($lender->loans->count())

                    <div class="card mt-2 mt-md-1">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($lender->loans as $loan)
                                    <tr>
                                        <td>£{{ number_format($loan->amount, 2) }}</td>
                                        <td>{{ $loan->created_at->format('d/m/Y') }}</td>
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
                    <div class="alert alert-info mt-2 mt-md-1">
                        This lender has had no loans
                    </div>
                @endif
            </div>

            <div class="col-12 col-md-6 my-2 my-md-0">
                <div class="row">
                    <div class="col-6">
                        <h3>Payments</h3>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn btn-success btn-sm"
                           href="{{ route('payment.create', ['lender_id' => $lender->id]) }}">
                            Add Payment
                        </a>
                    </div>
                </div>
                @if($lender->payments->count())

                    <div class="card mt-2 mt-md-1">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($lender->payments as $payment)
                                    <tr>
                                        <td>£{{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <form class="d-grid"
                                                  action="{{ route('payment.destroy', $payment->id) }}"
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
                    <div class="alert alert-info mt-2 mt-md-1">
                        This lender has made no payments
                    </div>
                @endif
            </div>
        </div>


    </div>
@endsection
