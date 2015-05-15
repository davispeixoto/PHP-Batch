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

class RetryableStep implements RetryableInterface
{
    /**
     * @var \Davispeixoto\PhpBatch\Contracts\ItemReaderInterface
     */
    private $reader;

    /**
     * @var \Davispeixoto\PhpBatch\Contracts\ItemWriterInterface
     */
    private $writer;

    /**
     * @var \Davispeixoto\PhpBatch\Contracts\ItemProcessorInterface
     */
    private $processor;

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

    public function __construct(
        ItemReaderInterface $reader,
        ItemWriterInterface $writer,
        ItemProcessorInterface $processor
    ) {
        $this->reader = $reader;
        $this->writer = $writer;
        $this->processor = $processor;
        $this->retryableExceptions = array();
        $this->maxAttempts = 0;
        $this->retryAfter = 1000;
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        try {
            foreach ($this->reader->read() as $item) {
                try {
                    $this->writer->write($this->processor->process($item));
                } catch (Exception $e) {
                    if ($this->isRetryable($e)) {
                        continue;
                    } else {
                        throw $e;
                    }
                }
            }
        } catch (Exception $e) {
            throw $e;
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


    /**
     * @param Exception $e
     * @return bool
     */
    private function isRetryable(Exception $e)
    {
        $incomingException = array('name' => get_class($e), 'code' => $e->getCode(), 'message' => $e->getMessage());

        foreach ($this->retryableExceptions as $exceptionEntry) {
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

    public function retryAfterInterval($time)
    {
        $this->retryAfter = $time;
    }

    public function setMaxAttempts($amount)
    {
        $this->maxAttempts = $amount;
    }
}
