<?php
    include("session.php");
    include("conn.php");
    if (isset($_GET['qz_id'])) {
        $quiz_id = $_GET['qz_id'];
        $_SESSION['quiz_id'] = $quiz_id;
    }
    else {
        $quiz_id = $_SESSION['quiz_id'];
    }
    $count = 0;
    $id = $_SESSION['id'];

    $query = "SELECT * FROM quiz WHERE qz_ID = $quiz_id AND User_ID = $id";
    $result = mysqli_query($con, $query);
    $quiz_data = mysqli_fetch_assoc($result);

    //get question
    $query_ques = "SELECT * FROM quiz_ques WHERE qz_ID = $quiz_id";
    $question_result = mysqli_query($con, $query_ques);
?>

<head>
    <title>KON Quiz - Create Quiz</title>
    <meta name="description" content="Our first page">
    <meta name="keywords" content="html tutorial template">
</head>

<div class="container-fluid px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profile.php">Dashboard</a>
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
            while($row=mysqli_fetch_array($question_result)) {
                $count += 1;
            ?>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h5 class="col"><?php echo $count ?>. <?php echo $row['ques'] ?></h5>
                        </div>
                    </div>
                    <div class="card-body" id="answer">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="opt1" id="flexCheckDefault" <?php echo ($row['correct_opt'] == 'opt1') ? 'checked' : ''; ?> disabled>
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo $row['opt1'] ?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="opt2" id="flexCheckDefault" <?php echo ($row['correct_opt'] == 'opt2') ? 'checked' : ''; ?> disabled>
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo $row['opt2'] ?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="opt3" id="flexCheckDefault" <?php echo ($row['correct_opt'] == 'opt3') ? 'checked' : ''; ?> disabled>
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo $row['opt3'] ?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="opt4" id="flexCheckDefault" <?php echo ($row['correct_opt'] == 'opt4') ? 'checked' : ''; ?> disabled>
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo $row['opt4'] ?>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="edit_ques.php" method="POST">
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <button id="del_btn" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-confirm" value="'. $row['ID'] .'" onclick="">Delete</button>                       
                            <input type="hidden" value="'. $row['ID'] .'" name="ques_id">
                        </form>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

            <div class="col">
                <div class="card">
                    <a type="button" class="btn btn-lg h-100" href="create_ques.php"><button class="btn fs-1 text-secondary border-0 h-100">+</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.form-check-input:checked').each(function() {
        $(this).parent('.form-check').addClass('checked');
    });
</script>

<style>
    .card{
        height: 30vh;
    }

    .checked{
        background-color: #9cff82;
    }

    .modal-img-danger{
        width: 40vh;
    }
</style>
<script>
    $("#del_btn").click(function() {
        var btn_val = $(this).val();
        alert(btn_val);
    });
</script>