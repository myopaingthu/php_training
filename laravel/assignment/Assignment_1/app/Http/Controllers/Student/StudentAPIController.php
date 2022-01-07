<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Services\Student\StudentServiceInterface;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\MajorResource;
use App\Http\Resources\StudentResource;

class StudentAPIController extends Controller
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
     * To show student list
     *
     * @return View instance
     */
    public function showListView()
    {
        return view('api.student.index');
    }

    /**
     * To show create page
     *
     * @return View instance
     */
    public function showCreateView()
    {
        return view('api.student.create');
    }

    /**
     * To show edit page
     *
     * @param $id for student
     * @return View instance
     */
    public function showEditView($id)
    {
        return view('api.student.edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->studentInterface->getStudentsAPI();

        // Check students are queryed successfully or not.
        if ($students) {
            return success('Students list retrieved successfully', StudentResource::collection($students));
        } else {
            return fail('Something went wrong. Please try again!', null);
        }
    }

    /**
     * Get the major for create view.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMajors()
    {
        $majors = $this->studentInterface->getMajors();

        // Check majors are queryed successfully or not.
        if ($majors) {
            return success('Majors list retrieved successfully', MajorResource::collection($majors));
        } else {
            return fail('Something went wrong. Please try again!', null);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $student = $this->studentInterface->saveStudent($request);

        // Check student is created successfully or not
        if ($student) {
            return success('Student created successfully', null);
        } else {
            return fail('Something went wrong. Please try again!', null);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $apistudent)
    {
        return success('Student retrieved successfully', new StudentResource($apistudent));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $apistudent)
    {
        $result = $this->studentInterface->updateStudent($request, $apistudent);

        // Check student is updated successfully or not
        if ($apistudent) {
            return success('Student updated successfully', null);
        } else {
            return fail('Something went wrong. Please try again!', null);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $apistudent)
    {
        $result = $this->studentInterface->deleteStudent($apistudent);
        // Check student is deleted successfully or not
        if ($result) {
            return success('Student deleted successfully', null);
        } else {
            return fail('Something went wrong. Please try again!', null);
        }
    }
}
