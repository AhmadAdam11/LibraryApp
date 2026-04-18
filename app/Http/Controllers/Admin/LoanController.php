<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\BookUnit;

class LoanController extends Controller
{
    public function index() {
        $loans = Loan::with(['user', 'book'])
        ->latest()
        ->get();

        return view('admin.loans.index', compact('loans'));
    }

    public function approve($id) {

        $loan = Loan::findOrFail($id);

        if ($loan -> status !== 'pending') {
            return back()->with('error', 'Loan already processed. ');
        }

        $unit = BookUnit::where('book_id', $loan->book_id)
        ->where('status', 'available')
        ->first();
        
        if(!$unit) {
            return back()->with('error', 'No available unit for this book');
        }

        $unit->update([
            'status' => 'borrowed'
        ]);

        $loan->update([
            'book_unit_id' => $unit->id,
            'borrowed_at' => now(),
            'status' => 'approved',
        ]);

        return back()->with('success', 'Loan approved successfully');
    }
    public function reject($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->status !== 'pending') {
            return back()->with('error', 'Loan already processed.');
        }

        $loan->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Loan rejected.');
    }

}
