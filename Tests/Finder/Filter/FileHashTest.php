<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Tests\Finder\Filter;

include_once(__DIR__ . '/../../../Finder/Filter/SubpackageInterface.php');
include_once(__DIR__ . '/../../../Finder/Filter/FileHash.php');

class FileHashTest extends \PHPUnit_Framework_TestCase {
	protected $_object = null;
	protected $_testFileName = '';
	protected $_testFileName2 = '';

	public function setUp() {
		$this->_testFileName = 	sys_get_temp_dir() . '/1.txt';
		$this->_testFileName2 = 	sys_get_temp_dir() . '/2.txt';
		$handle = fopen($this->_testFileName, 'w');
		fwrite($handle, 'TestContent1');
		fclose($handle);

		$handle = fopen($this->_testFileName2, 'w');
		fwrite($handle, 'TestContent2');
		fclose($handle);
	}

	public function tearDown() {
		unlink($this->_testFileName);
		unlink($this->_testFileName2);
	}

	/**
	* test that files with older modification time wont get filtered
	*/
	public function testFilterFindPositive() {
		$this->_object = new \ackermannd\File\Finder\Filter\FileHash(hash_file('md5', $this->_testFileName));
		$file = new \SplFileInfo($this->_testFileName);
		$this->assertEquals(true, $this->_object->filter($file));
	}

	/**
	* test that files with younger modification time will get filtered
	*/
	public function testFilterFindNegative() {
		$this->_object = new \ackermannd\File\Finder\Filter\FileHash(hash_file('md5', $this->_testFileName));
		$file = new \SplFileInfo($this->_testFileName2);
		$this->assertEquals(false, $this->_object->filter($file));
	}
}