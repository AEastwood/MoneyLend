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
                                Add Lender
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
                        <form action="{{ route('lender.store') }}" method="post" id="addLenderForm">
                            @csrf
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       aria-describedby="firstNameInput"
                                       autocomplete="off">
                            </div>
                            <div class="form-group mt-2">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       autocomplete="off">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 text-end">
                <a type="submit" class="btn btn-danger btn-sm mt-1" href="{{ route('home') }}">
                    Cancel
                </a>
                <button type="submit" class="btn btn-success btn-sm mt-1" form="addLenderForm">
                    Save Lender
                </button>
            </div>
        </div>

    </div>
@endsection
