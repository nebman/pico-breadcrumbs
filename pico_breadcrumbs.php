<?php

/**
 * Breadcrumbs plugin for Pico CMS 
 *
 * @author nebman
 */
 
class Pico_Breadcrumbs extends AbstractPicoPlugin {

  protected $enabled = false;

	private $breadcrumbs = array();
	private $page_names = array();
	private $settings = array();

  public function onConfigLoaded(array &$config)
  {
		$this->settings = $config;
	}

  public function onRequestUrl(&$url)
  {
		$this->breadcrumbs = explode('/', $url);		
    if(end($this->breadcrumbs) == "index") array_pop($this->breadcrumbs);
	}
	
  public function onMetaHeaders(array &$headers)
  {
		$headers['author_url'] = 'Author_URL';
	}

  public function onPagesLoaded(
      array &$pages,
      array &$currentPage = null,
      array &$previousPage = null,
      array &$nextPage = null
  ) {
		foreach( $pages as $page ){
      // index removed
      $url = $page['url'];
      if(substr($url, -5) === "index") {
        $url = substr($url, 0, -5);
      }
      
			$this->page_names[$url] = $page['title'];
		}
	}

  public function onPageRendering(Twig_Environment &$twig, array &$twigVariables, &$templateName)
  {
		$breadcrumbs = array();
		$url = substr($this->settings['base_url'], 0, -1);
		$baseurl = $url;
		foreach ($this->breadcrumbs as $crumb) {
			$url = $url . '/' . $crumb;
			$exists = $this->url_exists(substr($url, strlen($baseurl)));
			$name = isset($this->page_names[$url]) ?  $this->page_names[$url] : (isset($this->page_names[$url.'/']) ? $this->page_names[$url.'/'] : $crumb);
			$breadcrumbs[] = array('url' => "$url/", 'name' => $name, 'exists' => $exists );
		}
		
		$twigVariables['breadcrumbs'] = $breadcrumbs;
	}

  /*
   * URL to check whether the real URL ( copy from Pico source )
   *
   * @param $url URL
   *
   */
  private function url_exists($url)
  {
    $file = "";
    $ext = $this->settings['content_ext'];
		if($url) $file = $this->settings['content_dir'] . $url;
		else $file = $this->settings['content_dir'] .'index';

		if(is_dir($file)) $file = $this->settings['content_dir'] . $url .'/index'. $ext;
  		else $file .= $ext;
		return file_exists($file);
  }
	
}

?>
