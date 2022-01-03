<?php

namespace App\Contracts\Dao\Student;

use Illuminate\Http\Request;
use App\Models\Student;

/**
 * Interface for Data Accessing Object of student
 */
interface StudentDaoInterface
{
    /**
     * To get student lists
     * @return $array of students
     */
    public function getStudents();

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
}
