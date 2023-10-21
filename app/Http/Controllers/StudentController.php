<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        $students = Student::orderBy('id', 'asc')->paginate(5);
        return view('students.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'image' => 'required',
        ]);
        if ($request->image) {
            $imageName = time() . '-' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
        }

        $student = new Student();
        $student->name = $request->name;
        $student->address = $request->address;
        $student->mobile = $request->mobile;
        $student->image = $imageName;
        $student->save();
        // $input = $request->all();
        // Student::create($input);
        return redirect('student')->with('success', 'Student Addedd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        return view('students.show')->with('students', $student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::find($id);
        return view('students.edit')->with('students', $student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $student = Student::find($id);
        $input = $request->all();
        $student->update($input);
        toastr()->success('Student Data Updated successfully!');

        return redirect('student');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Student::destroy($id);
        return redirect('student')->with('success', 'Student deleted!');
    }
    public function imageUploadPost()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);
    }

}
