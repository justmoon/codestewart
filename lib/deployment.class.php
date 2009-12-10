<?php

class Deployment
{
	protected $project;
	protected $config;

	public function __construct(Project $project, $config)
	{
		$this->project = $project;
		$this->config = $config;
	}
	
	public function getName()
	{
		return $this->config['host'];
	}
	
	static public function fromConfig(Project $project, $config)
	{
		return new self($project, $config);
	}
}
