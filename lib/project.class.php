<?php
require_once('lib/glip/lib/glip.php');

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

	public function hasRepo($name = 'main')
	{
		return null !== ProjectRepository::check($this, $name);
	}

	public function getRepo($name = 'main')
	{
		return new ProjectRepository($this, $name);
	}
}

class ProjectRepository extends Git
{
	protected $project;
	protected $name;

	public function __construct(Project $project, $name = 'main')
	{
		$this->project = $project;
		
		$repo = self::check($project, $name);
		if ($repo === null) trigger_error('Couldn\'t find repository called "'.$name.'" for project "'.$this->folder.'" in '.$repo, E_USER_ERROR);
		
		$this->name = $name;
		
		parent::__construct($repo);
	}
	
	static public function check(Project $project, $name)
	{
		global $qconfig;
		
		$repo = $qconfig['dir_code'].$project->folder.'/repo/'.$name.'/.git';
		if (!is_dir($repo)) {
			return null;
		}
		return $repo;
	}
}
