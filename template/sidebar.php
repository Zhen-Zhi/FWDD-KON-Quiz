<?php 
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE ID = $id";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);
    $image_data = base64_encode($row['Profile_pic']);
    $image_src = "data:image/jpeg;base64,{$image_data}";
?>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close position-absolute top-0 start-0 m-1" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <div class="offcanvas-title mx-auto">
            <?php if ($image_src){ ?>
                <img src="<?php echo $image_src; ?>" onerror="this.src='img/nerd.png';" class="img-thumbnail thumbnail" alt="...">
            <?php }else{ ?>
                <img src="../img/nerd.png" class="img-thumbnail form-control thumbnail" alt="...">
            <?php } ?>
            <h4 class="text-center p-3"><?php if (isset($_SESSION['id'])) echo $_SESSION['username']; ?></h4>
        </div>
    </div>

    <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/FWDD-KON-QUIZ/homepage.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/FWDD-KON-QUIZ/user/dashboard.php?search=&sortBy=All">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/FWDD-KON-QUIZ/all_quiz.php?cat_id=0">Available Quizzes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/FWDD-KON-QUIZ/user/view_participant.php">View Participant</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/FWDD-KON-QUIZ/user/view_history.php">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/FWDD-KON-QUIZ/user/edit_profile.php">Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/FWDD-KON-QUIZ/support.php">Support</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/FWDD-KON-QUIZ/logout.php">Logout</a>
            </li>
        </ul>
    </div>
</div>
<style>
    .thumbnail{
        border-radius: 100% !important;
        width: 150px;
        height: 150px;
    }

    .offcanvas-header{
        background-color: #6E2BF2;
        color: white;
    }

</style>