<?php
namespace Lmaoo\Utility;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class Validation
{
    public static function validate(callable $cp)
    {
        try { $cp(); }
        catch(NestedValidationException $e) 
        { 
            $results = ""; $messages = $e->getMessages();
            foreach ($messages as $key => $value) {
                $results = $results . " $value,";
            }
            return trim(substr($results, 0, -1));
        }
    }

    public static function ProgressAccess($data)
    {
        foreach($data as $d) {
            return self::validate(function() use ($d) {
                v::key("userId", v::intval())
                ->key("projectId", v::intval())
                ->key("allowAccess", v::NotOptional()->boolVal()) // Not optional to allow 0 but not null
                ->key("managerAccess", v::NotOptional()->boolVal()) // Not optional to allow 0 but not null
                ->assert($d);
            });
        }
    }

    public static function createProject($data)
    {
        return self::validate(function() use ($data) {
            v::key("name", v::NotOptional()->stringVal())
             ->key("status", v::NotOptional()->stringVal())
             ->key("owner", v::NotOptional()->intval())
             ->key("active", v::NotOptional()->boolVal())
             ->assert($data);
        });
    }

    public static function updateUser($data)
    {
        return self::validate(function() use ($data) {
            v::key("userId", v::NotOptional()->intval())
            ->key("username", v::NotOptional()->stringVal())
            ->key("forename", v::NotOptional()->stringVal())
            ->key("surname", v::NotOptional()->stringVal())
            ->key("level", v::NotOptional()->intval())
            ->key("isActive", v::NotOptional()->boolVal())
            ->assert($data);
        });
    }
    
    public static function login($data)
    {
        return self::validate(function() use ($data) {
            v::key("username", v::NotOptional()->stringVal())
            ->key("password", v::NotOptional()->stringVal())
            ->assert($data);
        });
    }

    public static function register($data)
    {
        return self::validate(function() use ($data) {
            v::key("forename", v::NotOptional()->stringVal())
            ->key("surname", v::NotOptional()->stringVal())
            ->key("username", v::NotOptional()->stringVal())
            ->key("password", v::NotOptional()->stringVal())
            ->assert($data);
        });
    }

    public static function createTicket($data)
    {
        return self::validate(function() use ($data) {
            v::key("summary", v::NotOptional()->stringVal())
            ->key("featureId", v::NotOptional()->stringVal())
            ->key("reporter_key", v::NotOptional()->stringVal())
            ->assert($data);
        });
    }

    public static function createFeature($data)
    {
        return self::validate(function() use ($data) {
            v::key("name", v::NotOptional()->stringType()->stringVal())
            ->key("projectId", v::NotOptional()->intType()->intval())
            ->assert($data);
        });
    }
}