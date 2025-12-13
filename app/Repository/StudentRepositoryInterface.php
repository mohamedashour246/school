<?php

namespace App\Repository;

use Illuminate\Support\Facades\Request;

interface StudentRepositoryInterface
{
        public function createStudent();

        public function getClassrooms($id);

        public function getSections($id);

        public function storeStudent($request);

        public function editStudent($id);

        public function updateStudent($request);

        public function deleteStudent($request);

        public function showStudent($id);

        public function uploadAttachment($request);

        public function downloadAttachment($student_name,$filename);

        public function deleteAttachment($request);
}