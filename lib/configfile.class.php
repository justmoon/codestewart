<?php

class ConfigFile
{
	protected $filename;
	
	protected $settings = null;

	public function __construct($filename)
	{
		$this->filename = $filename;
	}
	
	public function load()
	{
		if (file_exists($this->filename)) {
			require_once('lib/spyc/spyc.php');
			$this->settings = Spyc::YAMLLoad($this->filename);
		} else {
			$this->settings = array();
		}
	}
	
	public function save()
	{
		// If settings is null
		//  -> means the file was never loaded because no setting was changed
		//  -> means no need to save
		if ($this->settings === null) return;
		
		$yaml = Spyc::YAMLDump($this->settings);
	}
	
	public function get($key, $default = null)
	{
		if ($this->settings === null) $this->load();
		
		if (isset($this->settings[$key])) {
			return $this->settings[$key];
		} else {
			return $default;
		}
	}
	
	public function set($key, $value)
	{
		if ($this->settings === null) $this->load();
		
		$this->settings[$key] = $value;
	}
}
