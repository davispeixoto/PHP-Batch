<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 4/30/15
 * Time: 5:25 PM
 */

namespace Davispeixoto\PhpBatch\Contracts;

interface TransformInterface
{
    /**
     * @param mixed $from
     * @param mixed $to
     * @param ItemInterface $item
     * @return mixed
     */
    public function transform($from, $to, ItemInterface $item);
}
