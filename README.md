# cakephp-elfinder

Elfinder plugin for CakePHP 1.3.x

## Overview
elfinder : <http://elfinder.org/>

This package contains elfinder-2.0rc1.

### Directories
* elfinder-2.0-rc1
  * /css -> <plugin_root>/webroot/css
  * /img -> <plugin_root>/webroot/img
  * /js  -> <plugin_root>/webroot/js
  * /php
    * /connector.php -> implemented on <plugin_root>/controllers/elfinder_files_controller.php
    * *.php -> <plugin_root>/libs

## Installation
1. git clone or download and unzip into app/plugins.
2. Rename directory as "elfinder".

## Usage
controller:

	$option_path = 'PATH' .DS. 'TO' .DS. 'YOURS';

	$f = new Folder();

	$f->create($option_path);

	$elfinder_options = array(
		'roots' => array(array(
			'path' => $option_path,
			'alias' => '提供ファイル:',
		))
	);

	$this->Session->write('Elfinder.options', $elfinder_options);

view:

	<?php echo $this->Html->scriptStart();?>
	$().ready(function() {
	  var elf = $('#elfinder').elfinder({
	    url : '/elfinder/elfinderFiles/index',  // connector URL (REQUIRED)
	    lang : 'jp', // (OPTION)
	    height: 400 // (OPTION)
	  }).elfinder('instance');
	});
	<?php echo $this->Html->scriptEnd();?>

	<?php echo $this->Html->css('//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css', '', array('inline' => false));?>
	
	<?php echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array('inline' => false));?>

	<?php echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js', array('inline' => false));?>
	
	<?php echo $this->Html->css('/elfinder/css/elfinder.min', '', array('inline' => false));?>

	<?php echo $this->Html->css('/elfinder/css/theme', '', array('inline' => false));?>
	
	<?php echo $this->Html->script('/elfinder/js/elfinder.min', array('inline' => false));?>

	<?php echo $this->Html->script('/elfinder/js/i18n/elfinder.jp', array('inline' => false));?>


If your elfinder connector options are set to the session named 'Elfinder.options', the elfinder_file_controller.php will merge default options dynamically.

## Conclusion
A huge thanks to elfinder dev team.