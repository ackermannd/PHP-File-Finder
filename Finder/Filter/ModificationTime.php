<?php
namespace ackermannd\File\Finder\Filter;

class ModificationTime implements SubpackageInterface {

	protected $_modificationTime = null;
	public function __construct($modificationTime) {
		$this->_modificationTime = $modificationTime;
	}

	public function filter(\SplFileInfo $file) {
		if ($file->getMTime() > time() - $this->_modificationTime) {
			return true;
		} else {
			return false;
		}
	}
	
}