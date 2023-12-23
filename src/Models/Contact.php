<?php

namespace Autum\SDK\Platform\Models;

class Contact extends Model {

    /**
     * @var array
     */
    private $attributes = [];

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }


}