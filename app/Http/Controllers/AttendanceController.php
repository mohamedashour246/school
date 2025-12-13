<?php

namespace App\Http\Controllers;

use App\Repository\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $Attendance;

    public function __construct(AttendanceRepositoryInterface $Attendance)
    {
        $this->Attendance = $Attendance;
    }

    public function index()
    {
        return $this->Attendance->index();
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        return $this->Attendance->store($request);
    }


    public function show($id)
    {
        return $this->Attendance->show($id);
    }


    public function edit($id)
    {
        return $this->Attendance->edit($id);
    }


    public function update(Request $request)
    {
        return $this->Attendance->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->Attendance->destroy($request);
    }
}
