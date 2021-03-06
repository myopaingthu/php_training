<?php

namespace App\Http\Controllers\Student;

use App\Contracts\Services\Student\StudentServiceInterface;
use App\Exports\StudentsExport;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\StudentMailRequest;
use App\Http\Requests\StudentUploadRequest;
use App\Http\Requests\UpdateStudentRequest;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = $this->studentInterface->getStudents($request);

        return view('student.index')
            ->with(['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majors = $this->studentInterface->getMajors();

        return view('student.create')
            ->with(['majors' => $majors]);
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
            return redirect()
                ->route('students.index')
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
    public function edit(Student $student)
    {
        $majors = $this->studentInterface->getMajors();

        return view('student.edit')
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
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $result = $this->studentInterface->updateStudent($request, $student);

        // Check student is updated successfully or not
        if ($result) {
            return redirect()
                ->route('students.index')
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
    public function destroy(Student $student)
    {
        $result = $this->studentInterface->deleteStudent($student);
        // Check student is deleted successfully or not
        if ($result) {
            return success('Student deleted successfully', null);
        } else {
            return fail('Something went wrong. Please try again!', null);
        }
    }

    /**
     * To download student csv file
     * @return File Download CSV file
     */
    public function downloadStudentCSV()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    /**
     * To download student pdf file
     * @return File Download PDF file
     */
    public function downloadStudentPDF()
    {
        return $this->studentInterface->downloadStudentPDF();
    }

    /**
     * Show the form for uploading csv.
     *
     * @return \Illuminate\Http\Response
     */
    public function showStudentUploadView()
    {
        return view('student.upload');
    }

    /**
     * Import from an excel file
     * 
     * @param \Illuminate\Http\Request $request 
     * @return \Illuminate\Http\Response
     */
    public function submitStudentUpload(StudentUploadRequest $request)
    {
        // Check imported successfully or not
        if ($this->studentInterface->uploadStudentCSV()) {
            return redirect()
                ->route('students.index')
                ->with('success', 'Imported successfully.');
        } else {
            return back()
                ->withErrors('Something went wrong. Please try again!');
        }
    }

    /**
     * Show the form for email to send.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEailForm()
    {
        return view('student.emilForm');
    }

    /**
     * Send email
     * 
     * @param \Illuminate\Http\Request $request 
     * @return \Illuminate\Http\Response
     */
    public function postEailFormSubmit(StudentMailRequest $request)
    {
        // Check email is sent successfully or not
        if ($this->studentInterface->sendEmail($request)) {
            return redirect()
                ->route('students.index')
                ->with('success', 'Email is sent successfully.');
        } else {
            return back()
                ->withErrors('Something went wrong. Please try again!');
        }
    }
}
