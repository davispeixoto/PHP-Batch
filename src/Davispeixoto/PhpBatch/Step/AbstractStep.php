<?php namespace Davispeixoto\PhpBatch\Step;

/**
 * Class AbstractStep
 * @package Davispeixoto\PhpBatch\Step
 */

/**
 * Created by Davis Peixoto <davis.peixoto@gmail.com>.
 * Date: 5/18/15
 * Time: 9:50 AM
 * Powered By PhpStorm
 */

use Davispeixoto\PhpBatch\Contracts\StepInterface;
use Davispeixoto\PhpBatch\Contracts\ItemReaderInterface;
use Davispeixoto\PhpBatch\Contracts\ItemWriterInterface;
use Davispeixoto\PhpBatch\Contracts\ItemProcessorInterface;
use Exception;

abstract class AbstractStep implements StepInterface
{
    /**
     * @var \Davispeixoto\PhpBatch\Contracts\ItemReaderInterface
     */
    protected $reader;

    /**
     * @var \Davispeixoto\PhpBatch\Contracts\ItemWriterInterface
     */
    protected $writer;

    /**
     * @var \Davispeixoto\PhpBatch\Contracts\ItemProcessorInterface
     */
    protected $processor;

    public function __construct(
        ItemReaderInterface $reader,
        ItemWriterInterface $writer,
        ItemProcessorInterface $processor
    ) {
        $this->reader = $reader;
        $this->writer = $writer;
        $this->processor = $processor;
    }

    /**
     * @throws Exception
     */
    abstract public function run();
}
