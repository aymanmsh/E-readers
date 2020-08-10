<?php

namespace App\Http\Controllers\control;

use App\control\Library;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $libraries = Library::where([]);

        if($request->has('name') && $request->input('name') != null) {
            $libraries = $libraries->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $libraries = $libraries->paginate(10);
        return view('control.library.index', compact('libraries'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function onlyTrashed(Request $request)
    {
        $libraries = Library::onlyTrashed()->where([]);

        if($request->has('name') && $request->input('name') != null) {
            $libraries = $libraries->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if($request->has('lang') && $request->input('lang') != null) {
            $libraries = $libraries->where('lang', '=', $request->input('lang'));
        }
        $libraries = $libraries->paginate(10);
        return view('control.library.deleted', compact('libraries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('control.library.create');
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
        $library = new Library();
        $library->fill($request->all());
        $library->image = parent::uploadImage($request->file('image'), 'library');
        $library->save();
        return redirect()->back()->with('success', 'Library Add Successfully');
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
            $library = Library::findOrFail($id);
            return view('control.library.edit', compact('library'));
        } catch(\Exception $exception) {
            return redirect()->route('library.index')->with('error', 'Library Not Found');
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
            $library = Library::findOrFail($id);
            // dd($library);
            $this->validate($request, $this->rules($id), $this->messages());

            // Update Image If IT Is Exist
            $library->fill($request->all());
            if($request->hasFile('image')) {
                $image_path = parent::uploadImage($request->file('image'), 'library');                
                if(\File::exists(public_path($library->image))) {
                    \File::delete((public_path($library->image)));
                }
                $library->image = $image_path;
            }
            $library->update();
            return redirect()->route('library.index')->with('success', 'Library Updated Successfully');
        } catch(\ModelNotFoundException $exception) {
            return redirect()->route('library.index')->with('error', 'Library Not Found');
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
            $library = Library::findOrFail($id);
            $library->delete();
            return redirect()->route('library.index')->with('success', 'Library Deleted Successfully');
        } catch(\ModelNotFoundException $exception) {
            return redirect()->route('library.index')->with('error', 'Library Not Found');
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
            $library = Library::onlyTrashed()->findOrFail($id);
            $library->restore();
            return redirect()->route('library.index')->with('success', 'Library Restored Successfully');
        } catch(\ModelNotFoundException $exception) {
            return redirect()->route('library.index')->with('error', 'Library Not Found');
        }
    }

    // Validation Rules For Form
    private function rules($id = null) {
        $rules = [
            'password' => 'required|min:6|max:32',
        ];
        if($id) {
            $rules['name'] = 'required|min:3|unique:library,name,' . $id;
            $rules['image'] = 'mimes:jpg,jpeg,png';
        } else {
            $rules['name'] = 'required|min:3|unique:library,name,' . $id;
            $rules['email'] = 'required|min:3|unique:library,email,' . $id;
            $rules['phone'] = 'required|min:3|max:18|unique:library,phone,' . $id;
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
            'image.required' => 'Image Is Required',
            'image.mimes' => 'Image Type Is Invalid',
        ];
    }
}
