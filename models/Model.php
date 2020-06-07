<?php

/**
 * Class Model
 */
class Model
{

    /**
     * @var false|mysqli|null
     */
    protected $db = null;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = DB::connect();
    }

}
