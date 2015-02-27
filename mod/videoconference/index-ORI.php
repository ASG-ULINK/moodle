<?php
include("header.php");

$newroom=$_GET['newroom'];

if (!$newroom)
{
if ($_GET['r']) $room=$_GET['r'];
if ($_POST['r']) $room=$_POST['r'];

if ($room=="Private") $room=$room."_".base_convert((time()-1258100000).rand(0,10),10,36)

?><br />
<form id="form1" name="form1" method="post" action="videowhisper_conference.php">
  <p><b>Enter Video Conference</b><br />
    Username
  <input name="username" type="text" id="username" value="Guest" size="12" maxlength="12" />
    
    <input type="submit" name="button" id="button" value="Enter Chat" />
    
    <br />
    <br />
    
    User Type 
    <select name="usertype" id="usertype">
      <option value="0" selected="selected">Regular</option>
      <option value="1">Male</option>
      <option value="2">Female</option>
      <option value="3">Administrator</option>
    </select>
    <br />
    <input name="room" type="hidden" id="room" value="<?=$room?>" /> 
    <?php
    if ($room) 
	{
		$roomlink="http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?r=".urlencode($room);
		echo "Private room: <B>$room</B>. Private room link: <a href='$roomlink'>$roomlink</a>";
	}
	?>
  </p>
  <p><a href="index.php?newroom=1"> Create Private Room<br />
  </a></p>
</form>
<div class="info">
  <p><b>Suggestions</b></p>
  <p>For  best experience with this application we recommend updating to latest flash player: <a href="http://get.adobe.com/flashplayer/" target="_blank">http://get.adobe.com/flashplayer/</a> . <br />
    <br />
    When the application starts, flash will ask you if you want to start streaming your camera and microphone. Allow flash to send your stream and then select the right video and audio devices you want to use. </p>
  <p>There are 2 ways to select hardware devices/drivers you'll use for broadcasting:<br />
    A. Click inside webcam preview panel and a settings panel will extend it. Click camera or microphone to select.<br />
  B. Right click Flash &gt; Settings... and browse to the webcam/microphone minitabs.</p>
</div>
<?php
}
else
{
	?>
    <form id="form2" name="form2" method="post" action="index.php">
      <p><b>Create Private Room</b>
        <br />
        Room Name
        <input name="r" type="text" id="r" value="Private" size="12" maxlength="12" />
        <input type="submit" name="button" id="button" value="Create" />
      </p>
</form>
	<?php
}
?>