<?php


/**
 * @package Module Globegallery for Joomla! 5.x
 * @version $Id: mod_globegalllery.php 1.2.1 2024-07-21 23:26:33Z $
 * @author KWProductions Co.
 * @copyright (C) 2024- KWProductions Co.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of globegallery.
    globegallery is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    globegallery is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with globegallery.  If not, see <http://www.gnu.org/licenses/>. 
**/ 


defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Filesystem\Folder;

HTMLHelper::_("jquery.framework");

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('globestyle', Uri::Base().'modules/mod_globegallery/tmpl/globestyle.css');
$modId = 'mod-globegallery' . $module->id;
$canvaswidth = $params->get("canvaswidth");
$canvasheight = $params->get("canvasheight");
$imagewidth = $params->get("imagewidth");
$imageheight=$params->get("imageheight");
$pointnums = $params->get("points");
$imagenums= $params->get("imagenums");
$rotationspeed = $params->get("rotationspeed");
$resizetimeout = $params->get("resizetimeout");
$imagefolder =  	$params->get("imagefolder");
$cis = 	$params->get("cis");
$tcolor = 	$params->get("textcolor");
$bkcolor = 	$params->get("bkcolor");



if(Folder::exists(JPATH_ROOT.'\\images\\'.$imagefolder))
{
	$images = Folder::files(JPATH_ROOT.'\\images\\'.$imagefolder);
	
	if(sizeof($images)<$imagenums)
		$imagenums=sizeof($images);
	
	$arrimg = [];
    foreach($images as $image)
	{
		$arrimg [] = Uri::Base()."images/".$imagefolder."/".$image;
	
	}
	$images = $arrimg;
	
	
	$globecontent="
	
	var canvaswidth;
	canvaswidth =".$canvaswidth.";	
	//console.log(canvaswidth);
	var canvasheight;
	canvasheight =".$canvasheight.";	
	var imagewidth;
	imagewidth =".$imagewidth.";	
	var imageheight;
	imageheight =".$imageheight.";	
	var pointnums;
	pointnums =".$pointnums.";	
	var imagenums;
	imagenums =".$imagenums.";
	var resizetimeout;
	 resizetimeout = ".$resizetimeout.";
	 var rotationtimeout;
	 rotationspeed = ".$rotationspeed.";
	 var cis;
	 cis = ".$cis.";
	
	
	 var myimages ;
	 var images = [];
	 
	 myimages = ".json_encode($images).";
	 for(let i=0; i<myimages.length; i++)
	{
	  images[i]=myimages[i];
	  
	 }
	 
	";
	
	$wa->addInlineScript($globecontent);
//	$wa->registerAndUseScript('globescript', Uri::Base().'modules/mod_globegallery/tmpl/globescript.js');
    }
	else
		echo "<h1>Set your images folder first in the backend of your website!</h1>";

	?>
	<div id="scontainer">
	<canvas id="scene"></canvas>
	<form>
		<input type="button" class="btn" name="alpha" id="alpha" value="Stop The Globe" />

	</form>
	</div>
	<script type="text/javascript" src="<?php echo Uri::Base() ?>modules/mod_globegallery/tmpl/globescript.js"></script>

	    <script type="text/javascript">
		var counter;
		var raf;
		counter = 0;
		jQuery(document).ready(function(){
			for( ; counter<=images.length; counter++){
				if(counter<images.length)
				jQuery('<img src="'+images[counter]+'" id="image'+counter+'"  style="display:none;" />').appendTo('#scontainer')
					
                 if(counter==images.length){
                 createDots();
                 raf =  window.requestAnimationFrame(render);
                 }
			}
			jQuery('#alpha').css({color:"<?php echo $tcolor; ?>",backgroundColor:"<?php echo $bkcolor; ?>"});
			var counterb=2; //lea
			
			jQuery('#alpha').click(function(){
				if(counterb%2==0)
				{
					cancelAnimationFrame(raf);
					jQuery('#alpha').val("Start The Globe");
				}
				else
				{
					 raf = window.requestAnimationFrame(render);
					 jQuery('#alpha').val("Stop The Globe");


				}
				counterb++;
				
				
			});
		});
	
		</script>