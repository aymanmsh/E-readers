<?php

namespace App\Http\Controllers\control;

use App\control\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::where([]);

        if($request->has('name') && $request->input('name') != null) {
            $categories = $categories->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if($request->has('lang') && $request->input('lang') != null) {
            $categories = $categories->where('lang', '=', $request->input('lang'));
        }
        $categories = $categories->paginate(10);
        return view('control.category.index', compact('categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function onlyTrashed(Request $request)
    {
        $categories = Category::onlyTrashed()->where([]);

        if($request->has('name') && $request->input('name') != null) {
            $categories = $categories->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if($request->has('lang') && $request->input('lang') != null) {
            $categories = $categories->where('lang', '=', $request->input('lang'));
        }
        $categories = $categories->paginate(10);
        return view('control.category.deleted', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('control.category.create');
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
        $category = new Category();
        $category->fill($request->all());
        $category->image = parent::uploadImage($request->file('image'), 'category');
        $category->save();
        return redirect()->back()->with('success', trans('categories.controller.added_successfully'));


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
            $category = Category::findOrFail($id);
            return view('control.category.edit', compact('category'));
        } catch(\Exception $exception) {
            return redirect()->route('category.index')->with('error', trans('categories.controller.not_found'));
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
            $category = Category::findOrFail($id);
            $this->validate($request, $this->rules($id), $this->messages());

            // Update Image If IT Is Exist
            $category->fill($request->all());
            if($request->hasFile('image')) {
                $image_path = parent::uploadImage($request->file('image'), 'category');
                if(\File::exists(public_path($category->image))) {
                    \File::delete((public_path($category->image)));
                }
                $category->image = $image_path;
            }
            $category->update();
            return redirect()->route('category.index')->with('success', trans('categories.controller.updated_successfully'));
        } catch(\ModelNotFoundException $exception) {
            return redirect()->route('category.index')->with('error', trans('categories.controller.not_found'));
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
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('category.index')->with('success', trans('categories.controller.deleted_successfully'));
        } catch(\ModelNotFoundException $exception) {
            return redirect()->route('category.index')->with('error', trans('categories.controller.not_found'));
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
            $category = Category::onlyTrashed()->findOrFail($id);
            $category->restore();
            return redirect()->route('category.index')->with('success', trans('categories.controller.restored_successfully'));
        } catch(\ModelNotFoundException $exception) {
            return redirect()->route('category.index')->with('error', trans('categories.controller.not_found'));
        }
    }

    // Validation Rules For Form
    private function rules($id = null) {
        $rules = [
            'lang' => 'required|in:en,ar',
        ];
        if($id) {
            $rules['name'] = 'required|min:3|unique:categories,name,' . $id;
            $rules['image'] = 'mimes:jpg,jpeg,png';
        } else {
            $rules['name'] = 'required|min:3|unique:categories,name,' . $id;
            $rules['image'] = 'required|mimes:jpg,jpeg,png';
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
