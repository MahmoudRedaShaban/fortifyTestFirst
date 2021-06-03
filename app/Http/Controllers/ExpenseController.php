<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{
    private $expensesCategories;
    private $methodPayment;
    private $roles ;
    public function __construct()
    {
        $this->expensesCategories = config('expense.expense_category');
        $this->methodPayment = config('expense.payment_method');
        $this->roles = [
            'description' => ['required','min:3'],
            'date' => ['required','date'],
            'amount' => ['required','min:1'],
            'category' => ['required',Rule::in($this->expensesCategories)],
            'payment_method' => ['required',Rule::in($this->methodPayment)],
        ];
    }

    public function index()
    {
        $expenses = Expense::orderByDesc('id')->paginate(10);
        // $expenses = Expense::orderBy('id', 'DESC')->paginate(10);
        return view('expenses.expense-index', compact('expenses'));
    }

    public function add()
    {
        return view('expenses.expense-add')
            ->with('expense',new Expense)
            ->with('expenses',$this->expensesCategories)
            ->with('methodPayment', $this->methodPayment);
    }

    public function store(Request $request)
    {
        $postData = $this->validate($request, $this->roles);
        $postData['user_id'] = auth()->user()->id;

        Expense::create($postData);

        return redirect()->to(route('expenses.list'));
    }

    public function view(Expense $expense)
    {

        return view('expenses.expense-view')
        ->with('expense',$expense)
        ->with('expenses',$this->expensesCategories)
        ->with('methodPayment', $this->methodPayment);
    }
    public function update(Request $request)
    {
        $this->roles['id'] =  ['required','exists:expenses,id'];

        $postData = $this->validate($request, $this->roles);

        $expenseId = $postData['id'];

        unset($postData['id']);


        Expense::where('id', $expenseId)
            ->update($postData);

        return redirect()->back();
    }
    public function delete(Expense $expense)
    {

        if($expense->user_id != auth()->user()->id){
            abort(401,'You cannot delete any other user\'s entry.');
        }

        $expense->delete();

        return redirect()->route('expenses.list');
    }

}
