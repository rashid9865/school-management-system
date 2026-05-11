<?php

namespace App\Interfaces;


interface StudentInterface
{
    public function getAllStudents();

    public function createStudent(array $studentDetails);
    
    public function showStudent($id);

    public function updateStudent($id, array $studentDetails);

    public function deleteStudent($id);  

    public function findById($id);
}
