<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/26/15
 * Time: 9:35 AM
 */
class Sqlite extends SQLite3{
    public function __construct($dbName){
        $this->open($dbName);
    }
}

