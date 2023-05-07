<?php
    include("../session.php");
    include("../conn.php");
    include("../template/toast.php");
    if (isset($_GET['qz_id'])) {
        $quiz_id = $_GET['qz_id'];
        $_SESSION['quiz_id'] = $quiz_id;
    }

    $count = 0;

    $query = "SELECT session.User_ID as UID, user.Username, quiz.Title, session.Date, session.Total_question, session.Correct_question, 
        session.Time_used
        FROM session INNER JOIN quiz ON session.qz_ID = quiz.qz_ID
        INNER JOIN user on session.User_ID = user.ID
        WHERE session.qz_ID = $quiz_id";
    $result = mysqli_query($con, $query);

    $query_get_date = "SELECT Date FROM session WHERE qz_ID = $quiz_id GROUP BY Date";
    $date_result = mysqli_query($con, $query_get_date);

    //get question
    $query_quiz_title = "SELECT * FROM quiz WHERE qz_ID = $quiz_id";
    $title_result = mysqli_query($con, $query_quiz_title);
    $quiz_data = mysqli_fetch_assoc($title_result);
?>

<head>
    <title>KON Quiz - Create Quiz</title>
    <meta name="description" content="Our first page">
    <meta name="keywords" content="html tutorial template">
</head>

<div class="container px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="../homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">View Question</a>
        </li>
    </ul>
    <div class="shadow p-5 pt-4">
        <h3><?php echo $quiz_data['Title'] ?></h3>

        <!-- show all available question -->
        <div class="row row-cols-1 row-cols-md-1 g-4">
        <?php 
            while($row=mysqli_fetch_array($date_result)) {
                // $query = 'SELECT session.User_ID as UID, quiz.Title, session.Date, session.Total_question, session.Correct_question, 
                //     session.Time_used
                //     FROM session INNER JOIN quiz ON session.qz_ID = quiz.qz_ID WHERE session.qz_ID = $quiz_id AND session.Date ='. $row["Date"];
                // $result = mysqli_query($con, $query);
            ?>
                <h4><?php echo $row['Date']?></h4>
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Result</th>
                    <th scope="col">Correct Question</th>
                    <th scope="col">Marks</th>
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
                    <td><?php echo $data['Username']?></td>
                    <td><?php echo $data['Correct_question']. "/" . $data['Total_question']?></td>
                    <td><?php echo $data['Correct_question']?></td>
                    <td><?php echo ($data['Correct_question'] / $data['Total_question'] * 100)?>%</td>
                    </tr>
                </tbody>
                
            <?php
            }}
            ?>
            </table>
            <?php
                }
            ?>
            
        </div>
    </div>
</div>

<!-- Confirm delete modal -->
<div class="modal fade" id="delete-confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog flex-column modal-dialog-centered">
        <img class="modal-img-danger" src="img/Cave_Monkey.png" alt="">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Question</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <div class="toast align-items-center mx-auto border-0" id="alert" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div> -->
            <div class="modal-body">
                <div class="mx-auto my-3">
                    Are you sure you want to delete this?
                </div>
            </div>
            <div class="modal-footer">
                <form id="del">
                    <input type="hidden" value="1" name="deleteQuestion">
                    <input type="hidden" value="" name="ques_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" name="">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('.form-check-input:checked').each(function() {
        $(this).parent('.form-check').addClass('checked');
    });

    $('#del').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            console.log(formData)
            $.ajax({
                type: 'POST',
                url: 'question_handler.php',
                data: formData,
                success: function(response) {
                    var data = response;
                    if (data.response == 'Success') {
                        window.location.href = 'question_page.php?qz_id=<?php echo $_SESSION['quiz_id'] ?>&message=' + encodeURIComponent(data.message);
                    } else {
                        $('#liveToast').addClass('text-bg-danger');
                        $('#liveToast').find('.toast-body').html(data.message);
                        toastBootstrap.show();
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX error: " + status + " - " + error);
                }
            });
        });    
        
    $(".del-btn").click(function() {
        var btn_val = $(this).val();
        $("#delete-confirm input[name='ques_id']").val(btn_val);
        $('#delete-confirm').modal('show');
    });
</script>

<style>
    /* .card{
        height: 30vh;
    } */

    .checked{
        background-color: #9cff82;
    }

    .modal-img-danger{
        width: 40vh;
    }
</style>