<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lender\LenderStoreRequest;
use App\Models\Lender;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LenderController extends Controller
{

    /**
     * @return View
     */
    public function create(): View
    {
        return view('lender.create');
    }

    /**
     * @param Lender $lender
     * @return RedirectResponse
     */
    public function destroy(Lender $lender): RedirectResponse
    {
        $lender->delete();

        return redirect()->route('home')->with('success', 'Lender has been deleted');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $lender = Lender::findOrFail($id);

        return view('lender.edit')->with('lender', $lender);
    }

    /**
     * @param LenderStoreRequest $request
     * @return RedirectResponse
     */
    public function store(LenderStoreRequest $request): RedirectResponse
    {
        Lender::create($request->all());

        return redirect()->route('home')->with('success', 'Lender added');
    }

    /**
     * update lender
     * @param LenderStoreRequest $request
     * @param Lender $lender
     * @return RedirectResponse
     */
    public function update(LenderStoreRequest $request, Lender $lender): RedirectResponse
    {
        $lender->update($request->all());

        return back()->with('success', 'Lender saved');
    }
}
