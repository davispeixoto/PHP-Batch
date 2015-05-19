<?php namespace Davispeixoto\PhpBatch\Step;

    /**
     * Class ExceptionMatcherStep
     * @package Davispeixoto\PhpBatch\Step
     */

/**
 * Created by Davis Peixoto <davis.peixoto@gmail.com>.
 * Date: 5/18/15
 * Time: 9:59 AM
 * Powered By PhpStorm
 */

use Exception;

abstract class ExceptionMatcherStep extends AbstractStep
{
    /**
     * @param Exception $exception
     * @param array $theVector
     * @return bool
     */
    protected function matchException(Exception $exception, Array $theVector)
    {
        $incomingException = array(
            'name' => get_class($exception),
            'code' => $exception->getCode(),
            'message' => $exception->getMessage()
        );

        foreach ($theVector as $exceptionEntry) {
            if ($this->exceptionTypeMatch($incomingException['name'], $exceptionEntry['name'])
                &&
                $this->exceptionDetailMatch($incomingException['name'], $exceptionEntry['name'])
                &&
                $this->exceptionDetailMatch($incomingException['message'], $exceptionEntry['message'])
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $compare
     * @param string $base
     * @return bool
     */
    protected function exceptionTypeMatch($compare, $base)
    {
        if ($compare === $base) {
            return true;
        }

        return false;
    }

    /**
     * @param string $compare
     * @param string|null $base
     * @return bool
     */
    protected function exceptionDetailMatch($compare, $base)
    {
        if (is_null($base)) {
            return true;
        }

        if ($compare === $base) {
            return true;
        }

        return false;
    }
}
