<?php
App::import('Lib', 'elFinderConnector', true, array(), APP.'plugins' . DS .'elfinder' . DS . 'libs' . DS . 'elFinderConnector.class.php');
App::import('Lib', 'elFinder', true, array(), APP.'plugins' . DS .'elfinder' . DS . 'libs' . DS . 'elFinder.class.php');
App::import('Lib', 'elFinderVolumeDriver', true, array(), APP.'plugins' . DS .'elfinder' . DS . 'libs' . DS . 'elFinderVolumeDriver.class.php');
App::import('Lib', 'elFinderVolumeLocalFileSystem', true, array(), APP.'plugins' . DS .'elfinder' . DS . 'libs' . DS . 'elFinderVolumeLocalFileSystem.class.php');
class ElfinderFilesController extends ElfinderAppController {
    public $name = 'Files';
    public $uses = array();
    public $components = array('Session');
    public $noUpdateHash = true;
    public $opts = array(
		'debug' => true,
		'roots' => array(
			array(
				'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
				'path'          => TMP,         // path to files (REQUIRED)
				//'URL'           => dirname($_SERVER['PHP_SELF']) . '/../files/', // URL to files (REQUIRED)
				'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
			)
		)
	);

	public function access($attr, $path, $data, $volume) {
		return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
			? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
			:  null;                                    // else elFinder decide it itself
	}

	// run elFinder
	public function index(){
		Configure::write('debug', 0);
		$options = $this->opts;
		if($this->Session->check('Elfinder.options')){
			$session_vars = $this->Session->read('Elfinder.options');
			$options['roots'][0] = array_merge($this->opts['roots'][0], $session_vars['roots'][0]);
		}
		$connector = new elFinderConnector(new elFinder($options));
		$connector->run();
	}
}
