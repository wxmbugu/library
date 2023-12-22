<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use App\Models\BookLoans;

use Carbon\Carbon;

use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'book_id' => 'required',
            'due_date' => 'required',
            'return_date' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], 400);
        }
        $loan = new BookLoans;
        $due_date = date("Y-m-d H:i:s", substr($request->due_date, 0, 10));
        $return_date = date("Y-m-d H:i:s", substr($request->return_date, 0, 10));
        $loan->user_id = $request->user_id;
        $loan->book_id = $request->book_id;
        $loan->due_date = $due_date;
        $loan->return_date = $return_date;
        $loan->status = $request->status;
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
        $loans = BookLoans::all();
        return response()->json([
            "message" => $loans
        ], 200);
    }
}
