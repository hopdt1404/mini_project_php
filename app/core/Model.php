<?php

abstract class Model
{
    protected static $instance = null;
    public abstract static function getInstance();

}
