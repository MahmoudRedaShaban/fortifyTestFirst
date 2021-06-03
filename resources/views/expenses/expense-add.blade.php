@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Add Expense</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('expenses.save') }}" method="post">
                        @include('expenses.expense-form');
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
