<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File;

class Finder {

	protected $_path;
	protected $_filter = array();
	protected $_iterator = null;

	public function __construct($path) {
		$this->_iterator = new \DirectoryIterator($path);
	}

	public function find() {
		$tmpFiles = array();
		foreach ($this->_it as $file) {
			if ($file->isDot()
				|| $file->isLink()
				|| $file->isDir()
				|| $this->_applyFilter($file)) 
			{
				continue;
			} else {
				$tmpFiles[] = clone($file);
			}
		}
		return $tmpFiles;
	}

	protected function _applyFilter(\SplFileInfo $file) {
		$filterHit = false;
		foreach ($this->_filter as $filter) {
			$filterHit = $filterHit || ($filter->filter($file));
		}
		return $filterHit;
	}

	public function addFilter(\ackermannd\File\Finder\Filter\SubpackageInterface $filter) {
		$this->_filter[] = $filter;
	}

}