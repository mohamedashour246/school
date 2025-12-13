<?php

namespace App\Repository;

use Illuminate\Support\Facades\Request;

interface TeacherRepositoryInterface
{
    public function getAllTeachers();

    public function getSpecialization();

    public function getGender();

    public function storeTeacher($request);

    public function editTeacher($id);

    public function updateTeacher($request);

    public function deleteTeacher($request);
}
