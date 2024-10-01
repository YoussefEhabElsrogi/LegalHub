<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\Client;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest()->paginate(10);
        return view('dashboard.expenses.index', compact('expenses'));
    }
    public function create()
    {
        $clients = Client::all();
        return view('dashboard.expenses.create', compact('clients'));
    }
    public function store(StoreExpenseRequest $request)
    {
        $validatedData = $request->validated();

        Expense::create($validatedData);

        setFlashMessage('success', 'تم اضافة المصروف بنجاح');

        return to_route('expenses.index');
    }
    public function show(string $id)
    {
        $expense = Expense::FindOrFail($id);
        return view('dashboard.expenses.show', compact('expense'));
    }
    public function edit(string $id)
    {
        $clients = Client::all();
        $expense = Expense::findOrFail($id);
        return view('dashboard.expenses.edit', compact('expense', 'clients'));
    }
    public function update(UpdateExpenseRequest $request, string $id)
    {
        $expense = Expense::findOrFail($id);

        $validateData = $request->validated();

        $expense->update($validateData);

        setFlashMessage('success', 'تم تحديث المصروف بنجاح');

        return to_route('expenses.index');
    }
    public function destroy(string $id)
    {
        $expense = Expense::findOrFail($id);

        $expense->delete();

        setFlashMessage('success', 'تم حذف المصروف بنجاح');

        return to_route('expenses.index');
    }
}
