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

interface RetryableInterface extends StepInterface
{
    /**
     * @param string $exceptionName
     * @param string $exceptionMessage
     * @param int $exceptionCode
     * @return void
     */
    public function retryOn($exceptionName, $exceptionMessage = null, $exceptionCode = null);

    /**
     * @param int $time The milliseconds before each retry
     * @return void
     */
    public function retryAfterInterval($time);

    /**
     * @param int $amount The max rey attempts before skip
     * @return void
     */
    public function setMaxAttempts($amount);
}
