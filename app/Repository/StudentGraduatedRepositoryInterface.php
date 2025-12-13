<?php


namespace App\Repository;


interface StudentGraduatedRepositoryInterface
{
      public function index();

      public function createGraduation();

      public function softDelete($request);

      public function returnData($request);

      public function destroyStudent($request);
}
