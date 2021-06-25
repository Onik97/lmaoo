<?php
namespace Lmaoo\Utility;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class Validation
{
    public static function ProgressAccess($data)
    {
        try {
            v::notEmpty()->setName("JSON Data")->assert($data);
            foreach($data as $d) {
                v::key("userId", v::intval())
                 ->key("projectId", v::intval())
                 ->key("allowAccess", v::NotOptional()->boolVal()) // Not optional to allow 0 but not null
                 ->key("managerAccess", v::NotOptional()->boolVal()) // Not optional to allow 0 but not null
                 ->assert($d);
            }
        } catch(NestedValidationException $e) {
            return json_encode($e->getMessages());
        }
    }

    public static function createProject($data)
    {
        try {
            v::key("name", v::NotOptional()->stringVal())
             ->key("status", v::NotOptional()->stringVal())
             ->key("owner", v::NotOptional()->intval())
             ->key("active", v::NotOptional()->boolVal())
             ->assert($data);
        } catch(NestedValidationException $e) {
            return json_encode($e->getMessages());
        }
    }

    public static function updateUser($data)
    {
        try {
            v::key("userId", v::NotOptional()->intval())
             ->key("username", v::NotOptional()->stringVal())
             ->key("forename", v::NotOptional()->stringVal())
             ->key("surname", v::NotOptional()->stringVal())
             ->key("level", v::NotOptional()->intval())
             ->key("isActive", v::NotOptional()->boolVal())
             ->assert($data);
        } catch(NestedValidationException $e) {
            return json_encode($e->getMessages());
        }
    }
    
    public static function login($data)
    {
        try {
            v::key("username", v::NotOptional()->stringVal())
             ->key("password", v::NotOptional()->stringVal())
             ->assert($data);
        } catch(NestedValidationException $e) {
            return json_encode($e->getMessages());
        }
    }

    public static function register($data)
    {
        try {
            v::key("forename", v::NotOptional()->stringVal())
             ->key("surname", v::NotOptional()->stringVal())
             ->key("username", v::NotOptional()->stringVal())
             ->key("password", v::NotOptional()->stringVal())
             ->assert($data);
        } catch(NestedValidationException $e) {
            return json_encode($e->getMessages());
        }
    }

    public static function createTicket($data)
    {
        try {
            v::key("summary", v::NotOptional()->stringVal())
             ->key("featureId", v::NotOptional()->stringVal())
             ->key("reporter_key", v::NotOptional()->stringVal())
             ->assert($data);
        } catch(NestedValidationException $e) {
            return json_encode($e->getMessages());
        }
    }
}