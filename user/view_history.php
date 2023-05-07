<head>
    <title>KON Quiz - Profile Page</title>
</head>

<?php 
    include("../session.php");
    include("../conn.php");
    include("../template/toast.php");
    $id = $_SESSION['id'];

    $query = "SELECT * FROM session INNER JOIN quiz ON session.qz_ID = quiz.qz_ID where session.User_ID = $id ORDER BY session.Session_ID DESC";
    // $query = "SELECT * FROM quiz where User_ID = $id ORDER BY qz_ID DESC";
    $result = mysqli_query($con, $query);
    
    $category = "SELECT * FROM category ORDER BY ID ASC";
    $res = mysqli_query($con, $category);
?>

<div class="container px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="../homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
        </li>
    </ul>
    <!-- <div class="border-0 shadow-lg" style="height: 80vh;"> -->
        <h2 class="px-2 my-4">Your Past Quizzes</h2>
        <!-- HELLOOOOOOOOOOOOOOOOOOOOOOOOO need put loop here from database -->
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <!-- <div class="col">
                    <div class="card h-100">
                        <button data-bs-toggle="modal" data-bs-target="#create-quiz" class="btn fs-1 h-100 text-secondary" type="submit" name= "">
                            +
                        </button>
                    </div>
                </div> -->
                
                <?php 
                    while($row=mysqli_fetch_array($result)) {
                ?>
                        <div class="col">
                            <div class="card quiz-card h-100">
                                <!-- <a type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Click to view question" class="text-decoration-none text-dark-emphasis" href="question_page.php?qz_id=<?php echo $row['qz_ID'] ?>"> -->
                                    <div class="card-body" onclick="window.location.href = 'question_page.php?qz_id=<?php echo $row['qz_ID'] ?>">
                                        <h5 class="card-title"><?php echo $row['Title'] ?></h5>
                                        <div class="card-text">
                                            <?php echo $row['Description'] ?>
                                            <div class="row my-4">
                                                <i class="bi bi-stopwatch-fill fs-3 col-2"></i><p class="col card-text"><?php echo $row['Time_used']?></p>
                                            </div>   
                                            <div>
                                                <label><?php echo $row['Correct_question'] ?> / <?php echo $row['Total_question'] ?></label>
                                                <div class="progress shadow mt-2" style="height: 15px" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width:<?php echo ($row['Correct_question'] / $row['Total_question']) * 100?>%" id="cor-bar"></div>
                                                    <div class="progress-bar progress-bar-striped bg-danger" style="width:<?php echo (($row['Total_question'] - $row['Correct_question']) / $row['Total_question']) * 100?>%" id="wrg-bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- </a> -->

                                <div class="card-footer text-center">
                                    <small class="text-body-secondary">Last Completed <?php echo $row['Date']?></small>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="edit-quiz-<?php echo $row['qz_ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header text-bg-secondary shadow">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit quiz</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="needs-validation" action="" method="POST" novalidate id="edit-form">
                                        <div class="modal-body">
                                            <div class="mx-auto">
                                                <label for="quiz-title" class="form-label">Quiz Title</label>
                                                <input id="quiz-title" class="form-control" type="text" name="qz_title" value="<?php echo $row['Title'] ?>">
                                            </div>
                                            <div class="mx-auto">
                                                <label for="quiz-desc" class="form-label">Quiz Description</label>
                                                <textarea class="form-control" id="quiz-desc" name="qz_desc"><?php echo $row['Description'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" value="<?php echo $row['qz_ID']?>" name="qz_id">
                                            <input type="hidden" value="1" name="editQuiz">
                                            <button class="btn btn-primary edit-btn" name="create_quiz" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
</div>

<!--  Modal  -->
<div class="modal fade" id="create-quiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-bg-secondary shadow">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create new quiz</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="" method="POST" novalidate id="quiz-form">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['id'];?>" name="id">
                    <div class="col">
                        <label for="quiz-title" class="form-label">Quiz Title</label>
                        <input id="quiz-title" class="form-control" type="text" name="qz_title">
                    </div>
                    <div class="col mt-2">
                        <label for="quiz-category" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="qz_cat">
                            <?php while(($row = mysqli_fetch_assoc($res))){
                            ?>
                                <option value="<?php echo $row['ID'] ?>"><?php echo $row['Category'] ?></option>
                            <?php
                                    }
                            ?>
                        </select>
                    </div>
                    <div class="col mt-2">
                        <label for="quiz-desc" class="form-label">Quiz Description</label>
                        <textarea class="form-control" id="quiz-desc" name="qz_desc"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="1" name="createQuiz">
                    <button class="btn btn-primary" name="create_quiz" type="submit">
                        Create Quiz
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete quiz modal -->
<div class="modal fade" id="delete-quiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog flex-column modal-dialog-centered">
        <img class="modal-img-danger" src="../img/Cave_Monkey.png" alt="">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Quiz</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mx-auto my-3">
                    Are you sure you want to delete this?
                </div>
            </div>
            <div class="modal-footer">
                <form id="del">
                    <input type="hidden" value="" name="deleteQuiz">
                    <input type="hidden" value="" name="qz_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" name="">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- display modal -->
<div class="modal fade" id="display" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-success">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Join Quiz</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row w-50 mx-auto">
                        <img src="" alt="" class="img-fluid">
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <label for="" class="form-label">Room ID</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 text-center mx-auto">
                            <input type="text" class="form-control text-center" id="room-id" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* #modal-btn{
        background-color: #6E2BF2 !important;
        border-bottom: 5px solid #1c0052 !important;
        color: white !important;
    } */
    /* #edit-quiz-desc{
        height: 25vh;
        resize: none;
    } */
    
    /* #quiz-desc {
        height: 25vh;
        resize: none;
    } */

    /* .card{
        height: 25vh;
    } */

    .modal-img-danger{
        width: 40vh;
    }

    .quiz-card:hover{
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transition: box-shadow 0.3s ease-in-out;
    }
</style>
