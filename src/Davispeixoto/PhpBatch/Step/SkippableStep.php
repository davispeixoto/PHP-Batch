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
use Davispeixoto\PhpBatch\Contracts\SkippableInterface;
use Exception;

class SkippableStep extends ExceptionMatcherStep implements SkippableInterface
{
    /**
     * @var array
     */
    private $skippedExceptions;

    public function __construct(
        ItemReaderInterface $reader,
        ItemWriterInterface $writer,
        ItemProcessorInterface $processor
    ) {
        parent::__construct($reader, $writer, $processor);
        $this->skippedExceptions = array();
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
                    if ($this->matchException($e, $this->skippedExceptions)) {
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
    public function skipOn($exceptionName, $message = null, $code = null)
    {
        $exceptionEntry = array('name' => $exceptionName, 'code' => $code, 'message' => $message);
        $this->skippedExceptions[] = $exceptionEntry;
    }
}
