<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Tests\Finder\Filter;

include_once(__DIR__ . '/../../../Finder/Filter/SubpackageInterface.php');
include_once(__DIR__ . '/../../../Finder/Filter/Closure.php');

class ClosureTest extends \PHPUnit_Framework_TestCase {
	protected $_object = null;

	/**
	* test that files with older modification time wont get filtered
	*/
	public function testClosureCallback() {

		$this->_object = new \ackermannd\File\Finder\Filter\Closure(function(\SplFileInfo $file) {
			if ($file->getFilename() == '1.txt') {
				return true;
			} else {
				return false;
			}
		});

		fopen(sys_get_temp_dir() . '/1.txt', 'w');
		fopen(sys_get_temp_dir() . '/2.txt', 'w');

		$testFile1 = new \SplFileInfo(sys_get_temp_dir() . '/1.txt');
		$testFile2 = new \SplFileInfo(sys_get_temp_dir() . '/2.txt');
		
		$this->assertEquals(true, $this->_object->filter($testFile1));
		$this->assertEquals(false, $this->_object->filter($testFile2));

		unlink(sys_get_temp_dir() . '/1.txt');
		unlink(sys_get_temp_dir() . '/2.txt');
	}

}