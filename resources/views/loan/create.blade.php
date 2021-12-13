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

        <div class="row mb-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                Add Loan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mb-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('loan.store') }}" method="post" id="addLoanForm">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Loan Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" step="0.01">
                            </div>
                            <div class="form-group mt-2">
                                <label for="lender_id">Lender</label>
                                <select class="form-select" id="lender_id" name="lender_id">
                                    <option selected>Choose...</option>
                                    @foreach($lenders as $lender)
                                        <option value="{{ $lender->id }}"
                                                @if($_GET['lender_id'] == $lender->id)selected @endif>
                                            {{ $lender->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 text-end">
                <a class="btn btn-danger btn-sm mt-1" href="{{ redirect()->back()->getTargetUrl() }}">
                    Cancel
                </a>
                <button type="submit" class="btn btn-success btn-sm mt-1" form="addLoanForm">
                    Save Payment
                </button>
            </div>
        </div>

    </div>
@endsection
