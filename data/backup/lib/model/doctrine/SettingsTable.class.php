<?php

/**
 * SettingsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SettingsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object SettingsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Settings');
    }
}