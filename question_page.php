<!DOCTYPE html>
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
    $id = $_SESSION['id'];

    $query = "SELECT * FROM quiz WHERE qz_ID = $quiz_id AND User_ID = $id";
    $result = mysqli_query($con, $query);
    $quiz_data = mysqli_fetch_assoc($result);

    //get question
    $query_ques = "SELECT * FROM quiz_ques WHERE qz_ID = $quiz_id";
    $question_result = mysqli_query($con, $query_ques);
?>

<html>
    <head>
        <title>KON Quiz - Create Quiz</title>
        <meta name="description" content="Our first page">
        <meta name="keywords" content="html tutorial template">
    </head>
    
    <body>
    <br><br>
    <div class="container-fluid pt-5 px-5 mx-auto">
        <div class="shadow p-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right"><?php echo $quiz_data['Title'] ?></h4> 
            </div> 
            <div class="container-fluid p-3">
                <form action="create_ques.php">
                    <button class="btn btn-primary btn-lg my-3" type="submit">+ADD NEW QUESTION</button>
                </form>
                
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h5 class="col">'. $row['ques'] . '</h5>
                            <form action="edit_ques.php" method="POST">
                                <button type="submit" class="btn btn-primary col-sm-1 mx-1">Edit</button>
                                <button type="button" class="btn btn-primary col-sm-1">Delete</button>                    
                                <input type="hidden" value="'. $row['ID'] .'">
                            </form>
                        </div>
                    </div>
                    <div class="card-body mx-2">'. $row['opt1'] . '</div>
                    <div class="card-body mx-2 correct-opt">'. $row['opt2'] . '</div>
                    <div class="card-body mx-2">'. $row['opt3'] . '</div>
                    <div class="card-body mx-2">'. $row['opt4'] . '</div>
                </div>  
                

                <!-- show all available question -->
                <?php 
                    while($row=mysqli_fetch_array($question_result)) {
                        if ($row['correct_opt'] == "opt1") {
                            $question_block = '
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <h5 class="col">'. $row['ques'] . '</h5>
                                            <form action="edit_ques.php" method="POST">
                                                <button type="submit" class="btn btn-primary col-sm-1 mx-1">Edit</button>
                                                <button type="button" class="btn btn-danger del-btn" data-bs-toggle="modal" data-bs-target="#delete-confirm" value="'. $row['ID'] .'" onclick="">Delete</button>                       
                                                <input type="hidden" value="'. $row['ID'] .'" name="ques_id">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body mx-2 correct-opt">'. $row['opt1'] . '</div>
                                    <div class="card-body mx-2 ">'. $row['opt2'] . '</div>
                                    <div class="card-body mx-2">'. $row['opt3'] . '</div>
                                    <div class="card-body mx-2">'. $row['opt4'] . '</div>
                                </div>  
                            ';
                        }
                        else if ($row['correct_opt'] == "opt2") {
                            $question_block = '
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <h5 class="col">'. $row['ques'] . '</h5>
                                            <form action="edit_ques.php" method="POST">
                                                <button type="submit" class="btn btn-primary col-sm-1 mx-1">Edit</button>
                                                <button type="button" class="btn btn-danger del-btn" data-bs-toggle="modal" data-bs-target="#delete-confirm" value="'. $row['ID'] .'" onclick="">Delete</button>                       
                                                <input type="hidden" value="'. $row['ID'] .'" name="ques_id">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body mx-2">'. $row['opt1'] . '</div>
                                    <div class="card-body mx-2 correct-opt">'. $row['opt2'] . '</div>
                                    <div class="card-body mx-2">'. $row['opt3'] . '</div>
                                    <div class="card-body mx-2">'. $row['opt4'] . '</div>
                                </div>  
                            ';
                        }
                        else if ($row['correct_opt'] == "opt3") {
                            $question_block = '
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <h5 class="col">'. $row['ques'] . '</h5>
                                            <form action="edit_ques.php" method="POST">
                                                <button type="submit" class="btn btn-primary col-sm-1 mx-1">Edit</button>
                                                <button type="button" class="btn btn-danger del-btn" data-bs-toggle="modal" data-bs-target="#delete-confirm" value="'. $row['ID'] .'" onclick="">Delete</button>                    
                                                <input type="hidden" value="'. $row['ID'] .'" name="ques_id">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body mx-2">'. $row['opt1'] . '</div>
                                    <div class="card-body mx-2 ">'. $row['opt2'] . '</div>
                                    <div class="card-body mx-2 correct-opt">'. $row['opt3'] . '</div>
                                    <div class="card-body mx-2">'. $row['opt4'] . '</div>
                                </div>  
                            ';
                        }
                        else if ($row['correct_opt'] == "opt4") {
                            $question_block = '
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <h5 class="col">'. $row['ques'] . '</h5>
                                            <form action="edit_ques.php" method="POST">
                                                <button type="submit" class="btn btn-primary col-sm-1 mx-1">Edit</button>
                                                <button type="button" class="btn btn-danger del-btn" data-bs-toggle="modal" data-bs-target="#delete-confirm" value="'. $row['ID'] .'" onclick="">Delete</button>                       
                                                <input type="hidden" value="'. $row['ID'] .'" name="ques_id">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body mx-2">'. $row['opt1'] . '</div>
                                    <div class="card-body mx-2 ">'. $row['opt2'] . '</div>
                                    <div class="card-body mx-2">'. $row['opt3'] . '</div>
                                    <div class="card-body mx-2 correct-opt">'. $row['opt4'] . '</div>
                                </div>  
                            ';
                        }
                        
                        echo $question_block;
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
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Quiz</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="toast align-items-center mx-auto border-0" id="alert" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="mx-auto my-3">
                    Are you sure you want to delete this?
                </div>
            </div>
            <div class="modal-footer"><form id="del_ques">
                <form id="delete-form" action="">
                    <input type="hidden" value="" name="ques_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" name="">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
    </body>
</html>

<style>
    #ques {
        height: 25vh;
        resize: none;
    }

    .tick {
        height: 30px;
        width: 30px;        
    }

    .correct-opt {
        background-color: #9cff82;
    }

    .modal-img-danger{
        width: 40vh;
    }
</style>
<script>
    $(document).ready(function() {

        $(".del-btn").click(function() {
        var btn_val = $(this).val();
        $("#delete-confirm input[name='ques_id']").val(btn_val);
        alert(btn_val);
        });

    
        $('#delete-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'del_ques.php',
                data:  $(this).serialize(),
                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data.check);
                    if (data.response == 'Success') {
                        $('#alert').removeClass('text-bg-danger').addClass('text-bg-success');
                    } else {
                        $('#alert').removeClass('text-bg-success').addClass('text-bg-danger');
                    }
                    $('#alert').find('.toast-body').html(data.message);
                    bootstrap.Toast.getOrCreateInstance(document.getElementById('alert1')).show();
                }
            });
        });
    });
</script>