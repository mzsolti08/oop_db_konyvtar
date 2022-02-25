<?php

namespace App;

class Config
{
    protected array $config = array();

    public function __construct()
    {
        $this->config['DB_HOST'] = "localhost";
        $this->config['DB_USER'] = "konyvtar_user";
        $this->config['DB_PASS'] = "/JVjQLpiS2FgVBD7";
        $this->config['DB_DATABASE'] = "konyvtar";
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? "";
    }
}