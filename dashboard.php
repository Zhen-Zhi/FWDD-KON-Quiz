<?php
    include("session.php");
    include("conn.php");
    include("template/toast.php");
    $cat_id = $_GET['cat_id'];
    $cat_id = 2;

    $query = "SELECT * FROM quiz WHERE Category_ID = $cat_id AND Room_ID <> ''";
    $result = mysqli_query($con, $query);
?>

<head>
    <title>KON Quiz - Dashboard</title>
</head>

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
        <h2 class="px-2 my-4">Your Current Quizzes</h2>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php 
                    while($row=mysqli_fetch_array($result)) {
                ?>
                        <div class="col">
                            <div class="card quiz-card h-100">
                                <!-- <a type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Click to view question" class="text-decoration-none text-dark-emphasis" href="question_page.php?qz_id=<?php echo $row['qz_ID'] ?>"> -->
                                    <div class="card-body" onclick="window.location.href = 'question_page.php?qz_id=<?php echo $row['qz_ID'] ?>">
                                        <a class="text-decoration-none text-dark-emphasis" href="question_page.php?qz_id=<?php echo $row['qz_ID'] ?>">
                                            <h5 class="card-title"><?php echo $row['Title'] ?></h5>
                                            <p class="card-text"><?php echo $row['Description'] ?></p>
                                        </a>
                                    </div>
                                <!-- </a> -->

                                <?php if ($row['Room_ID'] != ""){ ?>
                                <div class="card-footer">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary share" value="<?php echo $row['Room_ID'] ?>"><i class="bi bi-share"></i></button>
                                        <input id="roomID-<?php echo $row['Room_ID'] ?>" class="form-control" type="text" value="<?php echo $row['Room_ID'] ?>" aria-label="default input example" readonly>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="modal fade" id="edit-quiz-<?php echo $row['qz_ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header text-bg-secondary shadow">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit quiz</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="needs-validation" action="" method="POST" novalidate id="edit-form-<?php echo $row['qz_ID']?>">
                                        <div class="modal-body">
                                            <div class="mx-auto">
                                                <label for="quiz-title" class="form-label">Quiz Title</label>
                                                <input id="quiz-title" class="form-control" type="text" name="qz_title" value="<?php echo $row['Title'] ?>">
                                            </div>
                                            <div class="mx-auto">
                                                <label for="quiz-desc" class="form-label">Quiz Description</label>
                                                <textarea class="form-control" id="quiz-desc" rows="7" name="qz_desc"><?php echo $row['Description'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" value="<?php echo $row['qz_ID']?>" name="qz_id">
                                            <input type="hidden" value="1" name="editQuiz">
                                            <a onclick="submitForm('<?php echo $row['qz_ID']?>')" class="btn btn-primary edit-btn" name="create_quiz" type="submit">
                                                Save
                                            </a>
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