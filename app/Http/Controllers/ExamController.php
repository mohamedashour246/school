<?php

namespace App\Http\Controllers;

use App\Repository\ExamRepositoryInterface;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    protected $Exams;

    public function __construct(ExamRepositoryInterface $Exams)
    {
        $this->Exams = $Exams;
    }

    public function index()
    {
        return $this->Exams->index();
    }


    public function create()
    {
        return $this->Exams->create();
    }


    public function store(Request $request)
    {
        return $this->Exams->store($request);
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
         return $this->Exams->edit($id);
    }


    public function update(Request $request)
    {
        return $this->Exams->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Exams->destroy($request);
    }
}
