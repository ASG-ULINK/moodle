<?php
require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/repository/lib.php");
$id = $_GET['id'];
global $DB;
$widget = $DB->get_record('block_addpartner', array('id'=>$id), '*');
?>
<html>
	<title>Widget</title>
	<head>
		<style>
			body{
				font-family:verdana;				
				color:<?php echo ($widget->widgetcolor == '#FFFFFF')?'#000000':'#FFFFFF'?>;			
			}
		</style>
<script type="text/javascript" src="<?php echo $CFG->wwwroot?>/theme/anomaly/javascript/jquery-1.8.0.min.js"></script>		
	</head>
	<body>		
		<table width="200">
			<tr>
				<td style="border:1px solid #000000;padding:5px;border-radius:5px;">
					<table >
						<tr>
							<td style="border:1px solid #d6d6d6;padding:5px;border-radius:5px;background:<?php echo $widget->widgetcolor?>">
								<table>
									<tr>
										<td align="center"><img src = "<?php echo $CFG->wwwroot;?>/my/addpartner/logo/<?php echo $widget->imagefile;?>" height="40"></td>
									</tr>
									<tr>
										<td style="font-weight:bold;font-size:13px;"><b>CLICK HERE to enroll in Drivefleet</b></td>
									</tr>
									<tr>
										<td align="right" style="font-size:13px;font-weight:bold;">by <img src="<?php echo $OUTPUT->pix_url('logo_widget', 'theme')?>"></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td></td></tr>
			<tr>
				<td>
					<fieldset style="padding:0px;margin:0px;border-radius:5px;"><legend><a href="javascript:void(0);" style="font-size:12px;font-weight:bold;color:#355435;text-decoration:none" onclick="$('#code').select();">Copy Code</a></legend>
						<table>
							<tr>
								<td>
									<textarea cols="21" rows="7" style="width:215px;border:0px;" id="code"><script language="javascript" type="text/javascript" src="<?php echo $CFG->wwwroot?>/my/addpartner/widget.php?id=<?php echo $widget->id?>"></script></textarea>
									</td>
							</tr>				
						</table>
					</fieldset>	
				</td>
			</tr>
		</table>
	</body>
</html>
		