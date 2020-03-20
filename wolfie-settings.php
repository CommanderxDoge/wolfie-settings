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

define( 'WS_PLUGIN_URL', plugin_dir_url(__FILE__));

include( plugin_dir_path( __FILE__ ) . '/inc/helpers/helpers.php');

class Wolfie_settings {
	public $settings;
	public $settingsArray;
	public function __construct( ) {
		add_action('admin_enqueue_scripts', array( $this , 'wolfie_enqueue_admin_scripts' ));
	}
	public function wolfie_enqueue_admin_scripts() {
		wp_enqueue_style('font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_register_script('wolfie-image-picker', plugin_dir_url(__FILE__) . '/assets/js/wolfie-image-picker.js', array('jquery'));
		wp_register_script('wolfie-file-picker', plugin_dir_url(__FILE__) . '/assets/js/wolfie-file-picker.js', array('jquery'));
		wp_register_script('wolfie-gallery-picker', plugin_dir_url(__FILE__) . '/assets/js/wolfie-gallery.js', array('jquery'));
		// wp_register_script('jquery-sortable', plugin_dir_url(__FILE__) . '/assets/js/jquery-ui.min.js', array('jquery','wolfie-gallery-picker'));
		wp_register_script('wolfie-colorpicker-alpha-js', plugin_dir_url(__FILE__) . '/assets/js/wp-color-picker-alpha.min.js', array('jquery','wp-color-picker'), false, true );
		wp_register_style('wolfie-settings-css', plugin_dir_url(__FILE__) . '/assets/css/wolfie-settings.css');
		//enqueue everywhere scripts
		wp_register_script('wolfie-js', plugin_dir_url(__FILE__) . '/assets/js/wolfie.js', array('jquery'));
		wp_register_script('wolfie-fonticonpicker-js', plugin_dir_url(__FILE__) . '/assets/js/fonticonpicker.min.js', array('jquery'));
		wp_register_script('wolfie-switcher-js', plugin_dir_url(__FILE__) . '/assets/js/switcher.js', array('jquery'));
		wp_register_script('wolfie-radioimage-js', plugin_dir_url(__FILE__) . '/assets/js/radioimage.js', array('jquery'));
		wp_enqueue_style( 'wp-color-picker' ); 
		wp_enqueue_style('wolfie-admin-css', plugin_dir_url(__FILE__) . '/assets/css/admin.css');
		//ICONPICKER
		wp_enqueue_style('wolfie-fonticonpicker-css', plugin_dir_url(__FILE__) . '/assets/css/iconpicker/jquery.fonticonpicker.darkgrey.min.css');
		wp_enqueue_style('wolfie-fonticonpickerbase-css', plugin_dir_url(__FILE__) . '/assets/css/iconpicker/jquery.fonticonpicker.min.css');
		wp_register_script('wolfie-iconpicker-js', plugin_dir_url(__FILE__) . '/assets/js/init/iconpicker.js', ['jquery','wolfie-fonticonpicker-js']);
		wp_localize_script('wolfie-iconpicker-js', 'wolf', [
			'icons' => get_the_icon_list(),
		]);
		wp_localize_script('wolfie-group-js', 'wolf', [
			'icons' => get_the_icon_list(),
		]);
		//ICONIFY IF U LL NEED
		// wp_enqueue_script('iconify', 'https://code.iconify.design/1/1.0.4/iconify.min.js');
		//GROUP JS
		wp_register_script('wolfie-group-js', plugin_dir_url(__FILE__) . '/assets/js/wolfie-group.js', ['jquery','wolfie-iconpicker-js']);
		wp_register_style('wolfie-icons', plugin_dir_url(__FILE__) . '/assets/css/icons.css');
		//init fields by using libraries
		wp_register_script('wolfie-colorpicker-init', plugin_dir_url(__FILE__) . '/assets/js/init/colorpicker.js', array('jquery','wolfie-colorpicker-alpha-js'));
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
	public function imagePicker($name=null, $label=null, $print=false){
		include( plugin_dir_path( __FILE__ ) . '/inc/custom_fields/image-picker.php');
		return $content;
	}
	public function filePicker($name=null, $label=null, $print=false){
		include( plugin_dir_path( __FILE__ ) . '/inc/custom_fields/file-picker.php');
		return $content;
	}
	public function textPicker($name=null, $label=null, $print=false){
		include( plugin_dir_path( __FILE__ ) . '/inc/custom_fields/text-picker.php');
		return $content;
	}
	public function colorPicker($name=null, $label=null, $print=false){
		include( plugin_dir_path( __FILE__ ) . '/inc/custom_fields/color-picker.php');
		return $content;
	}
	public function galleryPicker($name=null, $label=null, $print=false) {
		include( plugin_dir_path( __FILE__ ) . '/inc/custom_fields/gallery-picker.php');
		return $content;
	}	
	public function editor($name=null, $label=null, $print=false) {
		include( plugin_dir_path( __FILE__ ) . '/inc/custom_fields/editor-picker.php');
		return $content;
	}
	public function dropdown($name=null, $label=null, $options=['map some options'], $print=false) {
		include( plugin_dir_path( __FILE__ ) . '/inc/custom_fields/dropdown.php');
		return $content;
	}
	public function checkbox($name=null, $label=null, $checked=null, $print=false) {
		include( plugin_dir_path( __FILE__ ) . '/inc/custom_fields/checkbox.php');
		return $content;
	}
	public function radioimage($name=null, $label=null, $options=null, $print=false) {
		include( plugin_dir_path( __FILE__ ) . '/inc/custom_fields/radioimage.php');
		return $content;
	}
	public function iconPicker($name=null, $label=null, $options=null, $print=false) {
		include( plugin_dir_path( __FILE__ ) . '/inc/helpers/helpers.php');
		include( plugin_dir_path( __FILE__ ) . '/inc/custom_fields/icon-picker.php');
		return $content;
	}
	public function group($name=null, $label=null, $fields=null, $print=false) {
		include( plugin_dir_path( __FILE__ ) . '/inc/custom_fields/group.php');
		return $content;
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
		include( plugin_dir_path( __FILE__ ) . '/inc/helpers/helpers.php');
		if(!empty($args['settings'])){
			$this->settings = $args['settings'];
		} else  {
			$this->settings = 'wolfie_settings';
		}
		$this->pageName = $pageName;
		$this->dashicon = $dashicon;
		$this->args = $args;
		//localize wolfie.js for set cookie to each
		add_action('admin_enqueue_scripts', function() use ($pageName){
			if(isset($_GET['page']) && $_GET['page'] === $pageName) {
				$pageName = unifyString($pageName);
				$data = ['cookieName' => $pageName ];
				wp_localize_script( 'wolfie-js', 'wolfie', $data );
			}
		});
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
			
			$fn = function() use($args, $ws, $pageName){ 
				$customFields = is_fields($args);
				$unified = unifyString($args['page_name']);
				$first = true;
				do_action('wolfie_page_' . $unified);
				if(isset($args['page_body']) && $args['page_body'] === false) 
					return;
				// set content to tabs
				if(is_fields($args)) {
					$tabs = [
						'general' => [],
					];
					$i = 0;
					foreach ($customFields as $index => $array) {
						$tab_name = (isset($array['tab'])) ? $array['tab'] : 'general' ;
						if($tab_name) {
							if($array['type'] === 'image'){
								$field = $ws->imagePicker($array['name'], $array['desc']);
							} elseif($array['type'] === 'gallery') {
								$field = $ws->galleryPicker($array['name'], $array['desc']);
							} elseif($array['type'] === 'file') {
								$field = $ws->filePicker($array['name'], $array['desc']);
							} elseif($array['type'] === 'text') {
								$field = $ws->textPicker($array['name'], $array['desc']);
							} elseif($array['type'] === 'color') {
								$field = $ws->colorPicker($array['name'], $array['desc']);
							} elseif($array['type'] === 'editor') {
								$field = $ws->editor($array['name'], $array['desc']);
							} elseif($array['type'] === 'dropdown') {
								if(empty($array['options'])) {
									$field = 'ERROR: Add some options to your dropdown!';
								} else {
									$options = $array['options'];
									$field = $ws->dropdown($array['name'], $array['desc'], $array['options']);
								}
							} elseif($array['type'] === 'checkbox') {
								$field = $ws->checkbox($array['name'], $array['desc']);
							} elseif($array['type'] === 'radioimage') {
								if(!empty($array['options'])) {
									$options = $array['options'];
									$field = $ws->radioimage($array['name'], $array['desc'], $options);
								} else {
									$field = 'ERROR: Add some options for your radioimage';
								}
							} elseif($array['type'] === 'icon') {
								$field = $ws->iconPicker($array['name'], $array['desc']);
							} elseif($array['type'] === 'group') {
								$field = $ws->group($array['name'], $array['desc'],$array['fields']);
							} else {
								$field = '';
							}
							$tabs[$tab_name][$i] = $field;
							$i++;
						}
					}
				}
				wp_enqueue_script('wolfie-js');
				//set html on page
				echo '<div style="display:none;" class="wolfie-container wolfie-fadeIn">';
				echo '<h1>'. $pageName .'</h1>';
				echo '<div class="wolfie-row">';
				if(is_tabs($args)) {					
					echo '<div class="wolfie-col col-2">';
					if(!empty($customFields)) {						
						echo '<ul class="wolfie-tabs">';
						foreach($tabs as $tab_name => $arr ) {
							$active = ($first) ? 'active' : '' ;
							$tab_name_u = unifyString($tab_name);
							echo '<li class="'.$tab_name.' '.$active.'" data-tab="wolfie_'.$tab_name_u.'">';
							echo $tab_name;
							echo '</li>';
							$first = false;
						}
						echo '</ul>';
					}
					echo '</div>';
				}
				echo '<div class="wolfie-col col-7">';
				echo '<div class="wolfie-settings">';
				$ws->startForm();
				if(is_fields($args)) {
					foreach($tabs as $tab_name => $arr ) {
						$active = ($first) ? 'active' : '' ;
						$tab_name_u = unifyString($tab_name);
						echo '<div class="wolfie_tab_container wolfie_'.$tab_name_u.' '.$active.'">';
						if(is_tabs($args)) {
							echo '<h2 class="tab-title">' . $tab_name . '</h2>';
						}
						foreach ($arr as $index => $field) {
							echo $field;
						}
						echo '</div>';
						$first = false;
					}
				}
				$ws->endForm();
				echo '</div>';
				echo '</div>';
				echo '<div class="wolfie-col col-3">'; ?>
				<div class="wolfie-information">
					<div class="box">
						<div class="wolfie-header">
							<div class="wolfie-row">
								<div class="quote">
									<i class="fa fa-quote-right" aria-hidden="true"></i>
									<p>Standing on the giants shoulders, let you see more!</p>
								</div><!-- /quote -->
								<div class="owner-wrapper" style="width:80px;height:80px;">
									<img class="owner" src="<?php echo WS_PLUGIN_URL . 'assets/img/pawel-witek.jpg' ?>">
								</div><!-- /owner-wrapper -->
							</div><!-- /wolfie-row -->
							<p style="text-align: right;">Paweł Witek CEO at <a href="https://wolfiesites.com">wolfiesites.com</a></p>
						</div><!-- /header -->
					</div><!-- /box -->
				</div><!-- /wolfie-main-options -->
				<?php
				do_action('wolfie_information');
				echo '</div>';
				echo '</div>';
				echo '</div>';
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
	'page_name' => 'Wolfie Settings', //required
	'page_body' => true, //optional if set to false options wont show. You can use action hook wolfie_page_['page_name']
	'tabs' => true, //optional default true
	'settings' => 'wolfie_settings',
	'custom_fields' => [
		[
			'type' => 'group',
			'name' => 'repeater',
			'desc' => 'Define your custom fields in repeater',
			'fields' => [
				[	
					'type' => 'icon',
					'desc' => 'Add some amazing icons',
				],
				[	
					'type' => 'text',
					'desc' => 'Add some text',
				],
				[	
					'type' => 'editor',
					'desc' => 'Add some amazing content',
				],
				[	
					'type' => 'gallery',
					'desc' => 'Add some amazing gallery',
				],
			],
		],
		[
			'type' => 'icon',
			'name' => 'this-is-iconpicker1',
			'desc' => 'Pick some icon',
		],
		[
			'type' => 'icon',
			'name' => 'this-is-iconpicker2',
			'desc' => 'Pick some icon',
		],
		[	
			'type' => 'radioimage',
			'name' => 'to-jest-radioimage',
			'desc' => 'Wybierz Layout',
			'options' => [
				[
					'image' => 'https://api.fnkr.net/testimg/350x200/00CED1/FFF/?text=img+placeholder',
					'label' => 'option 1'
				],
				[
					'image' => 'https://api.fnkr.net/testimg/350x200/00CED1/FFF/?text=img+placeholder',
					'label' => 'option 2'
				],
			],
		],
		[
			'type' => 'checkbox',
			'name' => 'this-is-checkbox3',
			'desc' => 'enable sticky?',
		],
		[	
			'type' => 'dropdown',
			'name' => 'to-jest-dropdown',
			'desc' => 'choose some options',
			'options' => [
				'google' => 'https://google.pl',  //label => value
				'wolfie' => 'https://wolfie.com', //label => value
				'xd' => 'https://kwejk.pl',		  //label => value
			],
		],
		[	
			'type' => 'dropdown',
			'name' => 'to-jest-dropdown2',
			'desc' => 'choose some options',
			'options' => [
				'gogle2' => 'https://google.pl',  //label => value
				'wolfie2' => 'https://wolfie.com', //label => value
				'xd2' => 'https://kwejk.pl',		  //label => value
			],
		],
		// [	
		// 	'type' => 'editor',
		// 	'name' => 'to-jest-editor',
		// 	'desc' => 'Add some text to Editor',
		// ],
		[	
			'type' => 'text',
			'name' => 'to-jest-text',
			'desc' => 'Add some text',
		],
		[	
			'type' => 'color',
			'name' => 'colorpicker',
			'desc' => 'Pick some color',
		],
		[	
			'type' => 'whatever',
			'name' => 'colorpicker2',
			'desc' => 'Pick some color2',
		],
		[	
			'type' => 'image',
			'name' => 'test',
			'desc' => 'Add image for the ulotka',
		],
		[	
			'type' => 'file',
			'name' => 'test2',
			'desc' => 'Add image for the ulotka 2', //optional
		],
		[	
			'type' => 'gallery',
			'name' => 'test3',
			'desc' => 'Add images to display on kontakt page', //optional
		],
		[	
			'type' => 'text',
			'name' => 'text-niesamowity',
			'desc' => 'Add some text',
			'tab' => 'typography'
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
	'tabs' => false, // if tabs false only general content tab will be displayed
	'settings' => 'incolt_settings',
	'custom_fields' => [
		[	
			'type' => 'image',
			'name' => 'test',
			'desc' => 'Add image for the ulotka',
		],
		[	
			'type' => 'image',
			'name' => 'test-image-2',
			'desc' => 'Add image for the ulotka',
		],
	],
	''
];
$pw->setPage('Incolt Settings', $args);
