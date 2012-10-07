<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Tests\Finder\Filter;

include_once(__DIR__ . '/../../../Finder/Filter/SubpackageInterface.php');
include_once(__DIR__ . '/../../../Finder/Filter/SkipAndUnlinkExtension.php');

class SkipAndUnlinkExtensionTest extends \PHPUnit_Framework_TestCase {
	protected $_object = null;
	protected $_testFileNames = array();

	public function setUp() {
		$this->_testFileNames[] = sys_get_temp_dir() . '/1.txt';
		$this->_testFileNames[] = sys_get_temp_dir() . '/1.log';
		$this->_testFileNames[] = sys_get_temp_dir() . '/1.csv';
		foreach ($this->_testFileNames as $file ) {
			fopen($file, 'w');	
		}
	}

	public function tearDown() {
		foreach ($this->_testFileNames as $file) {
			@unlink($file);
		}
	}

	/**
	* test that only files with the given extension will be unlinked
	*/
	public function testUnlinkingOfOneExtension() {
		$this->_object = new \ackermannd\File\Finder\Filter\SkipAndUnlinkExtension('txt');

		$this->assertEquals(true, $this->_object->filter(new \SplFileInfo($this->_testFileNames[0])));
		$this->assertEquals(false, $this->_object->filter(new \SplFileInfo($this->_testFileNames[1])));
		$this->assertEquals(false, $this->_object->filter(new \SplFileInfo($this->_testFileNames[2])));

		$this->assertEquals(false, is_file($this->_testFileNames[0]));
		$this->assertEquals(true, is_file($this->_testFileNames[1]));
		$this->assertEquals(true, is_file($this->_testFileNames[2]));

	}

	/**
	* test that a file extension array can be given and all files will be unlinked
	*/
	public function testUnlinkingOfExtensionArray() {
		$this->_object = new \ackermannd\File\Finder\Filter\SkipAndUnlinkExtension(array('csv', 'log'));

		$this->assertEquals(false, $this->_object->filter(new \SplFileInfo($this->_testFileNames[0])));
		$this->assertEquals(true, $this->_object->filter(new \SplFileInfo($this->_testFileNames[1])));
		$this->assertEquals(true, $this->_object->filter(new \SplFileInfo($this->_testFileNames[2])));

		$this->assertEquals(true, is_file($this->_testFileNames[0]));
		$this->assertEquals(false, is_file($this->_testFileNames[1]));
		$this->assertEquals(false, is_file($this->_testFileNames[2]));
	}
}