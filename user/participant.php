<?php
    include("../session.php");
    include("../conn.php");
    if (isset($_GET['qz_id'])) {
        $quiz_id = $_GET['qz_id'];
        $_SESSION['quiz_id'] = $quiz_id;
    }

    $title = "View Participant";

    $count = 0;

    $query = "SELECT all_session.User_ID as UID, user.Username, quiz.Title, all_session.Date, all_session.Total_question, all_session.Correct_question, 
        all_session.Time_used
        FROM all_session INNER JOIN quiz ON all_session.qz_ID = quiz.qz_ID
        LEFT JOIN user on all_session.User_ID = user.ID
        WHERE all_session.qz_ID = $quiz_id";
    $result = mysqli_query($con, $query);

    $query_get_date = "SELECT Date FROM all_session WHERE qz_ID = $quiz_id GROUP BY Date ORDER BY Correct_question DESC";
    $date_result = mysqli_query($con, $query_get_date);

    //get question
    $query_quiz_title = "SELECT * FROM quiz WHERE qz_ID = $quiz_id";
    $title_result = mysqli_query($con, $query_quiz_title);
    $quiz_data = mysqli_fetch_assoc($title_result);
?>

<head>
    <title>KON Quiz - Participant List</title>
</head>

<div class="container px-3">
<?php include('../template/nav_tabs.php') ?>
    <div class="shadow p-5 pt-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="view_participant.php">View Participant</a></li>
                <li class="breadcrumb-item active" aria-current="page">Participant List</li>
            </ol>
        </nav>
        <h3 class="my-4"><?php echo $quiz_data['Title'] ?></h3>
        <!-- show all available question -->
        <?php 
            while($row=mysqli_fetch_array($date_result)) {
            ?>  
            <div class="row">
                <div class="d-flex align-items-center">
                    <i class="bi bi-calendar"></i>
                    <div class="fs-5 ms-3"><?php echo $row['Date'];?></div>
                </div>
                
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col" class="col-4">Username</th>
                                <th scope="col" class="col-2">Result</th>
                                <th scope="col" class="col-6">Marks</th>
                            </tr>
                        </thead>
                        <?php
                        mysqli_data_seek($result, 0);
                        while($data = mysqli_fetch_array($result)) {
                            $count += 1;
                            if ($data['Date'] == $row['Date']) {
                        ?>
                        <tbody>
                            <tr>
                                <td><?php if ($data['UID'] == 0) { echo "Guest"; } else { echo $data['Username'];}?></td>
                                <td><?php echo $data['Correct_question']. "/" . $data['Total_question']?></td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <div class="progress my-1" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-success" style="width:<?php echo ($data['Correct_question'] / $data['Total_question'] * 100)?>%" id="cor-bar"></div>
                                                <div class="progress-bar progress-bar-striped bg-danger progress-bar" style="width:<?php echo (($data['Total_question'] - $data['Correct_question']) / $data['Total_question'] * 100)?>%" id="wrg-bar"></div>
                                            </div>
                                        </div>
                                        <div class="col-2 ps-0">
                                            <?php echo ($data['Correct_question'] / $data['Total_question'] * 100)?>%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                            <?php
                            }
                        }
                            ?>
                    </table>
                </div>
            </div>
            <?php
            }
            ?>
    </div>
</div>


