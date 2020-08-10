<?php

namespace App\Http\Controllers\control;

use DB;
use App\control\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::where([]);

        if($request->has('title') && $request->input('title') != null) {
            $books = $books->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if($request->has('isbn') && $request->input('isbn') != null) {
            $books = $books->where('isbn', '=', $request->input('isbn'));
        }
        $books = $books->paginate(10);
        return view('control.book.index', compact('books'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function onlyTrashed(Request $request)
    {
        $books = Book::onlyTrashed()->where([]);

        if($request->has('title') && $request->input('title') != null) {
            $books = $books->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if($request->has('isbn') && $request->input('isbn') != null) {
            $books = $books->where('isbn', '=', $request->input('isbn'));
        }
        $books = $books->paginate(10);
        return view('control.book.deleted', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->get(['id', 'name']);
        $libraries = DB::table('library')->get(['id', 'name']);
        return view('control.book.create', compact(['categories', 'libraries']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Form Data
        $this->validate($request, $this->rules(), $this->messages());

        // Insert Data Into Database
        $book = new Book();
        $book->fill($request->all());
        $book->image = parent::uploadImage($request->file('image'), 'book');
        $book->save();
        return redirect()->back()->with('success', 'Book Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $book = Book::findOrFail($id);
            return view('control.book.edit', compact('book'));
        } catch(\Exception $exception) {
            return redirect()->route('book.index')->with('error', 'Book Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
            $this->validate($request, $this->rules($id), $this->messages());

            // Update Image If IT Is Exist
            $book->fill($request->all());
            if($request->hasFile('image')) {
                $image_path = parent::uploadImage($request->file('image'), 'book');                
                if(\File::exists(public_path($book->image))) {
                    \File::delete((public_path($book->image)));
                }
                $book->image = $image_path;
            }
            $book->update();
            return redirect()->route('book.index')->with('success', 'Book Updated Successfully');
        } catch(\ModelNotFoundException $exception) {
            return redirect()->route('book.index')->with('error', 'Book Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            return redirect()->route('book.index')->with('success', 'Book Deleted Successfully');
        } catch(\ModelNotFoundException $exception) {
            return redirect()->route('book.index')->with('error', 'Book Not Found');
        }
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        try {
            $book = Book::onlyTrashed()->findOrFail($id);
            $book->restore();
            return redirect()->route('book.index')->with('success', 'Book Restored Successfully');
        } catch(\ModelNotFoundException $exception) {
            return redirect()->route('book.index')->with('error', 'Book Not Found');
        }
    }

    // Validation Rules For Form
    private function rules($id = null) {
        $rules = [];
        if($id) {
            $rules['title'] = 'min:3|max:64';
            $rules['author'] = 'min:3|max:64';
            $rules['writer'] = 'min:3|max:64';
            $rules['publisher'] = 'min:3|max:64';
            $rules['image'] = 'mimes:jpg,jpeg,png';
        } else {
            $rules['category_id'] = 'required';
            $rules['library_id'] = 'required';
            $rules['title'] = 'required|min:3|max:64';
            $rules['author'] = 'required|min:3|max:64';
            $rules['writer'] = 'required|min:3|max:64';
            $rules['publisher'] = 'required|min:3|max:64';
            $rules['isbn'] = 'required|min:3|max:64|unique:books,isbn,' . $id;
            $rules['publish_date'] = 'required';
            $rules['image'] = 'required|mimes:jpg,jpeg,png';
        }
        return $rules;
        
    }

    // Validation Messages For Form
    private function messages() {
        return [
            'name.required' => 'Category Name Is Required',
            'name.min' => 'Category Name Is Too Short',
            'name.unique' => 'Category Name Is Already Taken',
            'lang.required' => 'Languge Is Required',
            'lang.in' => 'Invalid Information',
            'image.required' => 'Image Is Required',
            'image.mimes' => 'Image Type Is Invalid',
        ];
    }
}
