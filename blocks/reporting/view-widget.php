<?php
require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/repository/lib.php");
$id = $_GET['id'];
global $DB;
$widget = $DB->get_record_sql("select bc.*,c.id as id, c.* from {block_reporting} as bc join {reporting} as c on c.id=bc.reportingid where bc.id = ".$id);
$widget->widgetcolor = "#fff";
//echo '<pre>widget: ' . print_r($widget, true) . '</pre><br />';
 $reportingDetails = $DB->get_record_sql('SELECT * FROM {files} WHERE itemid = ' . $widget->imagefile . ' AND license IS NOT NULL');     

		               $fs = get_file_storage();
 
						// Prepare file record object
						$fileinfo = array(
						    'component' => 'user',     // usually = table name
						    'filearea' => 'draft',     // usually = table name
							'itemname' => $widget->fullname,
						    'itemid' => $widget->imagefile,               // usually = ID of row in table
						    'contextid' => $reportingDetails->contextid, // ID of context
						    'filepath' => '/',           // any path beginning and ending in /
						    'filename' => $reportingDetails->filename); // any filename
						 
						// Get file
						$file = $fs->get_file($fileinfo['contextid'], $fileinfo['component'], $fileinfo['filearea'],
						                      $fileinfo['itemid'], $fileinfo['filepath'], $fileinfo['filename']);
						                      
						if ($file) {
    						$file->copy_content_to("$CFG->dirroot/blocks/reporting/logo/");
    						$reportingimage = $CFG->wwwroot . "/draftfile.php/$reportingDetails->contextid/user/draft/$widget->imagefile/$reportingDetails->filename";
						} 

?>
<html>
	<title>Widget</title>
	<head>
		<style>
			body{
				font-family:verdana;				
				color: #FFFFFF;			
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
										<td align="center"><img src = "<?php echo $reportingimage ;?>" height="40"></td>
									</tr>
									<tr>
										<td style="font-weight:bold;font-size:13px; color:#000;"><b>CLICK HERE to enroll in <?php echo $widget->fullname; ?> </b></td>
									</tr>
									<tr>
										<td align="right" style="font-size:13px;font-weight:bold;">by <img src="<?php echo $CFG->wwwroot?>/theme/ergo/layout/Q-Ed-logo.png"></td>
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
									<textarea cols="21" rows="7" style="width:215px;border:0px;" id="code"><script language="javascript" type="text/javascript" src="<?php echo $CFG->wwwroot?>/local/reporting/reportingcatalog.php?id=<?php echo $widget->id?>"></script></textarea>
									</td>
							</tr>				
						</table>
					</fieldset>	
				</td>
			</tr>
		</table>
	</body>
</html>
		