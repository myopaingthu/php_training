<?php

namespace App\Contracts\Services\Student;

use App\Models\Student;
use Illuminate\Http\Request;

/**
 * Interface for Student service
 */
interface StudentServiceInterface
{
    /**
     * To get student lists
     * @param Request $request request with inputs
     * @return $array of students
     */
    public function getStudents(Request $request);

    /**
     * To get student lists
     * @return $array of students
     */
    public function getStudentsAPI();

    /**
     * To get major lists
     * @return $array of majors
     */
    public function getMajors();

    /**
     * To save student
     * @param Request $request request with inputs
     * @return Object $post saved student
     */
    public function saveStudent(Request $request);

    /**
     * To update student
     * @param Request $request request with inputs
     * @param App\Models\Student $student
     * @return Object $post saved student
     */
    public function updateStudent(Request $request, Student $student);

    /**
     * To delete student
     * @param App\Models\Student $student
     * @return Object $post saved student
     */
    public function deleteStudent(Student $student);

    /**
     * To upload student csv file
     * @return File Upload CSV file
     */
    public function uploadStudentCSV();
}
