<?php
/**
 * Created by PhpStorm.
 * User: Dave
 * Date: 01/05/2015
 * Time: 04:15
 */

namespace Davispeixoto\PhpBatch\Contracts;

use Exception;

interface RetryableInterface
{
    /**
     * @param Exception $exceptionName
     * @return mixed
     */
    public function retryOn(Exception $exceptionName);
}
