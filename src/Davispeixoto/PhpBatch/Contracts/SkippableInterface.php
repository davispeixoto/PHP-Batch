<?php
/**
 * Created by PhpStorm.
 * User: Dave
 * Date: 01/05/2015
 * Time: 04:14
 */

namespace Davispeixoto\PhpBatch\Contracts;

use Exception;

interface SkippableInterface
{
    /**
     * @param Exception $exceptionName
     * @return mixed
     */
    public function skipOn(Exception $exceptionName);

}
