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

}