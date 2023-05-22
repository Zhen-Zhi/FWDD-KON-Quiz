<?php 
    include("../conn.php");
    include("../template/navigation_admin.php");

    //get data to make chart
    //user by gender
    $query = "SELECT COUNT(ID) AS No_User FROM user GROUP BY Gender";
    $result = mysqli_query($con, $query);
    $data_user1 = mysqli_fetch_assoc($result);
    $data_user2 = mysqli_fetch_assoc($result);

    // attempt of each weeks
    // $query2 = "SELECT COUNT(All_session_ID) FROM all_session INNER JOIN "
    // $query_getMember = "SELECT CASE WHEN User_ID = 0 THEN 'guest' ELSE 'member' END AS userType,
    //                         MONTHNAME(Date) AS MonthName, 
    //                         COUNT(User_ID) AS No_User FROM all_session 
    //                         WHERE Date > CURDATE() - INTERVAL 6 MONTH AND User_ID <> 0 
    //                         GROUP BY userType, MonthName;";

    $query_getMember = "SELECT * FROM
                          (SELECT MONTHNAME(Date) AS MonthName
                          FROM all_session 
                          WHERE Date > LAST_DAY(CURDATE()) - INTERVAL 6 MONTH 
                          GROUP BY MonthName) AS t1
                          LEFT JOIN
                          (SELECT
                          CASE WHEN User_ID = 0 THEN 'guest' ELSE 'member' END AS userType,
                          MONTHNAME(Date) AS MonthName, 
                          COUNT(User_ID) AS No_User
                          FROM all_session 
                          WHERE Date > LAST_DAY(CURDATE()) - INTERVAL 6 MONTH AND User_ID <> 0 
                          GROUP BY userType, MonthName) AS t2
                          ON t1.MonthName = t2.MonthName;";

    // $query_getGuest = "SELECT CASE WHEN User_ID = 0 THEN 'guest' ELSE 'member' END AS userType,
    //                         MONTHNAME(Date) AS MonthName, 
    //                         COUNT(User_ID) AS No_User FROM all_session 
    //                         WHERE Date > LAST_DAY(CURDATE()) - INTERVAL 6 MONTH AND User_ID = 0 
    //                         GROUP BY userType, MonthName;";

    $query_getGuest = "SELECT * FROM
                          (SELECT MONTHNAME(Date) AS MonthName
                          FROM all_session 
                          WHERE Date > LAST_DAY(CURDATE()) - INTERVAL 6 MONTH 
                          GROUP BY MonthName) AS t1
                          LEFT JOIN
                          (SELECT
                          CASE WHEN User_ID = 0 THEN 'guest' ELSE 'member' END AS userType,
                          MONTHNAME(Date) AS MonthName, 
                          COUNT(User_ID) AS No_User
                          FROM all_session 
                          WHERE Date > LAST_DAY(CURDATE()) - INTERVAL 6 MONTH AND User_ID = 0 
                          GROUP BY userType, MonthName) AS t2
                          ON t1.MonthName = t2.MonthName;";

    $query_getMonthName = "SELECT MONTHNAME(Date) AS MonthName FROM all_session 
                                WHERE Date > LAST_DAY(CURDATE()) - INTERVAL 6 MONTH 
                                GROUP BY MonthName;";

    $result_member = mysqli_query($con, $query_getMember);
    $result_guest = mysqli_query($con, $query_getGuest);
    $result_monthName = mysqli_query($con, $query_getMonthName);
    $num_row = mysqli_num_rows($result_monthName); echo '<script>console.log('. $num_row .')</script>';

    //category quiz amount
    $query_category = "SELECT category.Category, COUNT(quiz.qz_ID) AS No_Ques
                        FROM quiz LEFT JOIN category on quiz.Category_ID = category.ID
                        GROUP BY category.Category;";
    $result_category = mysqli_query($con, $query_category);
    $no_row = mysqli_num_rows($result_category);
?>

<head>
    <title>KON Quiz - AdminHomepage</title>
</head>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<div class="container p-3 shadow">
  <div class="m-4"><h2>Report</h2><div>
    <div class="container m-2">
        <canvas id="user-bar-chart" style="width:70%"></canvas>
    </div>
    <div class="container m-2">
        <canvas id="attempt-line-chart" style="width:70%"></canvas>
    </div>
    <div class="container m-2">
        <canvas id="pie-chart" style="width:70%"></canvas>
    </div>
</div>

<script>

///////////////////////////////
//                           //
//     make user bar chart   //
//                           //
///////////////////////////////

var xValues = ["TotalMembers", "Male Members", "Female Members"];
var yValues = [<?php echo json_encode($data_user1['No_User'] + $data_user2['No_User'])?>, <?php echo json_encode($data_user1['No_User'])?>, <?php echo json_encode($data_user2['No_User'])?>];
console.log("after assign" + yValues[0]);
var barColors = ['#1300bd', '#6bbfff', '#ee6bff'];

new Chart("user-bar-chart", {
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

///////////////////////////////////
//                               //
//     make attempt line chart   //
//                               //
///////////////////////////////////

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
console.log(arr_month);
console.log(arr_member);
console.log(arr_guest);
new Chart("attempt-line-chart", {
  type: "line",
  data: {
    labels: xValuesMonth,
    datasets: [{ 
      data: arr_member,
      borderColor: "red",
      fill: false,
      label: "Member Attempt"
    }, { 
      data: arr_guest,
      borderColor: "green",
      fill: false,
      label: "Guest Attempt"
    }]
  },
  options: {
    legend: {display: true}
  }
});

////////////////////////////////////////
//                                    //
//     make quiz category pie chart   //
//                                    //
////////////////////////////////////////

//make pie chart data
var size = <?php echo $no_row = mysqli_num_rows($result_category);?>;
var arr_category_no_question = new Array(size);
var arr_category = new Array(size);
var i = 0;
<?php while($row = mysqli_fetch_array($result_category)) { ?>
    arr_category_no_question[i] = "<?php echo $row['No_Ques']?>";
    if ("<?php echo $row['Category']?>" == '') {
      arr_category[i] = "Others";
    }
    else {
      arr_category[i] = "<?php echo $row['Category']?>";
    }
    i++;
<?php }?>

console.log(arr_category);
console.log(arr_category_no_question);
// var xValuesCategory = ["Italy", "France", "Spain", "USA", "Argentina"];
var xValuesCategory = arr_category;
var yValuesCategory = arr_category_no_question;
var barColors = ["#6CE5E8", "#41B8D5", "#31356E", "#2F5F98", "#2D8BBA", "#9932CC", "#C71585", "#FF1493", "#FF69B4", "#FFB6C1"];

new Chart("pie-chart", {
  type: "pie",
  data: {
    labels: xValuesCategory,
    datasets: [{
      backgroundColor: barColors,
      data: yValuesCategory
    }]
  },
  options: {
    title: {
      display: true,
      text: "Amount of question in each Category"
    }
  }
});
</script>

<style>
</style>