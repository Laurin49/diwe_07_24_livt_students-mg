<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\ClassesResource;
use App\Http\Resources\StudentResource;
use App\Models\Classes;
use Illuminate\Http\Request;

class StudentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $students = StudentResource::collection(Student::paginate(10));

    return inertia('Students/Index', [
      'students' => $students,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $classes = ClassesResource::collection(Classes::all());

    return inertia('Students/Create', [
      'classes' => $classes,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreStudentRequest $request)
  {
    Student::create($request->validated());

    return redirect(route('students.index'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Student $student)
  {
    //
  }

  public function edit(Student $student)
  {
    $classes = ClassesResource::collection(Classes::all());

    return inertia('Students/Edit', [
      'classes' => $classes,
      'student' => StudentResource::make($student),
    ]);
  }

  public function update(UpdateStudentRequest $request, Student $student)
  {
    $student->update($request->validated());

    return redirect()->route('students.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Student $student)
  {
    $student->delete();

    return redirect()->route('students.index');
  }
}
