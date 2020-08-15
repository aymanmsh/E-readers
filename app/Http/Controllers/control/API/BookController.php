<?php

namespace App\Http\Controllers\control\API;

use App\control\Book;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $categories = Book::all();
        return parent::success($categories, 200);
    }

    public function show($id) {
        try {
            $book = Book::findOrFail($id);
            return parent::success($book);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return parent::error('Book Not Found!!', 404);
        }
    }


    public function store(Request $request) {
        $validation = \Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails()) {
            return parent::error($validation->errors(), 400);
        }
        $book = new Book();
        $book->fill($request->all());
//        $book->image = parent::uploadImage($request->file('image'), 'book');
        $book->image = "123.jpg";
        $book->save();
        return parent::success($book);
    }

    public function update(Request $request, $id) {
        $validation = \Validator::make($request->all(), $this->rules($id), $this->messages());
        if($validation->fails())
        return parent::error($validation->errors());

        try {
            $book = Book::findOrFail($id);
            $category->fill($request->all());
            if($book->hasFile('image')) {
                $image_path = parent::uploadImage($request->file('image'), '$book');
                if (\File::exists(public_path($book->image))) {
                    \File::delete((public_path($book->image)));
                }
                $book->image = $image_path;
            }
            $book->update();
            return parent::success($book);
        } catch(ModelNotFoundException $ModelNotFoundException) {
            return parent::error('Book Not Found!!', 404);
        }
    }

    public function destroy($id) {
        try{
            $book = Book::findOrFail($id);
            $result = $book->delete();
            if($result === TRUE)
                return parent::success($book);
            return parent::error('Some Thing Went Wrong!!');
        } catch (ModelNotFoundException $modelNotFoundException) {
            return parent::error('Book Not Found!!');
        }
    }


    private function rules($id = null) {
        $rules = [
            'lang' => 'required|in:en,ar',
        ];
        if($id) {
            $rules['name'] = 'min:3|unique:categories,name,' . $id;
            $rules['image'] = 'mimes:jpg,jpeg,png';
        } else {
            $rules['name'] = 'required|min:3|unique:categories,name,' . $id;
            $rules['image'] = 'mimes:jpg,jpeg,png';
        }
        return $rules;
    }

    // Validation Messages For Form
    private function messages() {
        return [
            'name.required' => trans('categories.controller.name_required'),
            'name.min' => trans('categories.controller.name_short'),
            'name.unique' => trans('categories.controller.name_used'),
            'lang.required' => trans('categories.controller.language_required'),
            'lang.in' =>  trans('categories.controller.language_invalid'),
            'image.required' =>  trans('categories.controller.image_required'),
            'image.mimes' => trans('categories.controller.image_invalid'),
        ];
    }
}
