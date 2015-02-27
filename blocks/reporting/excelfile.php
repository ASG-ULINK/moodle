<?PHP

require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/repository/lib.php");
require_once("$CFG->libdir/completionlib.php");
global $DB, $USER;

if (isset($_SESSION['report_query'])) 
{
  $date_flag = 0;
  $ip = $_SESSION['report_query'];
  
$reporting_records = $DB->get_recordset_sql($ip);

$data="<table border='1'>";
$data.="<tr>";
    $data.="<td style='font-size:14px; text-align:center; font-weight:bold; background-color:#CCCCCC; color:#000000;' colspan='8'>Course Completed Report</td>";
    
    $data.="</tr>";
    $data.="<tr>";
    $data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Sr.No.</b> </td>";
    $data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>First Name</b> </td>";
    $data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Last Name</b> </td>";
    $data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Email ID</b> </td>";
    $data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Course</b> </td>";
    $data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Completion Status</b> </td>";
    $data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Completion Date</b> </td>";
    $data.="<td style='background-color:rgb(75,172,198); font-size:14px'><b>Qualification</b> </td>";
    $data.="</tr>";

$i=1;
foreach($reporting_records as $reporting_record)
          {               
              $data.= "<tr>";
              $data.="<td>" . $i++ . "</td>";
                $data.="<td>" . $reporting_record->firstname . "</td>";             
                $data.="<td>" . $reporting_record->lastname . "</td>";              //Cohort ID
                $data.="<td>" . $reporting_record->emailid . "</td>";                //Cohort Size
                $data.="<td>" . $reporting_record->coursename . "</td>";

                     $course = new stdClass();
                     $course->id = $reporting_record->courseid;
                     
                     $cinfo = new completion_info($course);
                     $is_complete = $cinfo->is_course_complete($reporting_record->userid);
                     
                     if($is_complete == true){
                $data.="<td>" . "Complete". "</td>";
                }
                else{
                  $data.="<td>" . "In Progress". "</td>";
                }
              
               if(!empty($reporting_record->timecompleted)){
                $newformat = date('d-M-Y',$reporting_record->timecompleted);
                $data.="<td>" .$newformat. "</td>";
                }
                else{
                  $data.="<td>" . "". "</td>";
                }
                          
                $data.="<td>" . "" . "</td>";

              $data.= "</tr>";

          } //// foreach loop END

$data.="</table>";

$handler=fopen("file/Course_Copletion_Report.xls",'w');
    fwrite($handler,$data);
    fclose($handler);
    header("Location: file/Course_Copletion_Report.xls");
}


?>