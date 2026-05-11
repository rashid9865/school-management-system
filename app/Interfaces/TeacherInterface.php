<?php

namespace App\Interfaces;

interface TeacherInterface
{
    public function getAllTeachers();
  
    public function createTeacher(array $teacherDetails);

    public function updateTeacher($id, array $teacherDetails);

    public function findById($id);

    // public function deleteTeacher($id);
}
