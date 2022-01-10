<?php

namespace App\Dao\Student;

use App\Contracts\Dao\Student\StudentDaoInterface;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Major;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

/**
 * Data Access Object for Student
 */
class StudentDao implements StudentDaoInterface
{
    /**
     * To get student lists
     * @param Request $request request with inputs
     * @return $array of students
     */
    public function getStudents(Request $request)
    {
        $name = $request->name;
        $start = $request->start;
        $end = $request->end;

        $students = DB::table('students as student')
            ->join('majors as major', 'student.major_id', '=', 'major.id')
            ->select('student.*', 'major.name as major');
        if ($name) {
            $students->where('student.name', 'LIKE', '%' . $name . '%');
        }
        if ($start) {
            $students->whereDate('student.created_at', '>=', $start);
        }
        if ($end) {
            $students->whereDate('student.created_at', '<=', $end);
        }
        return $students->latest()->get();
    }

    /**
     * To get student lists
     * @return $array of students
     */
    public function getStudentsAPI()
    {
        return Student::with('major')->latest()->get();
    }

    /**
     * To get major lists
     * @return $array of majors
     */
    public function getMajors()
    {
        return Major::all();
    }

    /**
     * To save student
     * @param Request $request request with inputs
     * @return Object $post saved student
     */
    public function saveStudent(Request $request)
    {
        $student = DB::transaction(function () use ($request) {
            return Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'dob' => $request->dob,
                'major_id' => $request->major
            ]);
        }, 5);

        return $student;
    }

    /**
     * To update student
     * @param Request $request request with inputs
     * @param App\Models\Student $student
     * @return Object $post saved student
     */
    public function updateStudent(Request $request, Student $student)
    {
        $student = DB::transaction(function () use ($request, $student) {
            return $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'dob' => $request->dob,
                'major_id' => $request->major
            ]);
        }, 5);

        return $student;
    }

    /**
     * To delete student
     * @param App\Models\Student $student
     * @return Object $post saved student
     */
    public function deleteStudent(Student $student)
    {
        $student = DB::transaction(function () use ($student) {
            return $student->delete();
        }, 5);
        
        return $student;
    }

    /**
     * To upload student csv file
     * @return File Upload CSV file
     */
    public function uploadStudentCSV()
    {
        return Excel::import(new StudentsImport, request()->file('file'));
    }
}
