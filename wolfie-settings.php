<?php
/*
Plugin Name: Wolfie settings
Plugin URI: https://github.com/CommanderxDoge/wolfie-settings
Description: This plugin adds settings and custom fields and can easly create pages
Version: 1.0
Author: Paweł Witek
Author URI: https://github.com/CommanderxDoge/
Text Domain: ws
License: MIT
*/
if(!function_exists('unifyString')) {
	function unifyString($content){
		return $content = str_replace(' ', '_', (strtolower($content)));
	}
}
class Wolfie_settings {
	public $settings;
	public $settingsArray;
	public function __construct( ) {
		add_action('admin_enqueue_scripts', array( $this , 'wolfie_enqueue_admin_scripts' ));
	}
	public function wolfie_enqueue_admin_scripts() {
		wp_register_script('wolfie-image-picker', plugin_dir_url(__FILE__) . '/assets/js/wolfie-image-picker.js', array('jquery'));
		wp_register_script('wolfie-file-picker', plugin_dir_url(__FILE__) . '/assets/js/wolfie-file-picker.js', array('jquery'));
		wp_register_script('wolfie-gallery-picker', plugin_dir_url(__FILE__) . '/assets/js/wolfie-gallery.js', array('jquery'));
		wp_register_script('jquery-sortable', plugin_dir_url(__FILE__) . '/assets/js/jquery-ui.min.js', array('jquery','wolfie-gallery-picker'));
		wp_register_style('wolfie-settings-css', plugin_dir_url(__FILE__) . '/assets/css/wolfie-settings.css');
		wp_enqueue_style('wolfie-admin', plugin_dir_url(__FILE__) . '/assets/css/admin.css');
	}
	public function register_settings() {
		register_setting( $this->settings, $this->settings );
	}
	public function printSettings() {
		echo '<pre>';
		print_r( $this->settingsArray );
		echo '</pre>';
	}
	public function setSettings($newSettings='wolfie_settings') {
		$this->settings = $newSettings;
		$this->settingsArray = get_option($newSettings);
		add_action('admin_init', function() use($newSettings)  {
			register_setting( $newSettings, $newSettings );	
		});
	}
	public function startForm() {
		echo '<form method="post" action="options.php">';
		settings_fields( $this->settings ); 
		do_settings_sections( $this->settings );
	}
	public function endForm(){
		submit_button();
		echo '</form>';
	}

	public function imagePicker($name, $label=null){
		wp_enqueue_media();
		wp_enqueue_style('wolfie-settings-css');
		wp_enqueue_script('wolfie-image-picker');
		$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
		echo '<div class="wolfie-form-control">';
		echo '<label>'.$label.'</label>';
		echo '<input class="image" name="'.$this->settings.'['.$name.']" value="'.$value.'" type="text" hidden>';
		echo '<div class="actions"><button class="add">Add Image</button><button class="remove">Remove Image</button></div><div class="image-holder holder">';
		if(!empty($value)) {
			echo '<div class="item" data-id="'.$value.'">';
			echo $thumb = wp_get_attachment_image( $value, [100,100] );
			echo '<a href="#" class="wolfie-close"></a>';
			echo '</div>';
		}
		echo '</div>';
		echo '</div>';
	}
	public function filePicker($name, $label=null){
		wp_enqueue_media();
		wp_enqueue_script('wolfie-file-picker');
		wp_enqueue_style('wolfie-settings-css');
		$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
		echo '<div class="wolfie-form-control">';
		echo '<label>'.$label.'</label>';
		echo '<input class="file" name="'.$this->settings.'['.$name.']" value="'.$value.'" type="text" hidden>';
		echo '<div class="actions"><button class="add">Add File</button><button class="remove">Remove File</button></div><div class="file-holder holder">';
		if(!empty($value)) {
			$url = wp_get_attachment_url($value);
			$attachment_title = get_the_title($value);
			if( !strpos($url, '.png') || !strpos($url, '.jpg') || !strpos($url, '.jpeg') || !strpos($url, '.svg') ) {
				$img = '<img src="'.site_url('/').'/wp-includes/images/media/document.png" class="icon file" alt="">';
			} else {
				$img = '<img src="'.$url.'">';
			}
			echo '<div class="item" data-id="'.$value.'">'.$img.'<span class="title">'.$attachment_title.'</span>';
			echo '<a href="#" class="wolfie-close"></a>';
			echo '</div>';
		}
		echo '</div>';
		echo '</div>';
	}
	public function galleryPicker($name, $label=null) {
		wp_enqueue_media();
		wp_enqueue_script('jquery-sortable');
		wp_enqueue_style('wolfie-settings-css');
		wp_enqueue_script('wolfie-gallery-picker');
		$value = (isset($this->settingsArray[$name])) ? $this->settingsArray[$name] : '' ;
		echo '<div class="wolfie-form-control">';
		echo '<label>'.$label.'</label>';
		echo '<input class="gallery-wolfie" name="'.$this->settings.'['.$name.']" value="'.$value.'" type="text" hidden>';
		echo '<div class="actions"><button class="add">Add Images</button><button class="remove">Remove gallery</button></div><div class="images-holder holder">';
		if(!empty($value)) {
			$value = explode(',', $value);
			foreach ($value as $index => $id) {
				echo '<div class="item" data-id="'.$id.'">';
				echo $thumb = wp_get_attachment_image( $id, [100,100] );
				echo '<a href="#" class="wolfie-close"></a>';
				echo '</div>';
			}
		}
		echo '</div>';
		echo '</div>';
	}	
}
$ws = new Wolfie_settings();
$ws->setSettings('wolfie_settings');
global $ws;

