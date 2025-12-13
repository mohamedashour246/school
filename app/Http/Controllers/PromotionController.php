<?php

namespace App\Http\Controllers;

use App\Repository\StudentPromotionRepositoryInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    protected $Promotion;

    public function __construct(StudentPromotionRepositoryInterface $Promotion)
    {
       $this->Promotion = $Promotion;
    }

    public function index()
    {
        return $this->Promotion->getPromotions();
    }

    public function create()
    {
         return $this->Promotion->getPromotionStudent();
    }


    public function store(Request $request)
    {
        return $this->Promotion->storePromotions($request);
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        return $this->Promotion->destroy($request);
    }
}
