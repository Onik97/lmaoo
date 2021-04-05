<?php

interface IModel 
{
    public static function create(array $data);

    public static function withId($id, $columns);

    public static function update($id, array $data);
    
    public static function delete($id);
}