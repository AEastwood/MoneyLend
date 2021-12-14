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
                                <a type="button" class="btn btn-sm btn-warning"
                                   href="{{ route('home') }}">
                                    Refresh
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 mb-2">
            <div class="col-6 col-md-3">
                Lenders
                ({{ $lenders->count() }})
            </div>
            <div class="col-9 col-md-6">

            </div>
            <div class="col-12 col-md-3">
                Outstanding Amount
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Loans Taken</th>
                                <th scope="col">Payments Made</th>
                                <th scope="col">Outstanding</th>
                                <th scope="col">View</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lenders as $lender)
                                <tr>
                                    <th scope="row">{{ $lender->id }}</th>
                                    <td>{{ $lender->first_name }}</td>
                                    <td>{{ $lender->last_name }}</td>
                                    <td>{{ $lender->loans->count() }}</td>
                                    <td>{{ $lender->payments->count() }}</td>
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
            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-body text-center py-4">
                        <h1>£{{ number_format($moniesOwed, 2) }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
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
