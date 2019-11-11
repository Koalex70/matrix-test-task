<?php

class Model
{
    protected $dbh = null;

    public function __construct()
    {
        $this->dbh = DB::connectToDB();
    }
}
