<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 5/4/15
 * Time: 4:38 PM
 */

namespace Davispeixoto\PhpBatch\Contracts;


interface ItemInterface {

    /**
     * @param $property
     * @return mixed
     */
    public function get($property);

    /**
     * @param $property
     * @param $value
     * @return mixed
     */
    public function set($property, $value);
}
