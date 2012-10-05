<?php
namespace ackermannd\File\Finder;


class Newest extends \ackermannd\File\Finder {

	protected $_path;
	public function __construct($path) {
		parent::__construct($path);
	}

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