<?php

class UNL_Common
{

    /**
     * The driver to be used for retrieving data
     *
     * @var UNL_Common_DataDriverInterface
     */
    public $driver;

    /**
     * Get the current data driver
     *
     * @return UNL_Common_DataDriverInterface
     */
    static public function getDriver()
    {
        if (!isset($driver)) {
            self::$driver = new UNL_Common_JSONDataDriver();
        }
        return $driver;
    }

}

