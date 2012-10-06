<?php
/*
 * (c) Daniel Ackermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ackermannd\File\Finder\Filter;

class Closure implements SubpackageInterface {

	public $closure = null;

	/**
	* @param Closure $closure
	*/
	public function __construct(\Closure $closure) {
		$this->closure = $closure;
	}

	/**
	* returns result of closure class was initiated with
	* @see __constructor
	* @param SplFileInfo $file
	* @return boolean
	*/
	public function filter(\SplFileInfo $file) {
		return call_user_func_array($this->closure, array($file));	
	}
	
}