<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Finder\Filter;

class SkipAndUnlinkExtension implements SubpackageInterface {

	protected $_extension = null;

	/**
	* @param string/array $extension - file extensions to be filtered, either a string or array of strings, i.e. 'txt' or array('log', 'csv')
	*/
	public function __construct($extension) {
		$this->_extension = $extension;
	}

	/**
	* returns true if the given file matches one of the given extensions ($extension)
	* automatically unlinks matched files
	* @see __constructor
	* @param SplFileInfo $file
	* @return boolean
	*/
	public function filter(\SplFileInfo $file) {
		if (is_array($this->_extension)) {
			if (in_array(pathinfo($file->getFilename(), PATHINFO_EXTENSION), $this->_extension)) {
				unlink($file->getRealPath());
				return true;
			} else {
				return false;
			}
		} else {
			if (pathinfo($file->getFilename(), PATHINFO_EXTENSION) == $this->_extension) {
				unlink($file->getRealPath());
				return true;
			} else {
				return false;
			}
		}
	}
	
}