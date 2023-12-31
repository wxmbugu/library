<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use App\Models\Books;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{

    public function show($id)
    {
        $book = Books::find($id);
        if (!empty($book)) {
            return response()->json($book);
        }
        return response()->json([
            "error" => "Book not found"
        ], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'publisher' => 'required',
            'isbn' => 'required',
            'pages' => 'required|numeric',
            'category' => 'required',
            'file' => 'required|max:20480|mimes:jpeg,jpg,png,webp',
            'sub_category' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], 400);
        }
        $file = $request->file('file');

        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('uploads', $file, $fileName);
        $book = new Books;
        $book->name = $request->name;
        $book->description = $request->description;
        $book->publisher = $request->publisher;
        $book->isbn = $request->isbn;
        $book->pages = $request->pages;
        $book->category = $request->category;
        $book->sub_category = $request->sub_category;
        $book->image =  config('app.url') . '/api/media/' . $fileName;
        $book->save();
        return response()->json([
            "message" => "book added successfully"
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $book = Books::find($id);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $validator = Validator::make($request->all(), [
                'file' => 'required|max:20480|mimes:jpeg,jpg,png,webp',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "error" => $validator->errors()
                ], 400);
            }
            $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('uploads', $file, $fileName);
            $book->image = config('app.url') . '/api/media/' . $fileName;
            $book->save();
        }
        $book->name = is_null($request->name) ? $book->name : $request->name;
        $book->description = is_null($request->description) ? $book->description : $request->description;
        $book->publisher = is_null($request->publisher) ? $book->publisher : $request->publisher;
        $book->isbn = is_null($request->isbn) ? $book->isbn : $request->isbn;
        $book->pages = is_null($request->pages) ? $book->pages : $request->pages;
        $book->category = is_null($request->category) ? $book->category : $request->category;
        $book->sub_category = is_null($request->sub_category) ? $book->sub_category : $request->sub_category;
        $book->updated_at = Carbon::now();
        $book->save();
        return response()->json([
            "message" => "Book update was successfull"
        ], 200);
    }
    public function destroy($id)
    {
        $book = Books::find($id);
        if (empty($book)) {
            return response()->json([
                "error" => "Book not found"
            ], 404);
        }
        $book->delete();
        return response()->json([
            "message" => "Book deleted successfully"
        ], 200);
    }
    public function index()
    {
        $book = Books::all();
        return response()->json([
            "message" => $book
        ], 200);
    }
}
