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