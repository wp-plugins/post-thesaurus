<?php
/*
	Plugin Name: Post Thesaurus
	Plugin URI: http://nooshu.com/wordpress-plug-in-post-thesaurus/
	Description: Thesaurus box that sits on you 'Add new post' page for easy word lookup.
	Author: <a href="http://www.nooshu.com/">Matt Hobbs</a>
	Version: 1.0.0.0
	Author URI: http://nooshu.com/
*/

/*
Wordpress Plug-in Post Thesaurus
Copyright (C) 2010 Matt Hobbs  (matt AT nooshu DOT com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

//Define the version
define('POST_THESAURUS_VERSION', '1.0.0.0');

/**
 * Thesaurus Class
 */
if(!class_exists("PostThesaurus")){
	class PostThesaurus {
		//Initialise admin options
		function init(){
			$this->admin_options();
		}//End init
		
		//The admin options
		function admin_options(){
			//Add some default options
			add_option("ta_nouns", 'on', '', 'yes');
			add_option("ta_verbs", 'on', '', 'yes');
			add_option("ta_adjs", 'on', '', 'yes');
		}//End admin_options
		
		//Init admin page
		function athesaurus_admin() {
			if(function_exists('add_management_page')){
				add_options_page('Post Thesaurus', 'Post Thesaurus', 1, basename(__FILE__), array($this,'thesaurus_admin_page'));
			}
		}//End athesaurus_admin
		
		//Add the box to the 'Add new post' page
		function athesaurus_add_meta(){
			if (function_exists('add_meta_box')){
				add_meta_box('athesaurus_meta', 'Post Thesaurus', array($this,'athesaurus_metabox'), 'post', 'side', 'high');
			}
		}//End athesaurus_add_meta
		
		//Generate the HTML for the add new post page widget
		function athesaurus_metabox(){
			//Look see how the options are set
			$nounsChecked; $verbsChecked; $adjsChecked;
			if(get_option("ta_nouns") == "on"){$nounsChecked = "checked='yes'";}
			if(get_option("ta_verbs") == "on"){$verbsChecked = "checked='yes'";}
			if(get_option("ta_adjs") == "on"){$adjsChecked = "checked='yes'";}
			
			//Option URL
			$siteurl = get_option('siteurl');
			$optionurl = $siteurl.'/wp-admin/options-general.php?page=post-thesaurus.php';
			
			//Include the panel template
			$base = dirname(__FILE__);
			include($base."/includes/panel.inc.php");
		}//End athesaurus_metabox
		
		//Generate the admin page
		function thesaurus_admin_page(){
			//Update settings
			if(isset($_POST['ta_settings'])){
				$updateNoun =  $_POST['nouns'];
				update_option("ta_nouns", $updateNoun);
				
				$updateVerbs =  $_POST['verbs'];
				update_option("ta_verbs", $updateVerbs);
				
				$updateAdjs =  $_POST['adjectives'];
				update_option("ta_adjs", $updateAdjs);
				
				$customAPI = $_POST['bhtKey'];
				update_option("taCustomAPI", $customAPI);
				
				$update_fade = '<div id="message" class="updated fade"><p>Your settings have been saved.</p></div>';
			}
			
			//Uninstall settings
			if(isset($_POST['ta_uninstall'])){
				delete_option("ta_nouns");
				delete_option("ta_verbs");
				delete_option("ta_adjs");
				delete_option("taCustomAPI");
				$update_fade = '<div id="message" class="updated fade"><p>The settings have been deleted from the database.</p></div>';
			}
			
			if(get_option("ta_nouns") == "on"){$nounsChecked = "checked='yes'";}
			if(get_option("ta_verbs") == "on"){$verbsChecked = "checked='yes'";}
			if(get_option("ta_adjs") == "on"){$adjsChecked = "checked='yes'";}
			if(get_option("taCustomAPI")){$customAPIKey = get_option("taCustomAPI");}
			
			//Include admin page template
			$base = dirname(__FILE__);
			include($base."/includes/adminpage.inc.php");
		}//End thesaurus_admin_page
		
		//Add the custom stylesheet to admin header
		function admin_register_head() {
			$site_url = get_option('siteurl');
			$css_url = $site_url . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/css/style.css';
			$js_url = $site_url . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/js/thesaurus.js';
			echo "<link rel='stylesheet' type='text/css' href='$css_url' />\n";
			echo "<script src='$js_url' type='text/javascript'></script>\n";
			
			//If custom API key, write in header
			$customAPI = get_option("taCustomAPI");
			if(isset($customAPI) && $customAPI != ""){
				echo "<script type='text/javascript'>var customAPI = '".$customAPI."';</script>";
			}
		}
	}//End PostThesaurus
}

/*
 * Initialise the class
 */
if(class_exists("PostThesaurus")){
	$PostThesaurus = new PostThesaurus();
}

if(isset($PostThesaurus)){
	//Initialise the plug-in
	register_activation_hook(__FILE__,array(&$PostThesaurus, 'init'));
	//Init add admin page
	add_action('admin_menu', array(&$PostThesaurus, 'athesaurus_admin'), 1);
	//Add css to admin header
	add_action('admin_head', array(&$PostThesaurus, 'admin_register_head'), 1);
	//Add the widget to the Add Post page
	add_action('admin_menu', array(&$PostThesaurus, 'athesaurus_add_meta'), 1);
}
?>