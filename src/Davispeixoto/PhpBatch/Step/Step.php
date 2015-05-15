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

class Step
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
    public function run()
    {
        try {
            foreach ($this->reader->read() as $item) {
                $this->writer->write($this->processor->process($item));
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
