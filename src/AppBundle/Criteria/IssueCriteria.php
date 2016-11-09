<?php
/**
 * Created by PhpStorm.
 * User: dev06
 * Date: 08.11.2016
 * Time: 11:14
 */

namespace AppBundle\Criteria;

use Doctrine\ORM\Query;

class IssueCriteria
{
    public $version;

    public $status;

    public $sortBy;

    public $sortOrder = 'ASC';

    public $hydrateMode = Query::HYDRATE_OBJECT;
}
