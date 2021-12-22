@extends('layouts.app')

@section('content')
    <div class="container">

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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 my-auto">
                                Money Lend
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn btn-success btn-sm" href="{{ route('lender.create') }}" type="submit">
                                    Add Lender
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 mb-2 my-3 my-md-0">
            <div class="col-12 col-md-9">
                <h4>Lenders ({{ $lenders->count() }})</h4>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Outstanding</th>
                                <th scope="col">View</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lenders as $lender)
                                <tr>
                                    <td>{{ $lender->fullname }}</td>
                                    <td>£{{ number_format($lender->outstandingLoans, 2) }}</td>
                                    <td class="d-grid">
                                        <a href="{{ route('lender.edit', $lender->id) }}"
                                           class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3 my-3 my-md-0">
                <h4>Outstanding Amount</h4>
                <div class="card">
                    <div class="card-body text-center py-4">
                        <span class="outstanding-amount">£{{ number_format($moniesOwed, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 mt-md-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 my-auto">
                                Money Lend
                            </div>
                            <div class="col-6 text-end">
                                {{ env('APP_VERSION') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
