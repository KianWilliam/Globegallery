<?php
/**
 * @package Module Loglobe for Joomla! 5.x
 * @version $Id: mod_loglobe.php 1.2.1 2024-07-21 23:26:33Z $
 * @author KWProductions Co.
 * @copyright (C) 2024- KWProductions Co.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of loglobe.
    loglobe is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    loglobe is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with loglobe.  If not, see <http://www.gnu.org/licenses/>. 
**/ 

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Filesystem\Folder;

//HTMLHelper::_("jquery.framework");

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
//$wa->registerAndUseStyle('globestyle', Uri::Base().'modules/mod_globegallery/tmpl/globestyle.css');
$modId = 'mod-loglobe' . $module->id;
$swidth = $params->get("spherewidth");
$sheight = $params->get("sphereheight");
$perspective = $params->get("perspective");
$transitiontype= $params->get("transitiontype");
$rotationtime = $params->get("rotationtime");
$bordercolor = $params->get("bordercolor");
$imagefolder =  	$params->get("imagefolder");
$bordersize = 	$params->get("bordersize");
$buttbkcol = 	$params->get("buttonbkcolor");
$butttxtcol = 	$params->get("buttontxtcolor");



if(Folder::exists(JPATH_ROOT.'\\images\\'.$imagefolder))
{
	$images = Folder::files(JPATH_ROOT.'\\images\\'.$imagefolder);
	
	$arrimg = [];
    foreach($images as $image)
	{
		$arrimg [] = Uri::Base()."images/".$imagefolder."/".$image;
	
	}
	$images = $arrimg;
	
	
	$globecontent="
	
	var swidth;
	swidth =".$swidth.";	
	//console.log(canvaswidth);
	var sheight;
	sheight =".$sheight.";	
	var perspective;
	perspective =".$perspective.";	
	var transitiontype;
	transitiontype =".$transitiontype.";	
	var rotationtime;
	rotationtime =".$rotationtime.";	
	var bordercolor;
	bordercolor =".$bordercolor.";
	var bordersize;
	 bordersize = ".$bordersize.";
	 
	
	 var myimages ;
	 var images = [];
	 
	 myimages = ".json_encode($images).";
	 for(let i=0; i<myimages.length; i++)
	{
	  images[i]=myimages[i];
	  
	 }
	 
	";
	
//	$wa->addInlineScript($globecontent);
//	$wa->registerAndUseScript('globescript', Uri::Base().'modules/mod_globegallery/tmpl/globescript.js');
    }
	else
		echo "<h1>Set your images folder first in the backend of your website!</h1>";

	?>
<div id="loglobecontainer">	
<style type="text/css">
#scene {
  perspective: <?php echo $perspective; ?>px;
  transform-style: preserve-3d;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  transition: perspective 1s <?php echo $transition; ?>;
  pointer-events: none;
  z-index: 0;
}
#scene * {
  transform-style: preserve-3d;
  position: absolute;
}

