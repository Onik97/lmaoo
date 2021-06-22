<?php
namespace Test\Unit\Core;

use PHPUnit\Framework\TestCase;
use Lmaoo\Utility\Library;

class LibraryUtility extends TestCase
{
    public function test_hasNull_single_false()
    {
        $actual = Library::hasNull("1");
        $this->assertFalse($actual);
    }

    public function test_hasNull_multiple_false()
    {
        $actual = Library::hasNull("1", "something");
        $this->assertFalse($actual);
    }

    public function test_hasNull_single_true()
    {
        $actual = Library::hasNull(null);
        $this->assertTrue($actual);
    }

    public function test_hasNull_multiple_true()
    {
        $actual = Library::hasNull("1", null, "2");
        $this->assertTrue($actual);
    }

    public function test_arrayToSelectQuery_singleColumn_noCondition()
    {
        $expected = "SELECT column1 FROM unitTest";
        $actual = Library::arrayToSelectQuery("unitTest", ["column1"]);
        $this->assertEquals($expected, $actual);
    }

    public function test_arrayToSelectQuery_singleColumn_singleCondition()
    {
        $expected = "SELECT column1 FROM unitTest WHERE key1 = 'value1'";
        $actual = Library::arrayToSelectQuery("unitTest", ["column1"], array("key1" => "value1"));
        $this->assertEquals($expected, $actual);
    }

    public function test_arrayToSelectQuery_multipleColumns_multipleConditions()
    {
        $expected = "SELECT column1,column2 FROM unitTest WHERE key1 = 'value1' AND key2 = 'value2'";
        $actual = Library::arrayToSelectQuery("unitTest", ["column1", "column2"], array("key1" => "value1", "key2" => "value2"));
        $this->assertEquals($expected, $actual);
    }

    public function test_arrayToInsertQuery_single()
    {
        $expected = "INSERT INTO unitTest (column1) VALUES ('value1')";
        $actual = Library::arrayToInsertQuery("unitTest", array("column1" => "value1"));
        $this->assertEquals($expected, $actual);
    }

    public function test_arrayToInsertQuery_multiple()
    {
        $expected = "INSERT INTO unitTest (column1,column2) VALUES ('value1','value2')";
        $actual = Library::arrayToInsertQuery("unitTest", array("column1" => "value1", "column2" => "value2"));
        $this->assertEquals($expected, $actual);
    }

    public function test_arrayToUpdateQuery_single()
    {
        $expected = "UPDATE unitTest SET column1 = 'value1' WHERE testId = ?";
        $actual = Library::arrayToUpdateQuery("unitTest", "testId", array("column1" => "value1"));
        $this->assertEquals($expected, $actual);
    }

    public function test_arrayToUpdateQuery_multiple()
    {
        $expected = "UPDATE unitTest SET column1 = 'value1',column2 = 'value2' WHERE testId = ?";
        $actual = Library::arrayToUpdateQuery("unitTest", "testId", array("column1" => "value1", "column2" => "value2"));
        $this->assertEquals($expected, $actual);
    }
}