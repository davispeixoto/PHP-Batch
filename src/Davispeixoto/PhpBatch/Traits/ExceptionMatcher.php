<?php namespace Davispeixoto\PhpBatch\Traits;
/**
 * Created by Davis Peixoto <davis.peixoto@gmail.com>.
 * Date: 5/14/15
 * Time: 3:46 PM
 * Powered By PhpStorm
 */

/**
 * Class ExceptionMatcher
 * @package Davispeixoto\PhpBatch\Traits
 */
trait ExceptionMatcher
{
    /**
     * @param Exception $e
     * @param array $theVector
     * @return bool
     */
    private function matchException(Exception $e, Array $theVector)
    {
        $incomingException = array('name' => get_class($e), 'code' => $e->getCode(), 'message' => $e->getMessage());

        foreach ($theVector as $exceptionEntry) {
            if ($this->exceptionTypeMatch($incomingException['name'], $exceptionEntry['name'])
                &&
                $this->exceptionCodeMatch($incomingException['name'], $exceptionEntry['name'])
                &&
                $this->exceptionMessageMatch($incomingException['message'], $exceptionEntry['message'])
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
    private function exceptionTypeMatch($compare, $base)
    {
        if ($compare === $base) {
            return true;
        }

        return false;
    }

    /**
     * @param int $compare
     * @param int|null $base
     * @return bool
     */
    private function exceptionCodeMatch($compare, $base)
    {
        if (is_null($base)) {
            return true;
        }

        if ($compare == $base) {
            return true;
        }

        return false;
    }

    /**
     * @param string $compare
     * @param string|null $base
     * @return bool
     */
    private function exceptionMessageMatch($compare, $base)
    {
        if (is_null($base)) {
            return true;
        }

        if ($compare == $base) {
            return true;
        }

        return false;
    }
}
