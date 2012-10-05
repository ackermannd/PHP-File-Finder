<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Finder;


class Newest extends \ackermannd\File\Finder {

	protected $_path;
	public function __construct($path) {
		parent::__construct($path);
	}

	/**
	* returns the newest file from the given directory
	* @return SplFileInfo $newest
	*/
	public function find() {
		$this->rewind();
		$newest = null;
		foreach ($this as $file) {
			if ($this->_applyFilter($file)) {
				continue;
			} else {
				if ($newest === null) {
					$newest = clone($file);
				}
				if ($newest->getMTime() < $file->getMTime()) {
				 	$newest = clone($file);
				 }
			}
		}
		return $newest;
	}

}