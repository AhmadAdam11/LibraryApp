<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Models\BookUnit;
use App\Models\Rating;


class LoanController extends Controller
{
    public function create($bookId) {
        $book = Book::findOrFail($bookId);

        return view ('users.loans.create', compact('book'));
    }
    public function store(Request $request) {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        $availableUnit = BookUnit::where('book_id', $request->book_id)
            ->where('status', 'available')
            ->exists();

        if (!$availableUnit) {
            return back()->with('error', 'Book is not available right now.');
        }


        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        return redirect()->route('user.loans')
            ->with('success', 'Loan request submitted, waitin for approval.');
    }
    public function index() {
        $loans = Loan::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('users.loans.index', compact('loans'));
    }
    public function returnForm($id)
        {
            $loan = Loan::with('book')->findOrFail($id);

            if ($loan->user_id !== auth()->id()) {
                abort(403);
            }

            if ($loan->status !== 'approved') {
                return back()->with('error', 'Invalid return request');
            }

            return view('users.loans.return', compact('loan'));
        }

        public function submitReturn(Request $request, $id)
            {
                $loan = Loan::findOrFail($id);

                if ($loan->user_id !== auth()->id()) {
                    abort(403);
                }

                if ($loan->status !== 'approved') {
                    return back()->with('error', 'Invalid action');
                }

                $request->validate([
                    'rating' => 'required|integer|min:1|max:5',
                    'review' => 'nullable|string'
                ]);

                $rating = \App\Models\Rating::where('user_id', auth()->id())
                    ->where('book_id', $loan->book_id)
                    ->first();

                if ($rating) {
                    $rating->update([
                        'rating' => $request->rating,
                        'review' => $request->review,
                    ]);
                } else {
                    \App\Models\Rating::create([
                        'user_id' => auth()->id(),
                        'book_id' => $loan->book_id,
                        'rating' => $request->rating,
                        'review' => $request->review,
                    ]);
                }

                $loan->update([
                    'status' => 'pending_return',
                    'requested_return_at' => now(),
                ]);

                return redirect()->route('user.loans')
                    ->with('success', 'Return request submitted');
            }

}
