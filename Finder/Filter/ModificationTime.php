<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Finder\Filter;

class ModificationTime implements SubpackageInterface {

	protected $_modificationTime = null;
	public function __construct($modificationTime) {
		$this->_modificationTime = $modificationTime;
	}

	/**
	* returns true if the given File was modified within the last XX Seconds ($modificationTime)
	* @see __constructor
	* @param SplFileInfo $file
	* @return boolean
	*/
	public function filter(\SplFileInfo $file) {
		if ($file->getMTime() > time() - $this->_modificationTime) {
			return true;
		} else {
			return false;
		}
	}
	
}