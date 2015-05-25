<?php
class Engine{

	function __construct()
	{
		date_default_timezone_set('UTC');
		
		session_start();
		
	}
	
	function pageName()
	{
		if ($keys = array_keys($_GET))
		{
			if (file_exists('pages/' . $keys[0]))
				return $keys[0];
		}
		return 'home';
	}
	
	function hasPageSection($sectionName)
	{
		$path = sprintf('pages/%s/%s.html', $this->pageName(), $sectionName); 
		
		return file_exists($path);
	}
	
	function includeOptionalSection($sectionName)
	{
		if ($this->hasPageSection($sectionName))
		{
			include($sectionName . '.html');
		}
	}
}

?>