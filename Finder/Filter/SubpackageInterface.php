<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Finder\Filter;

interface SubpackageInterface {
	/**
	* returns true if the given file matches the filter criteria
	* @param SplFileInfo $file
	* @return boolean
	*/
	public function filter(\SplFileInfo $file);
}