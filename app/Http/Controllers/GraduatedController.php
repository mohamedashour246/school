<?php

namespace App\Http\Controllers;

use App\Repository\StudentGraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    protected $Graduated;


    public function __construct(StudentGraduatedRepositoryInterface $Graduated)
    {
        $this->Graduated= $Graduated;
    }


    public function index()
    {
        return $this->Graduated->index();
    }


    public function create()
    {
        return $this->Graduated->createGraduation();
    }


    public function store(Request $request)
    {
        return $this->Graduated->softDelete($request);
    }


    public function show($id)
    {

    }


    public function edit($id)
    {

    }


    public function update(Request $request)
    {
        return $this->Graduated->returnData($request);
    }


    public function destroy(Request $request)
    {
        return $this->Graduated->destroyStudent($request);
    }
}
