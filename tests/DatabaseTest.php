<?php

use Illuminate\Redis\Database;

class DatabaseTest extends PHPUnit_Framework_TestCase {

	public function testConnectMethodConnectsToDatabase()
	{
		$redis = $this->getMock('Illuminate\Redis\Database', array('openSocket', 'command'), array('127.0.0.1', 100));
		$redis->expects($this->once())->method('openSocket');
		$redis->expects($this->once())->method('command')->with($this->equalTo('select'), $this->equalTo(array(0)));

		$redis->connect();
	}


	public function testCommandMethodIssuesCommand()
	{
		$redis = $this->getMock('Illuminate\Redis\Database', array('fileWrite', 'fileGet', 'buildCommand', 'parseResponse'), array('127.0.0.1', 100));
		$redis->expects($this->once())->method('fileWrite')->with($this->equalTo('built'));
		$redis->expects($this->once())->method('buildCommand')->with($this->equalTo('foo'), $this->equalTo(array('bar')))->will($this->returnValue('built'));
		$redis->expects($this->once())->method('fileGet')->with($this->equalTo(512))->will($this->returnValue('results'));
		$redis->expects($this->once())->method('parseResponse')->with($this->equalTo('results'))->will($this->returnValue('parsed'));

		$this->assertEquals('parsed', $redis->command('foo', array('bar')));
	}


	public function testCommandsAreBuiltProperly()
	{
		$redis = new Database('127.0.0.1', 100);
		$command = $redis->buildCommand('lpush', array('list', 'taylor'));

		$this->assertEquals("*3\r\n$5\r\nLPUSH\r\n$4\r\nlist\r\n$6\r\ntaylor\r\n", $command);
	}

}