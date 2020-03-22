<?php
if(!function_exists('is_fields')){
	function is_fields($args) {
		if( !empty($args['custom_fields'])) {
			$customFields = $args['custom_fields'];
			return $customFields;
		} else {
			return false;
		}
	}
}
if(!function_exists('is_tabs')){
	function is_tabs($args){
		if(!isset($args['tabs']) || $args['tabs'] !== false) {
			return true;
		} else {
			return false;
		}
	}
}
if(!function_exists('unifyString')) {
	function unifyString($content){
		return $content = str_replace(' ', '_', (strtolower($content)));
	}
}
if(!function_exists('ws_get_menus')) {
    function ws_get_menus() {
        $wolfieMenus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        $wolfieMenusRdy = [];
        foreach( $wolfieMenus as $key => $value ) {
            $wolfieMenusRdy[] = $value->name;
        }
        return $wolfieMenusRdy;
    }
}
if(!function_exists('get_the_icon_list')) {
function get_the_icon_list($type=null) {
	$icons = ['fontAwesome' => ['fa-fw','fab-accessible-icon','fab-accusoft','fa-address-book','fa-address-card','fa-adjust','fab-adn','fab-adversal','fab-affiliatetheme','fab-algolia','fa-align-center','fa-align-justify','fa-align-left','fa-align-right','fa-allergies','fab-amazon','fab-amazon-pay','fa-ambulance','fa-american-sign-language-interpreting','fab-amilia','fa-anchor','fab-android','fab-angellist','fa-angle-double-down','fa-angle-double-left','fa-angle-double-right','fa-angle-double-up','fa-angle-down','fa-angle-left','fa-angle-right','fa-angle-up','fab-angrycreative','fab-angular','fab-app-store','fab-app-store-ios','fab-apper','fab-apple','fab-apple-pay','fa-archive','fa-arrow-alt-circle-down','fa-arrow-alt-circle-left','fa-arrow-alt-circle-right','fa-arrow-alt-circle-up','fa-arrow-circle-down','fa-arrow-circle-left','fa-arrow-circle-right','fa-arrow-circle-up','fa-arrow-down','fa-arrow-left','fa-arrow-right','fa-arrow-up','fa-arrows-alt','fa-arrows-alt-h','fa-arrows-alt-v','fa-assistive-listening-systems','fa-asterisk','fab-asymmetrik','fa-at','fab-audible','fa-audio-description','fab-autoprefixer','fab-avianex','fab-aviato','fab-aws','fa-backward','fa-balance-scale','fa-ban','fa-band-aid','fa-bandcamp','fa-barcode','fa-bars','fa-baseball-ball','fa-basketball-ball','fa-bath','fa-battery-empty','fa-battery-full','fa-battery-half','fa-battery-quarter','fa-battery-three-quarters','fa-bed','fa-beer','fab-behance','fab-behance-square','fa-bell','fa-bell-slash','fa-bicycle','fab-bimobject','fa-binoculars','fa-birthday-cake','fab-bitbucket','fab-bitcoin','fab-bity','fab-black-tie','fab-blackberry','fa-blind','fab-blogger','fab-blogger-b','fab-bluetooth','fab-bluetooth-b','fa-bold','fa-bolt','fa-bomb','fa-book','fa-bookmark','fa-bowling-ball','fa-box','fa-box-open','fa-boxes','fa-braille','fa-briefcase','fa-briefcase-medical','fab-btc','fa-bug','fa-building','fa-bullhorn','fa-bullseye','fa-burn','fab-buromobelexperte','fa-bus','fab-buysellads','fa-calculator','fa-calendar','fa-calendar-alt','fa-calendar-check','fa-calendar-minus','fa-calendar-plus','fa-calendar-times','fa-camera','fa-camera-retro','fa-capsules','fa-car','fa-caret-down','fa-caret-left','fa-caret-right','fa-caret-square-down','fa-caret-square-left','fa-caret-square-right','fa-caret-square-up','fa-caret-up','fa-cart-arrow-down','fa-cart-plus','fab-cc-amazon-pay','fab-cc-amex','fab-cc-apple-pay','fab-cc-diners-club','fab-cc-discover','fab-cc-jcb','fab-cc-mastercard','fab-cc-paypal','fab-cc-stripe','fab-cc-visa','fab-centercode','fa-certificate','fa-chart-area','fa-chart-bar','fa-chart-line','fa-chart-pie','fa-check','fa-check-circle','fa-check-square','fa-chess','fa-chess-bishop','fa-chess-board','fa-chess-king','fa-chess-knight','fa-chess-pawn','fa-chess-queen','fa-chess-rook','fa-chevron-circle-down','fa-chevron-circle-left','fa-chevron-circle-right','fa-chevron-circle-up','fa-chevron-down','fa-chevron-left','fa-chevron-right','fa-chevron-up','fa-child','fab-chrome','fa-circle','fa-circle-notch','fa-clipboard','fa-clipboard-check','fa-clipboard-list','fa-clock','fa-clone','fa-closed-captioning','fa-cloud','fa-cloud-download-alt','fa-cloud-upload-alt','fab-cloudscale','fab-cloudsmith','fab-cloudversify','fa-code','fa-code-branch','fab-codepen','fab-codiepie','fa-coffee','fa-cog','fa-cogs','fa-columns','fa-comment','fa-comment-alt','fa-comment-dots','fa-comment-slash','fa-comments','fa-compass','fa-compress','fab-connectdevelop','fab-contao','fa-copy','fa-copyright','fa-couch','fab-cpanel','fab-creative-commons','fa-credit-card','fa-crop','fa-crosshairs','fab-css3','fab-css3-alt','fa-cube','fa-cubes','fa-cut','fab-cuttlefish','fab-d-and-d','fab-dashcube','fa-database','fa-deaf','fab-delicious','fab-deploydog','fab-deskpro','fa-desktop','fab-deviantart','fa-diagnoses','fab-digg','fab-digital-ocean','fab-discord','fab-discourse','fa-dna','fab-dochub','fab-docker','fa-dollar-sign','fa-dolly','fa-dolly-flatbed','fa-donate','fa-dot-circle','fa-dove','fa-download','fab-draft2digital','fab-dribbble','fab-dribbble-square','fab-dropbox','fab-drupal','fab-dyalog','fab-earlybirds','fab-edge','fa-edit','fa-eject','fab-elementor','fa-ellipsis-h','fa-ellipsis-v','fab-ember','fab-empire','fa-envelope','fa-envelope-open','fa-envelope-square','fab-envira','fa-eraser','fa-erlang','fab-ethereum','fab-etsy','fa-euro-sign','fa-exchange-alt','fa-exclamation','fa-exclamation-circle','fa-exclamation-triangle','fa-expand','fa-expand-arrows-alt','fab-expeditedssl','fa-external-link-alt','fa-external-link-square-alt','fa-eye','fa-eye-dropper','fa-eye-slash','fab-facebook','fab-facebook-f','fab-facebook-messenger','fab-facebook-square','fa-fast-backward','fa-fast-forward','fa-fax','fa-female','fa-fighter-jet','fa-file','fa-file-alt','fa-file-archive','fa-file-audio','fa-file-code','fa-file-excel','fa-file-image','fa-file-medical','fa-file-medical-alt','fa-file-pdf','fa-file-powerpoint','fa-file-video','fa-file-word','fa-film','fa-filter','fa-fire','fa-fire-extinguisher','fab-firefox','fa-first-aid','fab-first-order','fab-firstdraft','fa-flag','fa-flag-checkered','fa-flask','fab-flickr','fab-flipboard','fab-fly','fa-folder','fa-folder-open','fa-font','fab-font-awesome','fab-font-awesome-alt','fab-font-awesome-flag','fab-fonticons','fab-fonticons-fi','fa-football-ball','fab-fort-awesome','fab-fort-awesome-alt','fab-forumbee','fa-forward','fab-foursquare','fa-free-code-camp','fa-freebsd','fa-frown','fa-futbol','fa-gamepad','fa-gavel','fa-gem','fa-genderless','fab-get-pocket','fab-gg','fab-gg-circle','fa-gift','fab-git','fab-git-square','fab-github','fab-github-alt','fab-github-square','fab-gitkraken','fab-gitlab','fab-gitter','fa-glass-martini','fab-glide','fab-glide-g','fa-globe','fab-gofore','fa-golf-ball','fab-goodreads','fab-goodreads-g','fab-google','fab-google-drive','fab-google-play','fab-google-plus','fab-google-plus-g','fab-google-plus-square','fab-google-wallet','fa-graduation-cap','fab-gratipay','fab-grav','fab-gripfire','fab-grunt','fab-gulp','fa-h-square','fab-hacker-news','fab-hacker-news-square','fa-hand-holding','fa-hand-holding-heart','fa-hand-holding-usd','fa-hand-lizard','fa-hand-paper','fa-hand-peace','fa-hand-point-down','fa-hand-point-left','fa-hand-point-right','fa-hand-point-up','fa-hand-pointer','fa-hand-rock','fa-hand-scissors','fa-hand-spock','fa-hands','fa-hands-helping','fa-handshake','fa-hashtag','fa-hdd','fa-heading','fa-headphones','fa-heart','fa-heartbeat','fab-hips','fab-hire-a-helper','fa-history','fa-hockey-puck','fa-home','fab-hooli','fa-hospital','fa-hospital-alt','fa-hospital-symbol','fab-hotjar','fa-hourglass','fa-hourglass-end','fa-hourglass-half','fa-hourglass-start','fab-houzz','fab-html5','fab-hubspot','fa-i-cursor','fa-id-badge','fa-id-card','fa-id-card-alt','fa-image','fa-images','fab-imdb','fa-inbox','fa-indent','fa-industry','fa-info','fa-info-circle','fab-instagram','fab-internet-explorer','fab-ioxhost','fa-italic','fab-itunes','fab-itunes-note','fab-java','fab-jenkins','fab-joget','fab-joomla','fab-js','fab-js-square','fa-jsfiddle','fa-key','fa-keyboard','fab-keycdn','fab-kickstarter','fab-kickstarter-k','fab-korvue','fa-language','fa-laptop','fab-laravel','fab-lastfm','fab-lastfm-square','fa-leaf','fab-leanpub','fa-lemon','fab-less','fa-level-down-alt','fa-level-up-alt','fa-life-ring','fa-lightbulb','fab-line','fa-link','fab-linkedin','fab-linkedin-in','fab-linode','fab-linux','fa-lira-sign','fa-list','fa-list-alt','fa-list-ol','fa-list-ul','fa-location-arrow','fa-lock','fa-lock-open','fa-long-arrow-alt-down','fa-long-arrow-alt-left','fa-long-arrow-alt-right','fa-long-arrow-alt-up','fa-low-vision','fab-lyft','fab-magento','fa-magic','fa-magnet','fa-male','fa-map','fa-map-marker','fa-map-marker-alt','fa-map-pin','fa-map-signs','fa-mars','fa-mars-double','fa-mars-stroke','fa-mars-stroke-h','fa-mars-stroke-v','fab-maxcdn','fab-medapps','fab-medium','fab-medium-m','fa-medkit','fab-medrt','fab-meetup','fa-meh','fa-mercury','fa-microchip','fa-microphone','fa-microphone-slash','fab-microsoft','fa-minus','fa-minus-circle','fa-minus-square','fab-mix','fab-mixcloud','fab-mizuni','fa-mobile','fa-mobile-alt','fab-modx','fab-monero','fa-money-bill-alt','fa-moon','fa-motorcycle','fa-mouse-pointer','fa-music','fab-napster','fa-neuter','fa-newspaper','fa-nintendo-switch','fab-node','fab-node-js','fa-notes-medical','fab-npm','fab-ns8','fab-nutritionix','fa-object-group','fa-object-ungroup','fab-odnoklassniki','fab-odnoklassniki-square','fab-opencart','fab-openid','fab-opera','fab-optin-monster','fab-osi','fa-outdent','fab-page4','fab-pagelines','fa-paint-brush','fa-palfed','fa-pallet','fa-paper-plane','fa-paperclip','fa-parachute-box','fa-paragraph','fa-paste','fa-patreon','fa-pause','fa-pause-circle','fa-paw','fab-paypal','fa-pen-square','fa-pencil-alt','fa-people-carry','fa-percent','fab-periscope','fab-phabricator','fab-phoenix-framework','fa-phone','fa-phone-slash','fa-phone-square','fa-phone-volume','fab-php','fab-pied-piper','fab-pied-piper-alt','fab-pied-piper-hat','fab-pied-piper-pp','fa-piggy-bank','fa-pills','fab-pinterest','fab-pinterest-p','fab-pinterest-square','fa-plane','fa-play','fa-play-circle','fab-playstation','fa-plug','fa-plus','fa-plus-circle','fa-plus-square','fa-podcast','fa-poo','fa-pound-sign','fa-power-off','fa-prescription-bottle','fa-prescription-bottle-alt','fa-print','fa-procedures','fab-product-hunt','fab-pushed','fa-puzzle-piece','fab-python','fab-qq','fa-qrcode','fa-question','fa-question-circle','fa-quidditch','fab-quinscape','fab-quora','fa-quote-left','fa-quote-right','fa-random','fab-ravelry','fab-react','fab-readme','fab-rebel','fa-recycle','fab-red-river','fa-reddit','fa-reddit-alien','fab-reddit-square','fa-redo','fa-redo-alt','fa-registered','fab-rendact','fab-renren','fa-reply','fa-reply-all','fab-replyd','fab-resolving','fa-retweet','fa-ribbon','fa-road','fa-rocket','fab-rocketchat','fab-rockrms','fa-rss','fa-rss-square','fa-ruble-sign','fa-rupee-sign','fab-safari','fab-sass','fa-save','fab-schlix','fab-scribd','fa-search','fa-search-minus','fa-search-plus','fab-searchengin','fa-seedling','fab-sellcast','fab-sellsy','fa-server','fab-servicestack','fa-share','fa-share-alt','fa-share-alt-square','fa-share-square','fa-shekel-sign','fa-shield-alt','fa-ship','fa-shipping-fast','fab-shirtsinbulk','fa-shopping-bag','fa-shopping-basket','fa-shopping-cart','fa-shower','fa-sign','fa-sign-in-alt','fa-sign-language','fa-sign-out-alt','fa-signal','fab-simplybuilt','fab-sistrix','fa-sitemap','fab-skyatlas','fab-skype','fab-slack','fab-slack-hash','fa-sliders-h','fab-slideshare','fa-smile','fa-smoking','fa-snapchat','fab-snapchat-ghost','fab-snapchat-square','fa-snowflake','fa-sort','fa-sort-alpha-down','fa-sort-alpha-up','fa-sort-amount-down','fa-sort-amount-up','fa-sort-down','fa-sort-numeric-down','fa-sort-numeric-up','fa-sort-up','fab-soundcloud','fa-space-shuttle','fab-speakap','fa-spinner','fab-spotify','fa-square','fa-square-full','fab-stack-exchange','fab-stack-overflow','fa-star','fa-star-half','fab-staylinked','fab-steam','fab-steam-square','fab-steam-symbol','fa-step-backward','fa-step-forward','fa-stethoscope','fab-sticker-mule','fa-sticky-note','fa-stop','fa-stop-circle','fa-stopwatch','fab-strava','fa-street-view','fa-strikethrough','fab-stripe','fab-stripe-s','fab-studiovinari','fab-stumbleupon','fab-stumbleupon-circle','fa-subscript','fa-subway','fa-suitcase','fa-sun','fab-superpowers','fa-superscript','fab-supple','fa-sync','fa-sync-alt','fa-syringe','fa-table','fa-table-tennis','fa-tablet','fa-tablet-alt','fa-tablets','fa-tachometer-alt','fa-tag','fa-tags','fa-tape','fa-tasks','fa-taxi','fab-telegram','fab-telegram-plane','fab-tencent-weibo','fa-terminal','fa-text-height','fa-text-width','fa-th','fa-th-large','fa-th-list','fab-themeisle','fa-thermometer','fa-thermometer-empty','fa-thermometer-full','fa-thermometer-half','fa-thermometer-quarter','fa-thermometer-three-quarters','fa-thumbs-down','fa-thumbs-up','fa-thumbtack','fa-ticket-alt','fa-times','fa-times-circle','fa-tint','fa-toggle-off','fa-toggle-on','fa-trademark','fa-train','fa-transgender','fa-transgender-alt','fa-trash','fa-trash-alt','fa-tree','fab-trello','fab-tripadvisor','fa-trophy','fa-truck','fa-truck-loading','fa-truck-moving','fa-tty','fab-tumblr','fab-tumblr-square','fa-tv','fab-twitch','fab-twitter','fab-twitter-square','fab-typo3','fab-uber','fab-uikit','fa-umbrella','fa-underline','fa-undo','fa-undo-alt','fab-uniregistry','fa-universal-access','fa-university','fa-unlink','fa-unlock','fa-unlock-alt','fa-untappd','fa-upload','fab-usb','fa-user','fa-user-circle','fa-user-md','fa-user-plus','fa-user-secret','fa-user-times','fa-users','fab-ussunnah','fa-utensil-spoon','fa-utensils','fab-vaadin','fa-venus','fa-venus-double','fa-venus-mars','fab-viacoin','fab-viadeo','fab-viadeo-square','fa-vial','fa-vials','fab-viber','fa-video','fa-video-slash','fab-vimeo','fab-vimeo-square','fab-vimeo-v','fab-vine','fab-vk','fab-vnv','fa-volleyball-ball','fa-volume-down','fa-volume-off','fa-volume-up','fab-vuejs','fa-warehouse','fab-weibo','fa-weight','fab-weixin','fab-whatsapp','fab-whatsapp-square','fa-wheelchair','fab-whmcs','fa-wifi','fab-wikipedia-w','fa-window-close','fa-window-maximize','fa-window-minimize','fa-window-restore','fab-windows','fa-wine-glass','fa-won-sign','fab-wordpress','fab-wordpress-simple','fab-wpbeginner','fab-wpexplorer','fab-wpforms','fa-wrench','fa-x-ray','fab-xbox','fab-xing','fab-xing-square','fab-y-combinator','fab-yahoo','fab-yandex','fab-yandex-international','fab-yelp','fa-yen-sign','fab-yoast','fab-youtube','fab-youtube-square'],
		'simple icons' => ['sl-user','sl-people','sl-user-female','sl-user-follow','sl-user-following','sl-user-unfollow','sl-login','sl-logout','sl-emotsmile','sl-phone','sl-call-end','sl-call-in','sl-call-out','sl-map','sl-location-pin','sl-direction','sl-directions','sl-compass','sl-layers','sl-menu','sl-list','sl-options-vertical','sl-options','sl-arrow-down','sl-arrow-left','sl-arrow-right','sl-arrow-up','sl-arrow-up-circle','sl-arrow-left-circle','sl-arrow-right-circle','sl-arrow-down-circle','sl-check','sl-clock','sl-plus','sl-close','sl-trophy','sl-screen-smartphone','sl-screen-desktop','sl-plane','sl-notebook','sl-mustache','sl-mouse','sl-magnet','sl-energy','sl-disc','sl-cursor','sl-cursor-move','sl-crop','sl-chemistry','sl-speedometer','sl-shield','sl-screen-tablet','sl-magic-wand','sl-hourglass','sl-graduation','sl-ghost','sl-game-controller','sl-fire','sl-eyeglass','sl-envelope-open','sl-envolope-letter','sl-bell','sl-badge','sl-anchor','sl-wallet','sl-vector','sl-speech','sl-puzzle','sl-printer','sl-present','sl-playlist','sl-pin','sl-picture','sl-handbag','sl-globe-alt','sl-globe','sl-folder-alt','sl-folder','sl-film','sl-feed','sl-drop','sl-drawar','sl-docs','sl-doc','sl-diamond','sl-cup','sl-calculator','sl-bubbles','sl-briefcase','sl-book-open','sl-basket-loaded','sl-basket','sl-bag','sl-action-undo','sl-action-redo','sl-wrench','sl-umbrella','sl-trash','sl-tag','sl-support','sl-frame','sl-size-fullscreen','sl-size-actual','sl-shuffle','sl-share-alt','sl-share','sl-rocket','sl-question','sl-pie-chart','sl-pencil','sl-note','sl-loop','sl-home','sl-grid','sl-graph','sl-microphone','sl-music-tone-alt','sl-music-tone','sl-earphones-alt','sl-earphones','sl-equalizer','sl-like','sl-dislike','sl-control-start','sl-control-rewind','sl-control-play','sl-control-pause','sl-control-forward','sl-control-end','sl-volume-1','sl-volume-2','sl-volume-off','sl-calender','sl-bulb','sl-chart','sl-ban','sl-bubble','sl-camrecorder','sl-camera','sl-cloud-download','sl-cloud-upload','sl-envolope','sl-eye','sl-flag','sl-heart','sl-info','sl-key','sl-link','sl-lock','sl-lock-open','sl-magnifier','sl-magnifier-add','sl-magnifier-remove','sl-paper-clip','sl-paper-plane','sl-power','sl-refresh','sl-reload','sl-settings','sl-star','sl-symble-female','sl-symbol-male','sl-target','sl-credit-card','sl-paypal','sl-social-tumblr','sl-social-twitter','sl-social-facebook','sl-social-instagram','sl-social-linkedin','sl-social-pintarest','sl-social-github','sl-social-gplus','sl-social-reddit','sl-social-skype','sl-social-dribbble','sl-social-behance','sl-social-foursqare','sl-social-soundcloud','sl-social-spotify','sl-social-stumbleupon','sl-social-youtube','sl-social-dropbox'],
		'elegant icons' => ['et-mobile','et-laptop','et-desktop','et-tablet','et-phone','et-document','et-documents','et-search','et-clipboard','et-newspaper','et-notebook','et-book-open','et-browser','et-calendar','et-presentation','et-picture','et-pictures','et-video','et-camera','et-printer','et-toolbox','et-briefcase','et-wallet','et-gift','et-bargraph','et-grid','et-expand','et-focus','et-edit','et-adjustments','et-ribbon','et-hourglass','et-lock','et-megaphone','et-shield','et-trophy','et-flag','et-map','et-puzzle','et-basket','et-envelope','et-streetsign','et-telescope','et-gears','et-key','et-paperclip','et-attachment','et-pricetags','et-lightbulb','et-layers','et-pencil','et-tools','et-tools-2','et-scissors','et-paintbrush','et-magnifying-glass','et-circle-compass','et-linegraph','et-mic','et-strategy','et-beaker','et-caution','et-recycle','et-anchor','et-profile-male','et-profile-female','et-bike','et-wine','et-hotairballoon','et-globe','et-genius','et-map-pin','et-dial','et-chat','et-heart','et-cloud','et-upload','et-download','et-target','et-hazardous','et-piechart','et-speedometer','et-global','et-compass','et-lifesaver','et-clock','et-aperture','et-quote','et-scope','et-alarmclock','et-refresh','et-happy','et-sad','et-facebook','et-twitter','et-googleplus','et-rss','et-tumblr','et-linkedin','et-dribbble'],
		'socials' => ['fab-facebook','fab-facebook-f','fab-facebook-messenger','fab-facebook-square', 'fab-twitter','fab-twitter-square', 'fab-instagram', 'fab-pinterest','fab-pinterest-p','fab-pinterest-square','et-facebook','et-twitter','et-googleplus','et-rss','et-tumblr','et-linkedin','et-dribbble', 'sl-social-tumblr','sl-social-twitter','sl-social-facebook','sl-social-instagram','sl-social-linkedin','sl-social-pintarest','sl-social-github','sl-social-gplus','sl-social-reddit','sl-social-skype','sl-social-dribbble','sl-social-behance','sl-social-foursqare','sl-social-soundcloud','sl-social-spotify','sl-social-stumbleupon','sl-social-youtube','sl-social-dropbox', 'fab-youtube','fab-youtube-square', 'fab-whatsapp','fab-whatsapp-square']
];
if($type=='social') {
	$icons = $icons['socials'];
}
	return $icons;
}
}