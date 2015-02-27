<?php
$rtmp_server=$_COOKIE["rtmp_server"];
$rtmp_amf=$_COOKIE["rtmp_amf"];
if ($_COOKIE["username"]) $username=$_COOKIE["username"];
$loggedin=1;
if ($_COOKIE["usertype"]) $userType=$_COOKIE["usertype"];
if ($_COOKIE["userroom"]) $room=$_COOKIE["userroom"];
$userPicture=$_COOKIE["userpicture"];
$userLink=$_COOKIE["userlink"];
if ($userType==3) $admin=1; else $admin=0;

//replace bad words or expression
$filterRegex=$_COOKIE["filterregex"];
$filterReplace=$_COOKIE["filterreplace"];

//fill your layout code between <<<layoutEND and layoutEND;
$layoutCode=$_COOKIE["layoutcode"];


if (!$room) $room="Lobby";
$showCamSettings=$_COOKIE['showCamSettings'];
$advancedCamSettings=$_COOKIE['advancedCamSettings'];
$configureSource=$_COOKIE['configureSource'];
$disableVideo=$_COOKIE['disableVideo'];
$disableSound=$_COOKIE['disableSound'];
$room_create=$_COOKIE['room_create'];
$room_delete=$_COOKIE['room_delete'];
$panelfiles=$_COOKIE['panelfiles'];
$showtimer=$_COOKIE['showtimer'];
$file_upload=$_COOKIE['file_upload'];
$file_delete=$_COOKIE['file_delete'];
$camWidth=$_COOKIE['camWidth'];
$camHeight=$_COOKIE['camHeight'];
$camFPS=$_COOKIE['camFPS'];
$micRate=$_COOKIE['micRate'];
$camBandwidth=$_COOKIE['camBandwidth'];
$camMaxBandwidth=$_COOKIE['camMaxBandwidth'];
$bufferLive=$_COOKIE['bufferLive'];
$bufferFull=$_COOKIE['bufferFull'];
$bufferLivePlayback=$_COOKIE['bufferLivePlayback'];
$bufferFullPlayback=$_COOKIE['bufferFullPlayback'];
$disableBandwidthDetection=$_COOKIE['disableBandwidthDetection'];
$limitByBandwidth=$_COOKIE['limitByBandwidth'];

$welcome=$_COOKIE["welcome"];

?>server=<?=$rtmp_server?>
&serverAMF=<?=$rtmp_amf?>
&username=<?=urlencode($username)?>
&loggedin=<?=$loggedin?>
&userType=<?=$userType?>
&administrator=<?=$admin?>
&room=<?=urlencode($room)?>
&welcome=<?=urlencode($welcome)?>
&userPicture=<?=$userPicture?>
&userLink=<?=$userLink?>
&webserver=
&msg=<?=urlencode($msg)?>
&tutorial=<?=$_COOKIE["tutorial"]?>
&room_delete=<?=$room_delete?>
&room_create=<?=$room_create?>
&panelFiles=<?=$panelfiles?>
&showTimer=<?=$showtimer?>
&showCredit=1
&disconnectOnTimeout=0
&disableUploadDetection=<?=$_COOKIE["disableUploadDetection"]?>
&background_url=<?=$_COOKIE["background_url"]?>
&autoViewCams=<?=$_COOKIE["autoviewcams"]?>
&layoutCode=<?=urlencode($layoutCode)?>
&filterRegex=<?=$filterRegex?>
&filterReplace=<?=$filterReplace?>
&loadstatus=1
&fillWindow=<?=$fillWindow?>
&showCamSettings=<?=$showCamSettings?>
&advancedCamSettings=<?=$advancedCamSettings?>
&configureSource=<?=$configureSource?>
&disableVideo=<?=$disableVideo?>
&disableSound=<?=$disableSound?>
&file_upload=<?=$file_upload?>
&file_delete=<?=$file_delete?>
&camWidth=<?=$camWidth?>
&camHeight=<?=$camHeight?>
&camFPS=<?=$camFPS?>
&micRate=<?=$micRate?>
&camBandwidth=<?=$camBandwidth?>
&camMaxBandwidth=<?=$camMaxBandwidth?>
&bufferLive=<?=$bufferLive?>
&bufferFull=<?=$bufferFull?>
&bufferLivePlayback=<?=$bufferLivePlayback?>
&bufferFullPlayback=<?=$bufferFullPlayback?>
&disableBandwidthDetection=<?=$disableBandwidthDetection?>
&limitByBandwidth=<?=$limitByBandwidth?>