#sphere {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  animation: rotate-around 40s linear infinite;
}
@keyframes rotate-around {
  0% {
    transform: rotateX(-20deg) rotateY(0deg);
  }
  10% {
    transform: rotateX(-20deg) rotateY(36deg);
  }
  50% {
    transform: rotateX(-70deg) rotateY(180deg);
  }
  60% {
    transform: rotateX(-70deg) rotateY(216deg);
  }
  100% {
    transform: rotateX(-20deg) rotateY(360deg);
  }
}
#sphere .longitudes,
#sphere .latitudes {
  display: flex;
  justify-content: center;
  align-items: center;
}
#sphere .longitude,
#sphere .latitude {
  border-radius: 50%;
  border: 5px solid;
  aspect-ratio: 1/1;
}
#sphere .longitude {
  border-color: #0f0a;
  width: 400px;
}
#sphere .latitude {
  border-color: #0ffa;
}
#sphere .longitude:nth-child(1) {
  transform: rotateY(0deg);
}
#sphere .longitude:nth-child(2) {
  transform: rotateY(10deg);
}
#sphere .longitude:nth-child(3) {
  transform: rotateY(20deg);
}
#sphere .longitude:nth-child(4) {
  transform: rotateY(30deg);
}
#sphere .longitude:nth-child(5) {
  transform: rotateY(40deg);
}
#sphere .longitude:nth-child(6) {
  transform: rotateY(50deg);
}
#sphere .longitude:nth-child(7) {
  transform: rotateY(60deg);
}
#sphere .longitude:nth-child(8) {
  transform: rotateY(70deg);
}
#sphere .longitude:nth-child(9) {
  transform: rotateY(80deg);
}
#sphere .longitude:nth-child(10) {
  transform: rotateY(90deg);
}
#sphere .longitude:nth-child(11) {
  transform: rotateY(100deg);
}
#sphere .longitude:nth-child(12) {
  transform: rotateY(110deg);
}
#sphere .longitude:nth-child(13) {
  transform: rotateY(120deg);
}
#sphere .longitude:nth-child(14) {
  transform: rotateY(130deg);
}
#sphere .longitude:nth-child(15) {
  transform: rotateY(140deg);
}
#sphere .longitude:nth-child(16) {
  transform: rotateY(150deg);
}
#sphere .longitude:nth-child(17) {
  transform: rotateY(160deg);
}
#sphere .longitude:nth-child(18) {
  transform: rotateY(170deg);
}
#sphere .longitude:nth-child(19) {
  transform: rotateY(180deg);
}
#sphere .latitude:nth-child(1) {
  width: 0px;
  transform: translateY(-200px) rotateX(90deg);
}
#sphere .latitude:nth-child(2) {
  width: 69.4592710668px;
  transform: translateY(-196.9615506024px) rotateX(90deg);
}
#sphere .latitude:nth-child(3) {
  width: 136.8080573303px;
  transform: translateY(-187.9385241572px) rotateX(90deg);
}
#sphere .latitude:nth-child(4) {
  width: 200px;
  transform: translateY(-173.2050807569px) rotateX(90deg);
}
#sphere .latitude:nth-child(5) {
  width: 257.1150438746px;
  transform: translateY(-153.2088886238px) rotateX(90deg);
}
#sphere .latitude:nth-child(6) {
  width: 306.4177772476px;
  transform: translateY(-128.5575219373px) rotateX(90deg);
}
#sphere .latitude:nth-child(7) {
  width: 346.4101615138px;
  transform: translateY(-100px) rotateX(90deg);
}
#sphere .latitude:nth-child(8) {
  width: 375.8770483144px;
  transform: translateY(-68.4040286651px) rotateX(90deg);
}
#sphere .latitude:nth-child(9) {
  width: 393.9231012049px;
  transform: translateY(-34.7296355334px) rotateX(90deg);
}
#sphere .latitude:nth-child(10) {
  width: 400px;
  transform: translateY(0px) rotateX(90deg);
}
#sphere .latitude:nth-child(11) {
  width: 393.9231012049px;
  transform: translateY(34.7296355334px) rotateX(90deg);
}
#sphere .latitude:nth-child(12) {
  width: 375.8770483144px;
  transform: translateY(68.4040286651px) rotateX(90deg);
}
#sphere .latitude:nth-child(13) {
  width: 346.4101615138px;
  transform: translateY(100px) rotateX(90deg);
}
#sphere .latitude:nth-child(14) {
  width: 306.4177772476px;
  transform: translateY(128.5575219373px) rotateX(90deg);
}
#sphere .latitude:nth-child(15) {
  width: 257.1150438746px;
  transform: translateY(153.2088886238px) rotateX(90deg);
}
#sphere .latitude:nth-child(16) {
  width: 200px;
  transform: translateY(173.2050807569px) rotateX(90deg);
}
#sphere .latitude:nth-child(17) {
  width: 136.8080573303px;
  transform: translateY(187.9385241572px) rotateX(90deg);
}
#sphere .latitude:nth-child(18) {
  width: 69.4592710668px;
  transform: translateY(196.9615506024px) rotateX(90deg);
}
#sphere .latitude:nth-child(19) {
  width: 0px;
  transform: translateY(200px) rotateX(90deg);
}

label {
  position: fixed;
  margin: 15px;
  display: inline-block;
  background-color: #444;
  box-shadow: 0px 0px 10px #111a;
  padding: 8px 16px;
  border-radius: 4px;
  font-size: 18px;
  z-index: 10;
  opacity: 0.8;
}
label:hover {
  cursor: pointer;
  opacity: 1;
}

input {
  display: none;
}
/*hover better*/

input:checked ~ #scene {
  perspective: 150px;
}
input:not(:checked) ~ #scene {
  perspective: 500px;
}
</style>
<input type="checkbox" id="toggler">
<label for="toggler">
  Toggle perspective
</label>
<div id="scene">
  <div id="sphere">
    <div class="longitudes">
      <div class="longitude"></div>
      <div class="longitude"></div>
      <div class="longitude"></div>
      <div class="longitude"></div>
      <div class="longitude"></div>
      <div class="longitude"></div>
      <div class="longitude"></div>
      <div class="longitude"></div>
      <div class="longitude"></div>
      <div class="longitude"></div>
    </div>
	 </div>
</div>
	<form>
		<input type="button" class="btn" name="alpha" id="alpha" value="Stop The Globe" />

	</form>
</div>
	
	<script type="text/javascript" src="<?php echo Uri::Base() ?>modules/mod_loglobe/tmpl/loglobescript.js"></script>

	    <script type="text/javascript">
		
			jQuery('#alpha').css({color:"<?php echo $butttxtcol; ?>",backgroundColor:"<?php echo $buttbkcol; ?>"});
			var counter=2; //lea
			
			jQuery('#alpha').click(function(){
				if(counterb%2==0)
				{
					
					jQuery('#alpha').val("Start The Globe");
				}
				else
				{
					
					 jQuery('#alpha').val("Stop The Globe");


				}
				counter++;
				
				
			});
		});
	
		</script>