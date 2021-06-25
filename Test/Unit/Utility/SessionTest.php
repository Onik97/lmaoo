<?php
namespace Test\Unit\Core;

use PHPUnit\Framework\TestCase;
use Lmaoo\Utility\Session;

class SessionTest extends TestCase
{
    public function test_Get_getString()
    {
        $_SESSION["string"] = "Test";
        $actual = Session::Get("string");
        $this->assertEquals($_SESSION["string"], $actual);
    }

    public function test_Get_getInt()
    {
        $_SESSION["int"] = 5;
        $actual = Session::Get("int");
        $this->assertEquals($_SESSION["int"], $actual);
    }

    public function test_Set_setString()
    {
        Session::Set("string", "Test1");
        $this->assertEquals($_SESSION["string"], "Test1");
    }

    public function test_Set_setInt()
    {
        Session::Set("int", 10);
        $this->assertEquals($_SESSION["int"], 10);
    }
}