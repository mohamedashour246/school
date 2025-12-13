<?php

namespace App\Repository;


use App\Models\Grade;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Library;
use Illuminate\Support\Facades\Validator;

class LibraryRepository implements LibraryRepositoryInterface
{
    use AttachFilesTrait;

    public function index()
    {
        $books = Library::all();
        return view('pages.library.index',compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create',compact('grades'));
    }

    public function store($request)
    {
        try {
            $book = new Library();
            $book->title = $request->title;
           // $book->filename = $request->file('file_name')->getClientOriginalName();
            $book->filename = $this->uploadFile($request,'file_name','library');
            $book->grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();


            return redirect()->route('libraries.index')->with('success',trans('messages.success'));
        }

        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = Library::findOrFail($id);
        return view('pages.library.edit',compact('book','grades'));
    }

    public function update($request)
    {
        try {

            $validator = Validator::make($request->all() , [
                  'title'  => 'required',
            ],
            [
                  'title.required' => 'ادخل العنوان'
            ]);

            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $book = Library::findOrFail($request->id);
            $book->title = $request->title;
            $book->grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;

            if($request->hasfile('file_name'))
            {
                $this->deleteFile($book->filename,'library');

                $this->uploadFile($request,'file_name','library');

                $filename_new = $request->file('file_name')->getClientOriginalName();
                $book->filename = $book->filename != $filename_new ? $filename_new : $book->filename;
            }

            $book->save();

            if($book->save())
            {
                return redirect()->route('libraries.index')->with('success',trans('messages.update'));
            }

            else {
                return redirect()->back()->with(['error' => 'wrong']);

            }

          //  return redirect()->route('libraries.index')->with('success',trans('messages.update'));
        }

        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $book = Library::findOrFail($request->id);

        $book->delete();

        $this->deleteFile($book->filename,'library');

        return redirect()->route('libraries.index')->with('success',trans('messages.delete'));

    }

    public function download($filename)
    {
        return response()->download(public_path('attachments/library/' .$filename));
    }
}
