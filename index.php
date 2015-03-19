<!DOCTYPE html>



<html lang="en">
<title> SmartFurnace </title>

<head>
	<meta charset="UTF-8">
	<meta name="description" content="SmartFurnace Web">
	<meta name="keywords" content="HTML,JavaScript, Smart, Technology, Hackaton, HUB387">
	<meta name="author" content="SmartFurniture">
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <script src="text/javascript" src="main.js"></script>
    <link rel="stylesheet" href="styles.css">
        

</head>

<body background="back4.jpg" >	

<h1><center>SMART SARAJEVO 2020</center></h1>

<center><table border="1" align="center" width="80%" cellspace="5" align="center" color="#000000">
	<col width="40%">
	<col width="30%">
<tr>
	<td><p>Room Temperature:
<?php $url="http://192.168.1.125";
$json=file_get_contents($url);
$data=json_decode($json,true);
$roomtemperature=intval($data['roomTemperature']);
echo $roomtemperature; echo "°C";
?></p></td>
	<td rowspan="3"><a href="http://www.accuweather.com/en/ba/sarajevo/33028/weather-forecast/33028" class="aw-widget-legal">
</a><div id="awcc1426590616866" class="aw-widget-current"  data-locationkey="" data-unit="c" data-language="en-us" data-useip="true" data-uid="awcc1426590616866"></div><script type="text/javascript" src="http://oap.accuweather.com/launch.js"></script>
    </td> 
</tr>
<tr>
	<td><p><font color="1FBED6">
<?php
if ($roomtemperature <=15) echo "Your house is cold, light a fire!";
if ($roomtemperature <21 and $roomtemperature>15 )  echo "Your house is cool, warm it up more!";
if ($roomtemperature <26 and $roomtemperature>21 ) echo "Your house temperature is perfect!";
if ($roomtemperature <30 and $roomtemperature>26 )  echo "Your house is very warm, slow down with the logs!";
if ($roomtemperature >=30)  echo "Your house is extremely warm, stop adding logs!";
?>
</p></font>

</td>
</tr>

<tr>
	<td><p> Furnace Temperature:
	<?php $url="http://192.168.1.125";
$json=file_get_contents($url);
$data=json_decode($json,true);
$furnacetemperature=intval($data['furnaceTemperature']);
echo $furnacetemperature; echo "°C";
?> </p></td>
</tr>

<tr>


<td rowspan="2"> <center><p>TIP!</center>
	<p><font color="FFFFFF" size="4px";>
<?php

$n=rand(1, 8);
switch ($n) {

    case 1:
        echo "The wood is utilised in the best way when the draught control is fully open and the flames are intense. That will also reduce pollution, because gas particles are combusted and produce heat instead. Once your home is warm, the temperature is regulated by the amount of wood, not the air control.";
        break;
    case 2:
        echo "You want a minimal amount of smoke coming from your chimney. Smoke is not exhaust – it contains high energy gases that were not burned. That's why it is a good idea to go outside and take a look at the smoke from the chimney. Dense, black smoke is a sign that the combustion is not optimal, usually because the fire in the wood stove is not intense enough. When the wood stove burns optimally, only a bit of steam and some light, odour-free smoke escapes from the chimney.";
        break;
    case 3:
        echo "Remove soot from your wood stove and the flue pipe once a year. That way, your wood stove will get warmer. A soot layer of even a few millimeters reduces the effect because the heat is not conducted so well, but will go up and out the chimney. Clean it more often if you burn a lot of pine wood which leaves more soot than other types of wood.";
        break;
 	case 4:
        echo "Hardwoods provide more heat than softwoods with the same volume, but per kilogram, the different wood types will give off the same heat, and softwoods are often cheaper to buy. Softwoods are the perfect firewood at the start and end of the winter when it is less cold. They provide a cleaner burn without making the house into a sauna. It will burn quicker, but it can be extended by burning with a hardwood log.";
        break;
    case 5:
        echo "Very few wood stoves can burn longer than two to three hours on one wood load. The old way of closing the air supply so that the coals will smoulder overnight is a source of pollution and creates the risk of a chimney fire. In addition, the heat benefit is poor as the gases are not combusted and the energy is not utilised. The last wood load in the evening should be some bigger hardwood logs that burn as normal with the air vents open. Even if the fire dies out, the insulation in the house will keep the heat in. The stove and chimney will still be warm in the morning and it is no problem to get the fire going again.";
        break;
    case 6:
        echo "Many of the modern wood stoves were designed to burn from the top down. Take a look at the user manual or get a new one from the Internet if you burned it. Lighting from the top down is done by stacking logs of wood quite tight and then lighting a small fire on top of the wood so that the fire burns downward. The wood stove will reach its operating temperature quicker, the gases will burn better and the wood load will last longer.";
        break;
     case 7:
     	echo  "Turbulence is important when lighting the fire because when the temperature is low, the oxygen does not mix with the molecules in the wood. Swirls of air bombard the smoke gases with oxygen and makes the lighting easier. This is the reason why the firewood catches fire more easily when the door to the wood stove is left ajar. Some houses are so sealed with insulation that you should open a window when lighting the fire. A blow pipe is also an excellent aid to get the fire going, much more so than bellows."; 
      break;
     case 8:
     echo "You should always put two or three logs on the fire at a time – one log on its own will often die out. The reason is that the burning of a log happens in three stages, and one single log is not able to keep its own process going. More logs have a bigger surface, creates more turbulence and keeps the burning process going.";
     break;
      }

?>
</p></td></font>
	<td rowspan="2"><p><font color="FFFF00">
<?php
$city="Sarajevo";
$country="BA";
$url="http://api.openweathermap.org/data/2.5/weather?q=".$city.",".$country."&units=metric&cnt=7&lang=en";
$json=file_get_contents($url);
$data=json_decode($json,true);
$temp=$data['main']['temp'];
if ($temp <=10) echo "It is very freezing day outside.";
if ($temp <=17 and $temp>10 )  echo "It is a bit chilly outside.";
if ($temp <=22 and $temp>17 ) echo "It is a cool day but you should consider dressing warm clothes rather than lightning a fire";
if ($temp <30 and $temp>22 )  echo "The outside temperature is perfect. You should go outside and enjoy in charms of nature";
if ($temp >=30)  echo "It is very warm day outside. If you can't stand high temperatures consider staying at home with cup of cold beverage";
?>	

</font></p></td>	</tr>
<tr>

</td>
</tr><tbody>
</table></center>







</body></html>
