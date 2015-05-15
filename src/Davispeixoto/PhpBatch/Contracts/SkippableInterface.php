<?php namespace Davispeixoto\PhpBatch\Contracts;

    /**
     * Interface ItemReaderInterface
     * @package Davispeixoto\PhpBatch\Contracts
     */

/**
 * Created by Davis Peixoto <davis.peixoto@gmail.com>.
 * Date: 5/14/15
 * Time: 6:27 PM
 * Powered By PhpStorm
 */

interface SkippableInterface extends StepInterface
{
    /**
     * @param string $exceptionName
     * @param string $exceptionMessage
     * @param int $exceptionCode
     * @return void
     */
    public function skipOn($exceptionName, $exceptionMessage = null, $exceptionCode = null);
}
