<?php

/**
 * Class Model
 */
class Model
{

    /**
     * @var array
     */
    public $fields;

    /**
     * @var false|mysqli|null
     */
    protected $db = null;

    /**
     * Model constructor.
     * @param array $fields
     */
    public function __construct($fields = [])
    {
        $this->fields['id'] = '#';
        $this->db = DB::connect();
    }

}
