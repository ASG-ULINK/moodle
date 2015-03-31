<?PHP
require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/repository/lib.php");
require_once("$CFG->libdir/completionlib.php");

global $DB, $USER;


if (isset($_SESSION['report_query'])) 
{
$date_flag = 0;

// $reporting_records = $DB->get_records_sql("SELECT * FROM {lead_table} WHERE score = '".$score."'");

// $reporting_records = $DB->get_records_sql("SELECT * FROM {lead_table} WHERE id = '".$player."'");

$reporting_records = $_SESSION['report_query'];


$data="<table border='1'>";
$data.="<tr>";
    $data.="<td style='font-size:18px; text-align:center; font-weight:bold; background-color:#CCCCCC; color:#000000;' colspan='6'>Leaderboard Report</td>";
    $data.="</tr>";
    $data.="<tr>";
    $data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Sr.No.</b> </td>";
    $data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Name</b> </td>";
    $data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Score</b> </td>";
	$data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Description</b> </td>";
	$data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Modified Time</b> </td>";
	$data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Created Time</b> </td>";
	

    $data.="</tr>";

            $i=1;
            foreach($reporting_records as $reporting_record)
             {               
              $data.= "<tr>";
              $data.="<td>" . $i++ . "</td>";
               $data.="<td>" . $reporting_record->name . "</td>";             
               $data.="<td>" . $reporting_record->score . "</td>";
			   $data.="<td>" . $reporting_record->description . "</td>";             
			   $data.="<td>" . $reporting_record->timemodified . "</td>";
			   $data.="<td>" . $reporting_record->timecreated . "</td>";  
			        
			   $data.= "</tr>";
				   } //// foreach loop END
$data.="</table>";
$handler=fopen("file/Leaderboard_Player.xls",'w');
    fwrite($handler,$data);
    fclose($handler);
    header("Location: file/Leaderboard_Player.xls");
}
?>