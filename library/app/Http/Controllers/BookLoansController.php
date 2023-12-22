<?php

namespace App\Http\Controllers;


use App\Models\BookLoans;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class BookLoansController extends Controller
{

    public function show($id)
    {
        $loan = BookLoans::find($id);
        if (!empty($loan)) {
            return response()->json($loan);
        }
        return response()->json([
            "error" => "book loan not found"
        ], 404);
    }

    public function store(Request $request, $bookid)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // Check if the user has already borrowed the same book and it's not returned
        $existingLoan = BookLoans::where('user_id', $user->id)
            ->where('book_id', $bookid)
            ->whereIn('status', ['requested', 'borrowed'])
            ->first();

        if ($existingLoan) {
            if ($existingLoan->status === 'requested') {
                return response()->json([
                    'error' => 'You have already requested this book. Please wait for approval.'
                ], 400);
            } elseif ($existingLoan->status === 'borrowed') {
                return response()->json([
                    'error' => 'You have already borrowed this book. Return the book before requesting it again.'
                ], 400);
            }
        }
        $loan = new BookLoans;
        $loan_date = Carbon::now();
        //due_date will be after three weeks
        //return_date will be after two weeks
        //when due_date passes it becomes a penalty if not returned or overdue in this case
        $due_date = Carbon::parse($loan_date)->addWeeks(3);
        //the appropriate date to return the book
        $return_date = Carbon::parse($loan_date)->addWeeks(2);
        $loan->loan_date = $loan_date;
        $loan->user_id = $user->id;
        $loan->book_id = $bookid;
        $loan->due_date = $due_date;
        $loan->return_date = $return_date;
        $loan->status = "requested";
        $loan->timestamps = Carbon::now();
        $loan->save();
        return response()->json([
            "message" => "book loan added successfully"
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $loan = BookLoans::find($id);
        $loan->extended = is_null($request->extended) ? $loan->extended : $request->extended;
        $loan->extension_date = is_null($request->extension_date) ? $loan->extension_date : $request->extension_date;
        $loan->updated_at = Carbon::now();
        $loan->save();
        return response()->json([
            "message" => "book loan update was successfull"
        ], 200);
    }
    public function destroy($id)
    {
        $loan = BookLoans::find($id);
        if (empty($loan)) {
            return response()->json([
                "error" => "book loan not found"
            ], 404);
        }
        $loan->delete();
        return response()->json([
            "message" => "book loand deleted successfully"
        ], 200);
    }
    public function index()
    {

        $loans = BookLoans::with('book', 'user')->get()->all();
        return response()->json([
            "message" => $loans
        ], 200);
    }
    public function index_by_user()
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        $loans = BookLoans::with('book', 'user')->get()->where('user_id', $user->id)->all();
        return response()->json([
            "message" => $loans
        ], 200);
    }
}
