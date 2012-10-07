<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Finder\Filter;

class FileHash implements SubpackageInterface {

	protected $_algo = 'md5';
	protected $_hash = null;

	/**
	* @param string $hash - hash of file
	* @param string $algo - algorithm of hash
	*/
	public function __construct($hash, $algo = 'md5') {
		$this->_hash = $hash;
		$this->_algo = $algo;
	}

	/**
	* returns true if the file hash of the given file is equal to the initial file hash
	* @see __constructor
	* @param SplFileInfo $file
	* @return boolean
	*/
	public function filter(\SplFileInfo $file) {
		if (hash_file($this->_algo, $file->getRealPath()) == $this->_hash) {
			return true;
		} else {
			return false;
		}
	}
	
}