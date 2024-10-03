<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class ExpenseController extends Controller
{
    protected $clients;

    public function __construct(Client $client)
    {
        $this->clients = $client::select('id', 'name')->get();
    }

    public function index()
    {
        $expenses = Expense::with('client:id,name')->latest()->paginate(10);
        return view('dashboard.expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('dashboard.expenses.create', ['clients' => $this->clients]);
    }

    public function store(StoreExpenseRequest $request)
    {
        $validatedData = $request->validated();
        Expense::create($validatedData);
        $this->setFlashMessage('success', 'تم اضافة المصروف بنجاح');
        return to_route('expenses.index');
    }

    public function show(string $id)
    {
        $expense = $this->getExpense($id);
        return view('dashboard.expenses.show', compact('expense'));
    }

    public function edit(string $id)
    {
        $expense = $this->getExpense($id);
        return view('dashboard.expenses.edit', ['expense' => $expense, 'clients' => $this->clients]);
    }

    public function update(UpdateExpenseRequest $request, string $id)
    {
        $expense = $this->getExpense($id);
        $validatedData = $request->validated();
        $expense->update($validatedData);
        $this->setFlashMessage('success', 'تم تحديث المصروف بنجاح');
        return to_route('expenses.index');
    }

    public function destroy(string $id)
    {
        $expense = $this->getExpense($id);
        $expense->delete();
        $this->setFlashMessage('success', 'تم حذف المصروف بنجاح');
        return to_route('expenses.index');
    }

    private function getExpense(string $id): Expense
    {
        return Expense::with('client:id,name,phone')->findOrFail($id);
    }

    private function setFlashMessage(string $type, string $message)
    {
        session()->flash($type, $message);
    }
}
