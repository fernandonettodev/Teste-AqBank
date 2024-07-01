<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use Carbon\Carbon;
use App\Jobs\SendLoanNotification;


class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('user', 'book')->get();
        return response()->json($loans);
    }
    
    public function create(Request $request)
    {
        try {
            $loan = new Loan();
            $loan->user_id = $request->input('user_id');
            $loan->book_id = $request->input('book_id');
            $loan->loan_date = Carbon::now();
            $loan->return_date = null;
            $loan->save();
            dispatch(new SendLoanNotification($loan, $request->user()));
            return response()->json($loan);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao registrar empréstimo: ' . $e->getMessage()], 500);
        }
    }
    
    public function show($id)
    {
        $loan = Loan::with('user', 'book')->find($id);
        if (!$loan) {
            return response()->json(['error' => 'Empréstimo não encontrado'], 404);
        }
        return response()->json($loan);
    }
    
    public function returnBook(Request $request, $id)
    {
        try {
            $loan = Loan::find($id);
            if (!$loan) {
                return response()->json(['error' => 'Empréstimo não encontrado'], 404);
            }

            $loan->return_date = Carbon::now();
            $loan->save();

            return response()->json(['message' => 'Livro devolvido com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao registrar devolução: ' . $e->getMessage()], 500);
        }
    }
    
    public function delete($id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['error' => 'Empréstimo não encontrado'], 404);
        }
        $loan->delete();
        return response()->json(['message' => 'Empréstimo deletado com sucesso']);
    }

}
