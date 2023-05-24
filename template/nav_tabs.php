<?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) { ?>

    <ul class="nav nav-tabs">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php if ($title === 'quiz') echo 'active'; ?>" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Quiz</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/FWDD-KON-QUIZ/admin/adminhome.php?category">Categories</a></li>
                <li><a class="dropdown-item" href="/FWDD-KON-QUIZ/admin/adminhome.php?quiz">Quizzes</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($title === 'user') echo 'active'; ?>" href="/FWDD-KON-QUIZ/admin/adminuser.php">Users</a>
        </li>
    </ul>

<?php }else{ ?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="/FWDD-KON-QUIZ/homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($title === 'Dashboard') echo 'active'; ?>" aria-current="page" href="/FWDD-KON-QUIZ/user/dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($title === 'View Participant') echo 'active'; ?>" aria-current="page" href="/FWDD-KON-QUIZ/user/view_participant.php">View Participant</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($title === 'History') echo 'active'; ?>" aria-current="page" href="/FWDD-KON-QUIZ/user/view_history.php">History</a>
        </li>
    </ul>
<?php } ?>