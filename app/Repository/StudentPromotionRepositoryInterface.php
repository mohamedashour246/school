<?php


namespace App\Repository;


interface StudentPromotionRepositoryInterface
{
     public function getPromotions();

    public function storePromotions($request);

    public function getPromotionStudent();

    public function destroy($request);
}
