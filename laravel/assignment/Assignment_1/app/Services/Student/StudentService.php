<?php

namespace App\Services\Student;

use App\Contracts\Dao\Student\StudentDaoInterface;
use App\Contracts\Services\Student\StudentServiceInterface;
use App\Mail\StudentList;
use App\Mail\StudentRegistered;
use App\Models\Student;
use Illuminate\Http\Request;
use Mail;

/**
 * Service class for student.
 */
class StudentService implements StudentServiceInterface
{
    /**
     * student dao
     */
    private $studentDao;
    /**
     * Class Constructor
     * @param StidentDaoInterface
     * @return
     */
    public function __construct(StudentDaoInterface $studentDao)
    {
        $this->studentDao = $studentDao;
    }

    /**
     * To get student lists
     * @param Request $request request with inputs
     * @return $array of students
     */
    public function getStudents(Request $request)
    {
        return $this->studentDao->getStudents($request);
    }

    /**
     * To get student lists
     * @return $array of students
     */
    public function getStudentsAPI()
    {
        return $this->studentDao->getStudentsAPI();
    }

    /**
     * To get major lists
     * @return $array of majors
     */
    public function getMajors()
    {
        return $this->studentDao->getMajors();
    }

    /**
     * To save student
     * @param Request $request request with inputs
     * @return Object $post saved student
     */
    public function saveStudent(Request $request)
    {
        $student = $this->studentDao->saveStudent($request);
        // Check student is created successfully or not.
        if ($student) {
            Mail::to($student->email)->send(new StudentRegistered);
            // Check mail sending process has error.
            if (count(Mail::failures()) > 0) {
                dd(Mail::failures());
            } else {
                return $student;
            }
        }
    }

    /**
     * To update student
     * @param Request $request request with inputs
     * @param App\Models\Student $student
     * @return Object $post saved student
     */
    public function updateStudent(Request $request, Student $student)
    {
        return $this->studentDao->updateStudent($request, $student);
    }

    /**
     * To delete student
     * @param App\Models\Student $student
     * @return Object $post saved student
     */
    public function deleteStudent(Student $student)
    {
        return $this->studentDao->deleteStudent($student);
    }

    /**
     * To upload student csv file
     * @return File Upload CSV file
     */
    public function uploadStudentCSV()
    {
        return $this->studentDao->uploadStudentCSV();
    }

    /**
     * To send email to specified email
     * 
     * @param Request $request request with inputs
     * @return bool
     */
    public function sendEmail(Request $request)
    {
        $students = $this->studentDao->getStudents($request)->take(10);
        if ($students) {
            Mail::to($request->email)->send(new StudentList($students));
            // Check mail sending process has error.
            if (count(Mail::failures()) > 0) {
                dd(Mail::failures());
            } else {
                return true;
            }
        }
    }
}
