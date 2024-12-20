<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Database\RecordNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserCreditController extends Controller
{
    public function show(): View
    {
        return view('profile.credit');
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedNewTotal = $request->validate([
                'total' => 'required|numeric|min:1|max:200',
            ]);

            $oldTotalCredit = DB::table('user_credits')->where('user_id', $id)->firstOrFail()->total;
            $newTotalCredit = $oldTotalCredit + $validatedNewTotal['total'];

            DB::table('user_credits')->where('user_id', $id)->update(['total' => $newTotalCredit]);

            return redirect()->back()->with('success', 'Credit updated!');

        } catch (RecordNotFoundException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (QueryException $e) {
            return redirect('/profile/credit/'.$id)->withErrors('Max total credit reached!');
        } catch (ValidationException $e) {
            return redirect('/profile/credit/'.$id)->withErrors($e->getMessage());
        }

    }
}
