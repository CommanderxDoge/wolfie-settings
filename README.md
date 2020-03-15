# wolfie-settings
Wordpress plugin to create new settings pages with custom fields with it

#To set up new settings page download this plugin and activate than in your functions.php:

1. create new instance of a page: $new_page = new Wolfie_page();

2. set up arguments: $args = [];
   descriptions of arguments soon. For now there is only 3 custom fields: gallery, image, file picker.

3. Than pass it to method: $new_page->setPage( $pageName, $args);

4. You can repeat starting from point 1 to create multiple settings page. Change only page name and settings name.

#Future functinalities:
1. Group Field (repeater)
2. icon picker
3. text input
4. wysiwyg editor (textarea)
5. radio image picker
6. font picker
7. typography
8. some APIs (youtube, instagram etc)
9. Tabs generating with cookies.