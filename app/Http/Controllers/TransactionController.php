<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json($transactions);
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return response()->json($transaction);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'recurring_period' => 'nullable|in:daily,monthly,annually',
        ]);

        $transaction = Transaction::create($request->all());
        return response()->json($transaction, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'type' => 'nullable|in:income,expense',
            'category_id' => 'nullable|exists:categories,id',
            'payment_method_id' => 'nullable|exists:payment_methods,id',
            'amount' => 'nullable|numeric',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'recurring_period' => 'nullable|in:daily,monthly,annually',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());
        return response()->json(['message' => 'Transaction updated successfully']);
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return response()->json([
            'message' => 'Transaction deleted successfully'
        ]);
    }
}
