<?php

class Project
{
	public $folder;

	public function __construct($name)
	{
		global $qconfig;
	
		if (!is_dir($qconfig['dir_code'].$name)) {
			trigger_error('Couldn\'t find project called "'.$name.'" in '.$qconfig['dir_code'].$name, E_USER_ERROR);
		}
		
		$this->folder = $name;
	}
	
	public function getTitle()
	{
		return $this->folder;
	}

	static public function getAll()
	{
		global $qconfig;
		
		$codeDir = dir($qconfig['dir_code']);
		$projects = array();
		
		while (false !== $project = $codeDir->read()) {
			if ($project{0} == '.') continue;
			if (is_dir($qconfig['dir_code'].$project)) $projects[] = new Project($project);
		}
		
		return $projects;
	}

}
