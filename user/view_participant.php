<head>
    <title>KON Quiz - Profile Page</title>
</head>

<?php 
    include("../session.php");
    include("../conn.php");
    include("../template/toast.php");
    $id = $_SESSION['id'];

    $query_2 = "SELECT * FROM quiz where User_ID = $id ORDER BY qz_ID DESC";
    $result2 = mysqli_query($con, $query_2);
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
        <h2 class="px-2">Your Current Quizzes</h2>
        <!-- HELLOOOOOOOOOOOOOOOOOOOOOOOOO need put loop here from database -->
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                
                <?php 
                    while($row=mysqli_fetch_array($result2)) {
                        $query = 'SELECT * FROM session INNER JOIN quiz ON session.qz_ID = quiz.qz_ID INNER JOIN user on user.ID = session.User_ID where session.qz_ID ='. $row["qz_ID"];
                        $result = mysqli_query($con, $query);
                ?>
                        <div class="col">
                            <div class="card quiz-card h-100">
                                <!-- <div class="card-header">
                                    <div class="row">
                                        <div class="col d-flex w-100 align-items-center">
                                            <div class="form-check my-0 form-switch">
                                                <label class="form-check-label">Date</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                    <div class="card-body" onclick="window.location.href = 'participant.php?qz_id=<?php echo $row['qz_ID'] ?>'">
                                        <h5 class="card-title"><?php echo $row['Title'] ?></h5>
                                        <p class="card-text"><?php echo $row['Description'] ?></p>                                         
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-body-secondary">Total Attempt: <?php echo mysqli_num_rows($result)?></small>
                                    </div>
                                <!-- </a> -->
                            </div>
                        </div>
                <?php
                    }
                ?>
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
