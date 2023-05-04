<!DOCTYPE html>
<?php
    include("session.php");
    include("conn.php");
    if (isset($_GET['qz_id'])) {
        $quiz_id = $_GET['qz_id'];
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
                            <form>
                                <button type="button" class="btn btn-primary col-sm-1 mx-1">Edit</button>
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
                                            <form>
                                                <button type="button" class="btn btn-primary col-sm-1 mx-1">Edit</button>
                                                <button type="button" class="btn btn-primary col-sm-1">Delete</button>                    
                                                <input type="hidden" value="'. $row['ID'] .'">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body mx-2">'. $row['opt1'] . '</div>
                                    <div class="card-body mx-2 correct-opt">'. $row['opt2'] . '</div>
                                    <div class="card-body mx-2">'. $row['opt3'] . '</div>
                                    <div class="card-body mx-2">'. $row['opt4'] . '</div>
                                    <input type="hidden" value="'. $row['ID'] .'">
                                </div>  
                            ';
                        }
                        else if ($row['correct_opt'] == "opt2") {
                            $question_block = '
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <h5 class="col">'. $row['ques'] . '</h5>
                                            <form>
                                                <button type="button" class="btn btn-primary col-sm-1 mx-1">Edit</button>
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
                            ';
                        }
                        else if ($row['correct_opt'] == "opt3") {
                            $question_block = '
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <h5 class="col">'. $row['ques'] . '</h5>
                                            <form>
                                                <button type="button" class="btn btn-primary col-sm-1 mx-1">Edit</button>
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
                            ';
                        }
                        else if ($row['correct_opt'] == "opt4") {
                            $question_block = '
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <h5 class="col">'. $row['ques'] . '</h5>
                                            <form>
                                                <button type="button" class="btn btn-primary col-sm-1 mx-1">Edit</button>
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
                            ';
                        }
                        
                        echo $question_block;
                    }
                ?>
                <button type="button" class="btn btn-danger">Delete quiz</button>
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
</style>