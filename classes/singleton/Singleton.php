<?php
namespace possystem\classes\singleton;

trait Singleton{
    // Hold the class instance.
    private static $instance = null;

    /**
     *  The object is created from within the class itself
     *  only if the class has no instance.
     *
     * @return static
     * @author dvdbergh (17-12-2021 - 09:59)
     */
    public static function getInstance()
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
