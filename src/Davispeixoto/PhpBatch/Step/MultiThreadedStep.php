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
use Exception;
use Thread;

class MultiThreadedStep extends AbstractStep
{
    /**
     * @var int
     */
    private $threadsAmount;

    /**
     * @var Thread[]
     */
    private $threads;

    public function __construct(
        ItemReaderInterface $reader,
        ItemWriterInterface $writer,
        ItemProcessorInterface $processor
    ) {
        parent::__construct($reader, $writer, $processor);
        $this->processAmount = 1;
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        try {
            for ($i = 0; $i < $this->processAmount; $i++) {
                $this->processes[] = new Process('foo');
            }

            $this->runProcesses();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function runProcesses()
    {
        foreach ($this->processes as $process) {
            try {
                $process->start();
            } catch (Exception $e) {
                continue;
            }
        }
    }

    /**
     * @param int $amount
     */
    public function setThreadsQuantity($amount)
    {
        $this->threadsAmount = $amount;
    }
}
