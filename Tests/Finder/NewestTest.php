<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Tests\Finder;

include_once(__DIR__ . '/../../Finder.php');
include_once(__DIR__ . '/../../Finder/Newest.php');

class NewestTest extends \PHPUnit_Framework_TestCase {
	protected $_object = null;

	public function setUp() {
		fopen('1.txt', 'w');
		sleep(1);
		fopen('2.txt', 'w');
		sleep(1);
		fopen('3.txt', 'w');
		sleep(1);
		$this->_object = new \ackermannd\File\Finder\Newest(__DIR__);
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
		$this->assertEquals('3.txt', $this->_object->find()->getFilename());
	}

}