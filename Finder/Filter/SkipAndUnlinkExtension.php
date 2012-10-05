<?php
namespace ackermannd\File\Finder\Filter;

class SkipAndUnlinkExtension implements SubpackageInterface {

	protected $_extension = null;
	public function __construct($extension) {
		$this->_extension = $extension;
	}

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