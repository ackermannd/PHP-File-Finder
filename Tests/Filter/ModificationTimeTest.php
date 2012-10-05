<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Tests\Finder\Filter;

include_once(__DIR__ . '/../../Finder/Filter/SubpackageInterface.php');
include_once(__DIR__ . '/../../Finder/Filter/ModificationTime.php');

class ModificationTimeTest extends \PHPUnit_Framework_TestCase {
	protected $_object = null;
	protected $_testFileName = '';
	protected $_testFileMTime = 5;

	public function setUp() {
		$this->_testFileName = 	sys_get_temp_dir() . '/1.txt';
		fopen($this->_testFileName, 'w');
		$this->_object = new \ackermannd\File\Finder\Filter\ModificationTime($this->_testFileMTime);
	}

	public function tearDown() {
		unlink($this->_testFileName);
	}

	/**
	* test that files with older modification time wont get filtered
	*/
	public function testFilterFindPositive() {
		sleep($this->_testFileMTime+1);
		$file = new \SplFileInfo($this->_testFileName);
		$this->assertEquals(false, $this->_object->filter($file));
	}

	/**
	* test that files with younger modification time will get filtered
	*/
	public function testFilterFindNegative() {
		$file = new \SplFileInfo($this->_testFileName);
		$this->assertEquals(true, $this->_object->filter($file));
	}
}