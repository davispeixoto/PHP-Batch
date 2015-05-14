<?php namespace Davispeixoto\PhpBatch\Contracts;

/**
 * Interface ItemProcessorInterface
 * @package Davispeixoto\PhpBatch\Contracts
 */
use stdClass;

/**
 * Created by Davis Peixoto <davis.peixoto@gmail.com>.
 * Date: 5/14/15
 * Time: 4:18 PM
 * Powered By PhpStorm
 */

interface ItemProcessorInterface
{
    /**
     * @param mixed $item
     * @return mixed
     */
    public function process($item);
}
