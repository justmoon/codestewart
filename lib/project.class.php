<?php
require_once('lib/glip/lib/glip.php');
require_once('lib/configfile.class.php');

class Project
{
	public $folder;
	
	protected $config = null;

	public function __construct($name)
	{
		global $qconfig;
	
		if (!is_dir($qconfig['dir_code'].$name)) {
			trigger_error('Couldn\'t find project called "'.$name.'" in '.$qconfig['dir_code'].$name, E_USER_ERROR);
		}
		
		$this->folder = $name;
		
		$this->config = new ConfigFile($qconfig['dir_code'].$name.'/config.yaml');
	}
	
	public function getName()
	{
		return $this->folder;
	}
	
	public function getTitle()
	{
		return $this->config->get('title', $this->folder);
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
	
	public function getDeployments()
	{
		require_once('lib/deployment.class.php');
	
		$deployments = array();
		
		foreach ($this->config->get('deployments', array()) as $deploymentConfig) {
			$deployments[] = Deployment::fromConfig($this, $deploymentConfig);
		}
		
		return $deployments;
	}
	
	public function getDeployment($key)
	{
		require_once('lib/deployment.class.php');
		
		$deployments = $this->config->get('deployments', array());
		
		if (!isset($deployments[$key])) {
			trigger_error('Couldn\'t find deployment '.$key.' in project "'.$this->getTitle().'"', E_USER_ERROR);
		}
		
		return Deployment::fromConfig($this, $deployments[$key]);
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
