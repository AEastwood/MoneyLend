<?php

namespace App\Http\Controllers;

use App\Models\Lender;
use App\Models\Payments\Loan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanController extends Controller
{
    /**
     * @return View
     */
    public function create(): View
    {
        return view('loan.create', [
            'lenders' => Lender::all()
        ]);
    }

    /**
     * @param Loan $loan
     * @return RedirectResponse
     */
    public function destroy(Loan $loan): RedirectResponse
    {
        $loan->delete();

        return redirect()->route('lender.edit', $loan->lender_id)->with('success', 'Loan deleted');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required|numeric|between:0.00,99999.99',
            'lender_id' => 'required|numeric'
        ]);

        Loan::create($request->all());

        return redirect()->route('lender.edit', $request->lender_id)->with('success', 'Loan added');
    }
}
