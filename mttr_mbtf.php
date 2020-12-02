<?php
	session_start();

	if (!isset($_SESSION["username"]))
	{
		header("Location: index.php");
		return;
	}

	include 'functions.php';
	use Register\Database;
  $db = new Database();
	$userkey = $_SESSION["userkey"];

	if(!GetPageAccess($userkey,24))
	{
		header("Location: index.php");
		return;
	}
?>
<!-- mbtf second data manipulation -->
<?php
if(isset($_POST['str_date'])){
	// mbtf array
	$_mbtf = Array();
	// input start
	$_str_date = ReverseDate($_POST['str_date']) . " 08:00:00";
	// datetime variable
	$_start    	= new DateTime($_str_date);
	// set start
	$_start->modify('first day of this month');
	// input end
	$_end_date = ReverseDate($_POST['end_date']) . " 20:00:00";
	// datetime variable
	$_end    		= new DateTime($_end_date);
	// set end
	$_end->modify('first day of this month');
	// interval between calculation
	$_interval = DateInterval::createFromDateString('1 month');
	// calculation
	$_period   = new DatePeriod($_start, $_interval, $_end);
	// data manipulation
	foreach ($_period as $_month) {
		// calculate days in the current month
		$_last_day = cal_days_in_month (1, $_month->format("m"), $_month->format("Y"));
		// keys for reports
		$_key_start = $_month->format("Y-m-d") . "08:00:00";
		$_key_end		= $_month->format("Y-m-") . $_last_day. " 20:00:00";
		// array mbtf key
		$_key_mbtf_array = strval($_month->format("Y-m"));
		// report for mainth
		$_report_array_normal = makeOrderStates($_key_start, $_key_end, 4);
		// cycle mointh report
		foreach($_report_array_normal as $_matchine => $_array){
			$_total 		= calcDuration2($_key_start, $_key_end);
			$_gray			= $_total - $_array["orange"] - $_array["green"] - $_array["red"] - $_array["blue"];
			if($_gray < 0){
				$_gray = 0;
			}
			if(!isset($_mbtf[$_key_mbtf_array])){
				$_mbtf[$_key_mbtf_array] = round(($_total - $_gray - $_array["blue"] - $_array["orange_plan"]) / 60, 0);
			}else{
				$_mbtf[$_key_mbtf_array] += round(($_total - $_gray - $_array["blue"] - $_array["orange_plan"]) / 60, 0);
			}
		}
		// report for printing
		$_report_array_print  = makeOrderStatesPrint($_key_start, $_key_end, 3);
		// cycle printing report
		foreach($_report_array_print as $_matchine => $_array){
			if(!isset($_mbtf[$_key_mbtf_array])){
				$_mbtf[$_key_mbtf_array] = round(($_array["total"][0] - $_array["gray"][0] - $_array["orange_plan"]) / 60, 0);
			}else{
				$_mbtf[$_key_mbtf_array] += round(($_array["total"][0] - $_array["gray"][0] - $_array["orange_plan"]) / 60, 0);
			}
		}
	}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<title>Скала на променливи MTTR и MBTF</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
<!-- including additional data table plugin for data usage and export -->
<script src="js/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>

<script type="text/javascript">
// dates in the form
window.onload = function (){
  str_date = new Epoch('str_date','popup',document.getElementById('str_date'));
  end_date = new Epoch('end_date','popup',document.getElementById('end_date'));
};
// submitting post data
function select_period(){
  var str_date = document.getElementById('str_date');
  var end_date = document.getElementById('end_date');

  if (str_date.value == '' || end_date.value == '')
	{
		alert ('Непълна информация!');
		return;
	}
  document.calmenu.action = "bc-mttr-mbtf.php";
	document.forms['calmenu'].submit();
}
</script>

</head>

<body>
<div class="wrapper subpage">
    <div id="container">
        <div id="header">
            <table>
			<tr>

			<td valign="middle" style="border-bottom: 0px solid #222; padding: 0px 0px;">
				<?php
				echo "<h1><a href='#'>" . $_SESSION['largetitle'] . "</a></h1>";
				echo "<h2>" . $_SESSION['smalltitle'] . "</h2>";
				?>
			</td>

			<td align="right" valign="middle" style="border-bottom: 0px solid #222; padding: 0px 0px;">

			  <?php
				echo "<b>Потребител:</b> " . $_SESSION['names'] ."<br><br>";
			  ?>

			  <form action="index.php">
					<input class="formbutton" type="button" value="Смяна на парола" onclick="location.href='changepass.php';">
					<input class="formbutton" type="submit" value="Изход">
			  </form>
			</td>

			</tr>
			</table>

        </div>
        <div id="nav">
            <ul>
				<?php
				MakeMainMenu ($userkey, 24);
				?>
            </ul>
        </div>
      </div>
		<?php
		if(isset($_POST['str_date'])){
			echo "<div id='page-intro-small'><h2>Скала на променливи MTTR и MBTF&nbsp&nbsp | От: " . date('d/m/Y', strtotime($_POST['str_date'])) . "&nbsp&nbsp | До: " . date('d/m/Y', strtotime($_POST['end_date'])) . "</b></p></div>";
		}else{
			echo "<div id='page-intro-small'><h2>Скала на променливи MTTR и MBTF&nbsp&nbsp </b></p></div>";
		}

		?>

        <div id="body" style="margin-left: 35%;">
				<div class="sidebarwide" style="margin-top: 5%;">
						<ul>
								<form method="post" class="searchform" action="bc-mttr-mbtf.php" name="calmenu" id="calmenu">
									         <li>
							<h4>Селекция на период</h4>
									     <ul>
								         <li>
                            <!-- start date -->
                            <?php echo "Период-начало:";?>
                            <p>
  				                        <input id='str_date' name='str_date' type='text' readonly>
  													</p>
                            <!-- end date -->
                            <?php echo "Период-край:";?>
                            <p>
                                  <input id='end_date' name='end_date' type='text' readonly>
                            </p>
                          <li>
                      </ul>
                      <ul class="blocklist">
                          <li><a href='#' onclick='select_period();'>Задай</a></li>
                          <li><a href='repairs.php'>Отказ</a></li>
													<?php if(isset($_POST['str_date']) and isset($_POST['end_date'])): ?>
													<li><a id="download"
												        download="ChartImage.jpg"
												        href=""
												        class="btn btn-primary float-right bg-flat-color-1"
												        title="Descargar Gráfico">

												        <!-- Download Icon -->
												 				<i class="fa fa-download"></i> Изтегляне на графиката
 										 			</a></li> <?php endif; ?>
													<!-- breakdowns 4 and the last value MTTR -->
                      </ul>
                </form>
              </ul>
              <div class="sidebarwide-end"></div>
        </div>
      </div>
      <div class="topbar" style="margin-bottom: 2%; margin-top: 2%; margin-left: 5%; width: 60%;">
        <canvas id="chart"></canvas>
        <?php
          if(isset($_POST['str_date']) and isset($_POST['end_date'])){
            echo "<pre>";
            // days between inputs
            $diff = strtotime($_POST['end_date']) - strtotime($_POST['str_date']);
            $diff = ($diff/3600/24)/($diff/3600/24/30);
            // array helpers
            $mttr         = Array();
            $mbtf         = Array();
            $mach_op_time = Array();
            // statement for operational time
            $sql 			= "SELECT Id, OperationalTime FROM sup_equ_type
						-- WHERE Id = 'MSP'OR Id ='PTO' OR Id = 'PTM'";
            // prepare
  					$sth = $db->getDbh()->prepare($sql);
  					// execute
  					$sth->execute();
            // fetch
            while($row = $sth->fetch(PDO::FETCH_ASSOC))
            {
              // getting variables
              $tip        = $row['Id'];
              $op_time    = $row['OperationalTime'];
							// matchines that do not appear in the calculations for the variables
							if($op_time == 0){
								$mach_op_time[$tip] = 0;
							}
              // building array
              $mach_op_time[$tip] = $op_time * $diff;
            }
            // statement
  					$sql 			= "SELECT sup2_time_ticket.StartDate, sup2_time_ticket.StartHour,
                                sup2_time_ticket.EndDate,   sup2_time_ticket.EndHour,
                                sup2_time_ticket.TaskId,    sup_equ.Tip
            FROM sup2_task
            JOIN sup2_time_ticket ON sup2_task.Id = sup2_time_ticket.TaskId
            JOIN sup_equ ON sup2_task.EqId = sup_equ.Id
            WHERE sup2_task.Completed = 1 AND sup2_task.RepairType = 'AR'
            AND (sup2_time_ticket.StartDate > :str_date AND sup2_time_ticket.EndDate < :end_date)";
  					// prepare
  					$sth = $db->getDbh()->prepare($sql);
  					// execute
  					$sth->execute(array(
  										'str_date'				=> date('Y-m-d H:s:i', strtotime($_POST['str_date'])),
                      'end_date'        => date('Y-m-d H:s:i', strtotime($_POST['end_date'])),
  					));
            // fetching data
            while($row = $sth->fetch(PDO::FETCH_ASSOC))
            {
              // getting variables
              $tip              = $row['Tip'];
              $task_id          = $row['TaskId'];
              $str_date         = $row['StartDate'];
              $str_hour         = $row['StartHour'];
              $end_date         = $row['EndDate'];
              $end_hour         = $row['EndHour'];
              // period determination
              $str_date_time    = $str_date ." ". $str_hour;
              $end_date_time    = $end_date ." ". $end_hour;
              // difference calculation
              $diff             = strtotime($end_date_time) - strtotime($str_date_time);
              // key separation
              $split            = explode('-', $str_date);
              // key determination
              $key              = $split[0] ."-". $split[1];
							// skip all matchines that do not appear in the calculations
							if($mach_op_time[$tip] == 0){
								continue;
							}
              // building array MTTR
              if(!isset($mttr[$key])){
                $mttr[$key]         = $diff/3600;
                $period[$key]       = 1;
              }else{
                $mttr[$key]         += $diff/3600;
                $period[$key]       ++;
              }
              // building array MBTF
              if(isset($mach_op_time[$tip])){
								$mbtf[$key]	+= $mach_op_time[$tip] - $diff/3600;
              }
            }
            // recalculating in percentages
            foreach ($period as $key => $value) {
              $mttr[$key] = strval($mttr[$key]/$value);
							$mbtf[$key] = strval(($mbtf[$key] + $_mbtf[$key])/$value/100);
            }
						// sorting by keys
						ksort($mttr);
						ksort($mbtf);
            // taking the keys from the array
            $period = array_keys($mttr);
            // replacing associative keys with numeric
            $mttr   = array_values($mttr);
            $mbtf   = array_values($mbtf);
            echo "</pre>";
          }
        ?>
      </div>
</div>
<script>
// take post variable
var empty_post = <?php echo json_encode($_POST['str_date']);?>;
// check if post is available
if(empty_post){
  // taking output variables
  var mttr      = <?php echo json_encode($mttr);?>;
  var mbtf      = <?php echo json_encode($mbtf);?>;
  var period    = <?php echo json_encode($period);?>;
  // set logs
  console.log(mttr);
  console.log(mbtf);
  console.log(period);
  // set canvas bar graph
  var canvas = document.getElementById('chart').getContext('2d');
  new Chart(canvas, {
    type: 'bar',
    data: {
      labels: period,         // keys
      datasets: [{
        label: 'MTTR',
        data: mttr,           // mttr variables
				backgroundColor: "rgba(102, 204, 255, 0.7)",
	      borderColor: "rgba(0, 0, 255, 0.4)",
        borderWidth: 1
      }, {
				label: 'MBTF',
        data: mbtf,           // mbtf variables
				backgroundColor: "rgba(255, 153, 153, 0.7)",
	      borderColor: "rgba(255, 0, 0, 0.4)",
        borderWidth: 1
			}]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
  // end if
}
//Download Chart Image
document.getElementById("download").addEventListener('click', function(){
  /*Get image of canvas element*/
  var url_base64jp = document.getElementById("chart").toDataURL("image/jpg");
  /*get download button (tag: <a></a>) */
  var a =  document.getElementById("download");
  /*insert chart image url to download button (tag: <a></a>) */
  a.href = url_base64jp;
});
</script>
</body>
