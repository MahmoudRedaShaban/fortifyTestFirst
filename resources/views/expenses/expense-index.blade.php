@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6 offset-4 px-8" >
                <a type="button" href="{{ route('expenses.add') }}" class="btn btn-primary" btn-lg  btn-lg">
                <div class="card text-white bg-primary">
                  <div class="card-body">
                    <h1>Add New Expense</h1>
                  </div>
                </div>
            </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="text-center table table-striped table-bordered  ">
                    <thead >
                        <tr>
                            <th>#Id</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Payment Method</th>
                            <th>View/Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($expenses)

                        @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->id }}</td>
                            <td>{{ $expense->description}}</td>
                            <td>{{ $expense->date}}</td>
                            <td>{{ $expense->amount}}</td>
                            <td>{{ $expense->category}}</td>
                            <td>{{ $expense->payment_method}}</td>
                            <td class="text-center">
                                <a href="{{ route('expenses.view', $expense) }}" class="btn btn-outline-primary">View</a>
                                <a href="{{ route('expenses.delete', $expense) }}" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <td colspan="6"> Not Found</td>
                        @endif

                    </tbody>
                </table>

                <div class="container"><div class="row">
                    {{ $expenses->links() }}
                </div></div>
                {{-- {{ $expenses->render() }} --}}

            </div>
        </div>
    </div>
@endsection
