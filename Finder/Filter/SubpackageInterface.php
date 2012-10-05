<?php
namespace ackermannd\File\Finder\Filter;

interface SubpackageInterface {
	public function filter(\SplFileInfo $file);
}