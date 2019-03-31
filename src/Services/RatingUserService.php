<?php
/**
 * Created by PhpStorm.
 * User: valen
 * Date: 30/03/2019
 * Time: 18:36
 */

namespace App\Services;


use App\Entity\User;

class RatingUserService
{
    public function addRating(int $rate, User $user): void
    {
        $nbRatings = $user->getNumberRatings();
        $userNote = $user->getNote();
        if ($nbRatings > 0 && $rate!=0) {

            $user->setNote(($userNote*$nbRatings +  $rate) / (double) ++$nbRatings);
            $user->setNumberRatings($nbRatings);
        } else if($nbRatings==0 && $rate!=0){
            $user->setNumberRatings(++$nbRatings);
            $user->setNote($rate);
        }else{
            $user->setNote($user->getNote());
        }

    }
}