<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\BookUnit;
use Carbon\Carbon;
use App\Exports\LoansExport;
use Maatwebsite\Excel\Facades\Excel;


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
    public function approveReturn(Request $request, $id) {
        $loan = Loan::with('bookUnit')->findOrFail($id);

        if ($loan->status !== 'pending_return') {
            return redirect()->back()->with('error', 'Invalid action.');
        }

        $returnedAt = now();
        $dueDate = \Carbon\Carbon::parse($loan->due_date);

        $lateDays = 0;
        if ($returnedAt->gt($dueDate)) {
            $lateDays = intval(floor($dueDate->diffInDays($returnedAt)));
        }

        $calculatedFine = intval($lateDays * 5000);


        $fine = $request->filled('fine')
            ? (int) $request->fine
            : $calculatedFine;

        $reason = $request->filled('fine_reason')
            ? $request->fine_reason
            : ($lateDays > 0 ? 'Terlambat ' . $lateDays . ' hari @ Rp 5.000/hari' : null);

        $loan->status = 'returned';
        $loan->returned_at = $returnedAt;
        $loan->fine = $fine;
        $loan->fine_reason = $reason;
        $loan->late_days = $lateDays;
        $loan->save();

        if ($loan->bookUnit) {
            $loan->bookUnit->status = 'available';
            $loan->bookUnit->save();
        }

        return redirect()->back()->with(
            'success',
            'Return approved. Late: ' . $lateDays . ' days. Fine: Rp ' . number_format($fine)
        );
}
    public function rejectReturn($id) {
        $loan = \App\Models\Loan::findOrFail($id);

        if ($loan->status !== 'pending_return') {
            return redirect()->back()->with('error', 'Invalid action.');
        }

        $loan->status = 'approved';
        $loan->save();

        return redirect()->back()->with('success', 'Return rejected.');
    }

    public function export()
    {
        return Excel::download(new LoansExport, 'loans.xlsx');
    }

}
