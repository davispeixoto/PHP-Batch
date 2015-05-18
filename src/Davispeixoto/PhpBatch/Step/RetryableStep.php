<?php namespace Davispeixoto\PhpBatch\Step;

/**
 * Class Step
 * @package Davispeixoto\PhpBatch\Step
 */

/**
 * Created by Davis Peixoto <davis.peixoto@gmail.com>.
 * Date: 5/14/15
 * Time: 3:46 PM
 * Powered By PhpStorm
 */

use Davispeixoto\PhpBatch\Contracts\ItemProcessorInterface;
use Davispeixoto\PhpBatch\Contracts\ItemReaderInterface;
use Davispeixoto\PhpBatch\Contracts\ItemWriterInterface;
use Davispeixoto\PhpBatch\Contracts\RetryableInterface;
use Exception;

class RetryableStep extends ExceptionMatcherStep implements RetryableInterface
{
    /**
     * @var array
     */
    private $retryableExceptions;

    /**
     * @var int milliseconds for retry
     */
    private $retryAfter;

    /**
     * @var int
     */
    private $maxAttempts;

    private $attempts;

    public function __construct(
        ItemReaderInterface $reader,
        ItemWriterInterface $writer,
        ItemProcessorInterface $processor
    ) {
        parent::__construct($reader, $writer, $processor);
        $this->retryableExceptions = array();
        $this->maxAttempts = 1;
        $this->retryAfter = 1000;
        $this->attempts = 0;
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        try {
            foreach ($this->reader->read() as $item) {
                $this->attempts = 0;
                $this->runItem($item);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function runItem($item)
    {
        try {
            $this->attempts += 1;
            $this->writer->write($this->processor->process($item));
        } catch (Exception $e) {
            if ($this->matchException($e, $this->retryableExceptions) && $this->attempts < $this->maxAttempts) {
                usleep($this->retryAfter * 1000);
                $this->runItem($item);
            } else {
                throw $e;
            }
        }
    }

    /**
     * @param string $exceptionName
     * @param string $message
     * @param int $code
     */
    public function retryOn($exceptionName, $message = null, $code = null)
    {
        $exceptionEntry = array('name' => $exceptionName, 'code' => $code, 'message' => $message);
        $this->retryableExceptions[] = $exceptionEntry;
    }

    public function retryAfterInterval($time)
    {
        $this->retryAfter = $time;
    }

    public function setMaxAttempts($amount)
    {
        $this->maxAttempts = $amount;
    }
}
