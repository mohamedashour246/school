<?php

namespace App\Http\Controllers;

use App\Http\Traits\MettingZoomTrait;
use App\Models\Grade;
//use App\Http\Traits\MettingZoomTrait;
use App\Models\OnlineClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
//use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClassController extends Controller
{
    use MettingZoomTrait;

    public function index()
    {
        $online_classes = OnlineClass::all();
        return view('pages.online_classes.index',compact('online_classes'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.create',compact('Grades'));

    }

    public function indirectCreate()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.indirect',compact('Grades'));
    }

    public function store(Request $request)
    {
        try {
            $meeting = $this->creatingMeeting($request);

            OnlineClass::create([
                'grade_id'  => $request->Grade_id,
                'classroom_id'  => $request->Classroom_id,
                'section_id'  => $request->section_id,
                'user_id'  => auth()->user()->id,
                'meeting_id'  => $meeting->id,
                'topic'  => $request->topic,
                'start_at'  => $request->start_time,
                'duration'  => $meeting->duration,
                'password'  => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url'  => $meeting->join_url,
            ]);

            return redirect()->route('online_classes.index')->with('success',trans('messages.success'));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function storeIndirect(Request $request)
    {
        try {

            OnlineClass::create([
                'grade_id'  => $request->Grade_id,
                'classroom_id'  => $request->Classroom_id,
                'section_id'  => $request->section_id,
                'user_id'  => auth()->user()->id,
                'meeting_id'  => $request->meeting_id,
                'topic'  => $request->topic,
                'start_at'  => $request->start_time,
                'duration'  => $request->duration,
                'password'  => $request->password,
                'start_url' => $request->start_url,
                'join_url'  => $request->join_url,
            ]);

            return redirect()->route('indirect.index')->with('success',trans('messages.success'));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Request $request)
    {
        try {

            $online_classe = OnlineClass::findOrFail($request->id);
            $online_classe->delete();

            return redirect()->route('online_classes.index')->with('success',trans('messages.delete'));

        }
        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
