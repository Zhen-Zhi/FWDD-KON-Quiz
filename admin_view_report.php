<?php 
    include("conn.php");
    include("template/navigation_admin.php");

    //get data to make chart
    //user by gender
    $query = "SELECT COUNT(ID) AS No_User FROM user GROUP BY Gender";
    $result = mysqli_query($con, $query);
    $data_user1 = mysqli_fetch_assoc($result);
    $data_user2 = mysqli_fetch_assoc($result);

    // attempt of each weeks
    // $query2 = "SELECT COUNT(All_session_ID) FROM all_session INNER JOIN "
    $query_getMember = "SELECT CASE WHEN User_ID = 0 THEN 'guest' ELSE 'member' END AS userType,
                            MONTHNAME(Date) AS MonthName, 
                            COUNT(User_ID) AS No_User FROM all_session 
                            WHERE Date > CURDATE() - INTERVAL 6 MONTH AND User_ID <> 0 
                            GROUP BY userType, MonthName;";

    $query_getGuest = "SELECT CASE WHEN User_ID = 0 THEN 'guest' ELSE 'member' END AS userType,
                            MONTHNAME(Date) AS MonthName, 
                            COUNT(User_ID) AS No_User FROM all_session 
                            WHERE Date > CURDATE() - INTERVAL 6 MONTH AND User_ID = 0 
                            GROUP BY userType, MonthName;";

    $query_getMonthName = "SELECT MONTHNAME(Date) AS MonthName FROM all_session 
                                WHERE Date > CURDATE() - INTERVAL 6 MONTH 
                                GROUP BY MonthName;";

    $result_member = mysqli_query($con, $query_getMember);
    $result_guest = mysqli_query($con, $query_getGuest);
    $result_monthName = mysqli_query($con, $query_getMonthName);
    $num_row = mysqli_num_rows($result_monthName); echo '<script>console.log('. $num_row .')</script>';
?>

<head>
    <title>KON Quiz - AdminHomepage</title>
</head>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<div class="container p-3 shadow">
    <div class="container m-2">
        <canvas id="myChart" style="width:70%"></canvas>
    </div>
    <div class="container m-2">
        <canvas id="myChart2" style="width:70%"></canvas>
    </div>
</div>

<script>
var xValues = ["TotalMembers", "Male Members", "Female Members"];
var yValues = [<?php echo json_encode($data_user1['No_User'] + $data_user2['No_User'])?>, <?php echo json_encode($data_user1['No_User'])?>, <?php echo json_encode($data_user2['No_User'])?>];
console.log("after assign" + yValues[0]);
var barColors = ['#1300bd', '#6bbfff', '#ee6bff'];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "KON-Quiz Member",
    },
    scales: {
      yAxes: [{ticks: {min: 0, max:<?php echo json_encode($data_user1['No_User'] + $data_user2['No_User'])?>}}],
    }
  }
});

console.log("above");

//make month data
var size = <?php echo $num_row = mysqli_num_rows($result_monthName);?>;
var arr_month = new Array(size);
var i = 0;
<?php while($row = mysqli_fetch_array($result_monthName)) { ?>
    arr_month[i] = "<?php echo $row['MonthName']?>";
    i++;
<?php }?>

//make member data
var size = <?php echo $num_row = mysqli_num_rows($result_member);?>;
var arr_member = new Array(size);
var i = 0;
<?php while($row = mysqli_fetch_array($result_member)) { ?>
    arr_member[i] = "<?php echo $row['No_User']?>";
    i++;
<?php }?>

//make member data
var size = <?php echo $num_row = mysqli_num_rows($result_guest);?>;
var arr_guest = new Array(size);
var i = 0;
<?php while($row = mysqli_fetch_array($result_guest)) { ?>
    arr_guest[i] = "<?php echo $row['No_User']?>";
    i++;
<?php }?>

const xValuesMonth = arr_month;
new Chart("myChart2", {
  type: "line",
  data: {
    labels: xValuesMonth,
    datasets: [{ 
      data: arr_member,
      borderColor: "red",
      fill: false
    }, { 
      data: arr_guest,
      borderColor: "green",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});
</script>

<style>
</style>