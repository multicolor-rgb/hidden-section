<?php

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");
 
# register plugin
register_plugin(
	$thisfile, //Plugin id
	'Hidden section', 	//Plugin name
	'1.0', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'https://multicolor.stargard.pl', //author website
	'the plugin is used to hide user sections that are unnecessary for the user', //Plugin description
	'settings', //page type - on which admin tab to display
	'hideadminsection'  //main function (administration)
);
 
# activate filter 
add_action('header','hello_world'); 
 
# add a link in the admin tab 'theme'
add_action('settings-sidebar','createSideMenu',array($thisfile,'Hidden section options'));
 
# functions
function hello_world() {

    $plugin_id = 'hideadminsection';
 
    // Set up the folder name and its permissions
    // Note the constant GSDATAOTHERPATH, which points to /path/to/getsimple/data/other/
    $folder        = GSDATAOTHERPATH . '/' . $plugin_id . '/';
    $hidefilesfile = $folder . 'hidefiles.txt';
    $hidethemesfile = $folder . 'hidethemes.txt';
    $hidebackupfile = $folder . 'hidebackup.txt';
    $hidepluginfile = $folder . 'hideplugin.txt';
    $chmod_mode    = 0755;
    $folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);


    echo'<style>';

    echo file_get_contents($hidefilesfile) ;
    echo file_get_contents($hidethemesfile) ;
    echo file_get_contents($hidepluginfile) ;
    echo file_get_contents($hidebackupfile) ;
echo '</style>';
}
 
function hideadminsection() {

    $plugin_id = 'hideadminsection';
 
    // Set up the folder name and its permissions
    // Note the constant GSDATAOTHERPATH, which points to /path/to/getsimple/data/other/
    $folder        = GSDATAOTHERPATH . '/' . $plugin_id . '/';
    $hidefilesfile = $folder . 'hidefiles.txt';
    $hidethemesfile = $folder . 'hidethemes.txt';
    $hidebackupfile = $folder . 'hidebackup.txt';
    $hidepluginfile = $folder . 'hideplugin.txt';
    $chmod_mode    = 0755;
    $folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);

echo'

<div style="display:flex;flex-wrap:wrap;">

<form action="#"  method="POST"  style="width:100%;height:auto" >
hidden files section?
<select name="hidefiles">
<option value=""  >show</option>
<option value="#nav_upload{display:none;}" >hide</option>

</select>
<br>
<br>
<form action="#"   method="POST" style="width:100%;height:auto" >
hidden themes section?
<select name="hidethemes">
<option value=" " >show</option>
<option value="#nav_theme{display:none;}" >hide</option>

</select>
<br>
<br>
hidden backup section?
<select name="hidebackup">
<option value=" " >show</option>
<option value="#nav_backups{display:none;}" >hide</option>

</select>
<br>
<br>

hidden plugin section?
<select name="hideplugin">
<option value="" >show</option>
<option value="#nav_plugins{display:none;}" >hide</option>

</select>
<br>
<input type="submit" name="submit" style="margin:10px;padding:5px;" value="save plugin settings" />
<br>
</form>

</div>

';
 	    

if(isset($_POST['submit'])){
            $hidefiles = $_POST['hidefiles'];
            $hidebackup = $_POST['hidebackup'];
            $hidethemes = $_POST['hidethemes'];
            $hideplugin = $_POST['hideplugin'];
            file_put_contents($hidethemesfile , $hidethemes);
            file_put_contents($hidepluginfile , $hideplugin);
            file_put_contents($hidebackupfile , $hidebackup);
            file_put_contents($hidefilesfile , $hidefiles);

            echo'ok now check another page!';
        };



      
      }	


?>