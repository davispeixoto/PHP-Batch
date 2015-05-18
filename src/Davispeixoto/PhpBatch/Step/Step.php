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

use Exception;

class Step extends AbstractStep
{

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
