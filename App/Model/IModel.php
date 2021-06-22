<?php
namespace Lmaoo\Model;

interface IModel 
{
    public static function create(array $data);

    public static function read(array $columns, array $conditions);

    public static function update($id, array $data);
    
    public static function delete($id);
}
