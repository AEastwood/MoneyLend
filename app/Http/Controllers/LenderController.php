<?php

namespace App\Http\Controllers;

use App\Models\Lender;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        ]);

        Lender::create($request->all());

        return redirect()->route('home')->with('success', 'Lender added');
    }

    /**
     * update lender
     */
    public function update(Request $request, Lender $lender): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        ]);

        $lender->update($request->all());

        return back()->with('success', 'Lender saved');
    }
}
