<?php

/**
 * Breadcrumbs plugin for Pico CMS 
 *
 * @author nebman
 */
 
class Pico_Breadcrumbs {

	private $breadcrumbs = array();
	private $page_names = array();
	private $settings = array();

	public function plugins_loaded()
	{
		
	}

	public function config_loaded(&$settings)
	{
		$this->settings = $settings;
	}
	
	public function request_url(&$url)
	{
		$this->breadcrumbs = explode('/', $url);		
	}
	
	public function before_load_content(&$file)
	{
		
	}
	
	public function after_load_content(&$file, &$content)
	{
		
	}
	
	public function before_404_load_content(&$file)
	{
		
	}
	
	public function after_404_load_content(&$file, &$content)
	{
		
	}
	
	public function before_read_file_meta(&$headers)
	{
		$headers['author_url'] = 'Author_URL';
	}
	
	public function file_meta(&$meta)
	{

	}

	public function before_parse_content(&$content)
	{
		
	}
	
	public function after_parse_content(&$content)
	{
		
	}
	
	public function get_page_data(&$data, $page_meta)
	{
		
	}
	
	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page)
	{
		foreach( $pages as $page ){
			$this->page_names[$page['url']] = $page['title'];
		}
	}
	
	public function before_twig_register()
	{
		
	}
	
	public function before_render(&$twig_vars, &$twig, &$template)
	{
		$breadcrumbs = array();
		$url = $this->settings['base_url'];
		
		foreach ($this->breadcrumbs as $crumb) {
			$url = $url . '/' . $crumb;
			$name = isset($this->page_names[$url]) ?  $this->page_names[$url] : (isset($this->page_names[$url.'/']) ? $this->page_names[$url.'/'] : $crumb);
			$breadcrumbs[] = array('url' => $url, 'name' => $name);
		}
		
		$twig_vars['breadcrumbs'] = $breadcrumbs;
	}
	
	public function after_render(&$output)
	{
		
	}
	
}

?>
