File Finder
===========

An extensible PHP class to identify a specific set of files in a directory.


Basic Usage
-----------

	$finder = new ackermannd\File\Finder(__DIR__);
	$finder->find();

This will return all Files in the given Directory which aren't a directory, a link, . or .. . 

	$finder = new ackermannd\File\Finder\Newest(__DIR__);
	$finder->addFilter(new ackermannd\File\Finder\Filter\ModificationTime(60)); 

This will return the newest File of the given Directory which was not modified in the last 60 seconds.

Filter
------

Filter classes can be created and added to a Finder to Filter the returned Files. All added Filters will be tested against the given Directory files.
