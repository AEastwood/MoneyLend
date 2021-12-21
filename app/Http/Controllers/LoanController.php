<?php

namespace App\Http\Controllers;

use App\Http\Requests\Loan\LoanStoreRequest;
use App\Models\Lender;
use App\Models\Payments\Loan;
use Illuminate\Http\RedirectResponse;
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
     * @param LoanStoreRequest $request
     * @return RedirectResponse
     */
    public function store(LoanStoreRequest $request): RedirectResponse
    {
        Loan::create($request->all());

        return redirect()->route('lender.edit', $request->lender_id)->with('success', 'Loan added');
    }
}