class Wolfie_page {
	public $args; 	  						//its array
	public $pageName; 						//its string
	public $customFields; 					//its array
	public $dashicon;						//its string
	public $settings='wolfie_settings'; 	//its string

	public function setSettings($settings){
		$this->settings = $settings;
	}
	public function setFields($customFields) {
		$this->customFields = $customFields;
	}
	public function setPage($pageName, $args, $dashicon=''){
		if(!empty($args['settings'])){
			$this->settings = $args['settings'];
		} else  {
			$this->settings = 'wolfie_settings';
		}
		//this is main scope here settings should be registered but not fcking working
		$wolfie_page_settings = new Wolfie_settings();
		$wolfie_page_settings->setSettings('wolfie_settings');

		$this->pageName = $pageName;
		$this->dashicon = $dashicon;
		$this->args = $args;
		add_action( 'admin_menu', function(){
			$pageName = $this->pageName;
			$dashicon = $this->dashicon;
			$customFields = $this->customFields;
			$args = $this->args;
			if(empty( $args['dashicon']) && isset($this->dashicon) ) {
				$dashicon = '';
			} else {
				$dashicon = $args['dashicon'];
			}
			if(empty( $args['settings']) && isset($this->settings) ) {
				$settings = 'wolfie_settings';
			} else {
				$settings = $args['settings'];
			}
			//here register settings if settings are set
			$ws = new Wolfie_settings();
			$ws->setSettings($settings);
			$fn = function() use($args, $ws){ 
				if(empty( $args['custom_fields'])) {
					// $customFields = $this->customFields;
				} else {
					$customFields = $args['custom_fields'];
				}
				//print args

				// echo '<pre>';
				// print_r( $args );
				// echo '</pre>';

				$unified = unifyString($args['page_name']);
				do_action('wolfie_page_' . $unified);
				if(isset($args['page_body']) && $args['page_body'] === false) 
					return;
				//settings form
				$ws->startForm();
				if(!empty($customFields)) {
					foreach ($customFields as $index => $array) {
						if($array['type'] === 'image'){
							$ws->imagePicker($array['name'], $array['desc']);
						} elseif($array['type'] === 'gallery') {
							$ws->galleryPicker($array['name'], $array['desc']);
						} elseif($array['type'] === 'file') {
							$ws->filePicker($array['name'], $array['desc']);
						} else {

						}
					}
				}
				$ws->endForm();
			};
			add_menu_page( 
				__( $pageName, 'wolfie_settings' ),
				$pageName,
				'manage_options',
				$pageName,
				$fn,
				$dashicon,
				99
			); 
		} );
	}
}

$pw = new Wolfie_page();
$args = [
	'page_name' => 'Wolfie Settings',
	'page_body' => true, //if set to false options will not be displayed. You can use action hook wolfie_page_['page_name']
	'settings' => 'wolfie_settings',
	'custom_fields' => [
		[	
			'type' => 'image',
			'name' => 'test',
			'desc' => 'Add image for the ulotka'
		],
		[	
			'type' => 'file',
			'name' => 'test2',
			'desc' => 'Add image for the ulotka 2'
		],
		[	
			'type' => 'gallery',
			'name' => 'test3',
			'desc' => 'Add images to display on kontakt page'
		],
	],
	'dashicon' => plugin_dir_url(__FILE__) . 'assets/img/wolf.png'
];
$pw->setPage('Wolfie Settings', $args);
//above default page settings




/*
* Below new custom pages
*/
$pw = new Wolfie_page();
$args = [
	'page_name' => 'Incolt Settings',
	'page_body' => true, //if set to false options will not be displayed. You can use action hook wolfie_page_['page_name']
	'settings' => 'incolt_settings',
	'custom_fields' => [
		[	
			'type' => 'image',
			'name' => 'test',
			'desc' => 'Add image for the ulotka'
		],
	],
	''
];
$pw->setPage('Incolt Settings', $args);