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
use Davispeixoto\PhpBatch\Contracts\StepInterface;
use Davispeixoto\PhpBatch\Traits\ExceptionMatcher;
use Exception;

class MultiProcessStep implements StepInterface
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
     * @var int
     */
    private $processAmount;

    public function __construct(
        ItemReaderInterface $reader,
        ItemWriterInterface $writer,
        ItemProcessorInterface $processor
    ) {
        $this->reader = $reader;
        $this->writer = $writer;
        $this->processor = $processor;
        $this->processAmount = 1;
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
     * Sets the maximum parallel process
     * @param int $amount
     */
    public function setProcessAmount($amount)
    {
        $this->processAmount = $amount;
    }
}
