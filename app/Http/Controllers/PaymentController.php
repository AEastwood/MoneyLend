<?php

namespace App\Http\Controllers;

use App\Models\Lender;
use App\Models\Payments\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{

    /**
     * @return View
     */
    public function create(): View
    {
        return view('payment.create', [
            'lenders' => Lender::all()
        ]);
    }

    /**
     * @param Payment $payment
     * @return RedirectResponse
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        $payment->delete();

        return redirect()->route('lender.edit', $payment->lender_id)->with('success', 'Payment deleted');
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

        Payment::create($request->all());

        return redirect()->route('lender.edit', $request->lender_id)->with('success', 'Payment added');
    }

}
