<?php namespace Davispeixoto\PhpBatch\Item\Reader;

    /**
     * Class DatabaseItemReader
     * @package Davispeixoto\PhpBatch\Item\Reader
     */

/**
 * Created by Davis Peixoto <davis.peixoto@gmail.com>.
 * Date: 5/15/15
 * Time: 10:42 AM
 * Powered By PhpStorm
 */

class DatabaseItemReader
{
    /**
     * @var string
     */
    public $sql;

    /**
     * @var array $params
     */
    public $params;

    /**
     * @var resource The database connection
     */
    public $conn;

    public $resultset;

    public function __construct($conn)
    {

    }

    public function read()
    {

    }
}
