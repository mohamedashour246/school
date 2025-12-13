<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizzeRequest;
use App\Repository\QuizzRepositoryInterface;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    protected $Quiz;

    public function __construct(QuizzRepositoryInterface $Quiz)
    {
        $this->Quiz = $Quiz;
    }

    public function index()
    {
        return $this->Quiz->index();
    }


    public function create()
    {
        return $this->Quiz->create();
    }

    public function store(StoreQuizzeRequest $request)
    {
        return $this->Quiz->store($request);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        return $this->Quiz->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Quiz->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Quiz->destroy($request);
    }
}
