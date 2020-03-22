# wolfie-settings
Free Wordpress plugin to create settings / options pages with builded custom fields

#To set up new settings page: download this plugin and activate than paste code below to your functions.php:

```
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
					'type' => 'dropdown',
					'desc' => 'Add some text',
					'options' => [
						'gogle2' => 'https://google.pl',  
						'wolfie2' => 'https://wolfie.com', 
						'xd2' => 'https://kwejk.pl',		 
					],
				],
				[	
					'type' => 'editor',
					'desc' => 'Add some amazing content',
				],
				[	
					'type' => 'gallery',
					'desc' => 'Add some amazing gallery',
				],
				[	
					'type' => 'color',
					'desc' => 'Add some color',
				],
			],
		],
		[
			'type' => 'group',
			'name' => 'repeater_second',
			'desc' => 'Define your custom fields in repeater',
			'fields' => [
				[	
					'type' => 'text',
					'desc' => 'Add another amazing text',
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
				[	
					'type' => 'color',
					'desc' => 'Add some color',
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
			'options' => ws_get_menus(),
		],
		[	
			'type' => 'dropdown',
			'name' => 'to-jest-dropdown2',
			'desc' => 'choose some options',
			'options' => [
				'gogle2' => 'https://google.pl',  
				'wolfie2' => 'https://wolfie.com', 
				'xd2' => 'https://kwejk.pl',		 
			],
		],
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

```

#You can create easly multiple pages by creating new instance of a class Wolfie_page:

1. create new instance of a page: $new_page = new Wolfie_page();

2. set up arguments: $args = [];
   descriptions of arguments soon.

3. Than pass it to setPage method like this: $new_page->setPage( $pageName, $args);

4. You can repeat starting from point 1 to create multiple settings page. Must to change:
	- page name
	- settings name 

5. after this you can retrieve settings from the DataBase with wp function: 
```
        $settings = get_option('wolfie_settings');
```
where 'wolfie_settings' is your settings name;

#Map Custom Fields by changing pasted array above:

Here will show up table of all settings soon...

#Custom Fields Supported:
1. Group field (repeater) / all fields below u can define to group
2. icon picker
3. text input
4. wysiwyg editor tinymce (textarea)
5. radio image picker
6. file picker
7. image picker
8. gallery picker
9. color picker with alfa channel
10. Tabs generating on settings pages.


#Future functinalities:
1. datepicker
2. easy printing settings on front by custom functions
3. adding subpage to "settings" which provide defining options without code knowledge for each settings page.