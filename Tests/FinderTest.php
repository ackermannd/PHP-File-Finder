<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Tests;

include_once(__DIR__ . '/../Finder.php');
include_once(__DIR__ . '/../Finder/Filter/SubpackageInterface.php');
include_once(__DIR__ . '/../Finder/Filter/ModificationTime.php');

class FinderTest extends \PHPUnit_Framework_TestCase {
	protected $_object = null;

	public function setUp() {
		fopen('1.txt', 'w');
		fopen('2.txt', 'w');
		fopen('3.txt', 'w');
		$this->_object = new \ackermannd\File\Finder(__DIR__);
	}

	public function tearDown() {
		unlink('1.txt');
		unlink('2.txt');
		unlink('3.txt');
	}


	/**
	* test that the file finder finds all  files in the current directroy
	*/
	public function testFind() {
		$tmp = $this->_object->find();
		foreach ($tmp as $file) {
			$result[] = $file->getFilename();
		}
		$this->assertEquals(array('1.txt', '2.txt', '3.txt', 'FinderTest.php'), $result);
	}

	/**
	* test that a added filter will called once for every file in the directory
	*/
	public function testFilter() {
		$mock = $this->getMock('\ackermannd\File\Finder\Filter\ModificationTime', array('filter'), array('80'));
		$mock->expects($this->exactly(4))->method('filter')->will($this->returnValue(true));

		$this->_object->addFilter($mock);
		$tmp = $this->_object->find();
	}
}