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
interface ItemWriterInterface
{
    /**
     * @param $item
     * @return mixed
     */
    public function write($item);
}
