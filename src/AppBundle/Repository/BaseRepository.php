<?php
/**
 * Created by PhpStorm.
 * User: dev06
 * Date: 08.11.2016
 * Time: 11:17
 */

namespace AppBundle\Repository;

interface BaseRepository
{
    /**
     * @param $criteria
     * @return array<array>
     ***/
    public function match($criteria);
}
