<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Contracts\Services\Student\StudentServiceInterface;

class CustomStudentController extends Controller
{
    /**
     * task interface
     */
    private $studentInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StudentServiceInterface $studentServiceInterface)
    {
        $this->studentInterface = $studentServiceInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showList(Request $request)
    {
        $students = $this->studentInterface->getStudents($request);

        return view('custom_student.index')
            ->with(['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateView()
    {
        $majors = $this->studentInterface->getMajors();

        return view('custom_student.create')
            ->with(['majors' => $majors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveStudent(StoreStudentRequest $request)
    {
        $student = $this->studentInterface->saveStudent($request);

        // Check student is created successfully or not
        if ($student) {
            return redirect()
                ->route('students#showList')
                ->with('success', 'Student created successfully.');
        } else {
            return back()
                ->withErrors('Something went wrong. Please try again!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function showEditView(Student $student)
    {
        $majors = $this->studentInterface->getMajors();

        return view('custom_student.edit')
            ->with([
                'majors' => $majors,
                'student' => $student
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function updateStudent(UpdateStudentRequest $request, Student $student)
    {
        $result = $this->studentInterface->updateStudent($request, $student);

        // Check student is created successfully or not
        if ($result) {
            return redirect()
                ->route('students#showList')
                ->with('success', 'Student updated successfully.');
        } else {
            return back()
                ->withErrors('Something went wrong. Please try again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function deleteStudent(Student $student)
    {
        $result = $this->studentInterface->deleteStudent($student);
        // Check student is deleted successfully or not
        if ($result) {
            return success('Student deleted successfully', null);
        } else {
            return fail('Something went wrong. Please try again!', null);
        }
    }
}
