<?php 
    include("../session.php");
    include("../conn.php");
    include("../template/toast.php");
    $id = $_SESSION['id'];

    $records_per_page = 12;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $total_records = mysqli_num_rows(mysqli_query($con, "SELECT * FROM quiz where User_ID = $id"));
    $total_pages = ceil($total_records / $records_per_page);

    $query_2 = "SELECT * FROM quiz where User_ID = $id ORDER BY qz_ID DESC LIMIT $records_per_page OFFSET $offset";
    $result2 = mysqli_query($con, $query_2);
?>

<head>
    <title>KON Quiz - View Participant</title>
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
            <a class="nav-link active" aria-current="page" href="#">View Participant</a>
        </li>
    </ul>

        <div class="px-2">
            <h2 class="my-4 me-2">Your Current Quizzes</h2>
            <div class="fs-5">Select quiz to view participant</div>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination mt-2 px-2">
            <li class="page-item">
                <a class="page-link" href="<?php if ($page > 1){ ?>?page=<?php echo $page - 1;} ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php echo $page === $i ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
            <?php endfor; ?>

            <li class="page-item">
                <a class="page-link" href="<?php if ($page < $total_pages){ ?>?page=<?php echo $page + 1;} ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="container mt-2">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            
            <?php 
                while($row=mysqli_fetch_array($result2)) {
                    $query = 'SELECT * FROM session INNER JOIN quiz ON session.qz_ID = quiz.qz_ID INNER JOIN user on user.ID = session.User_ID where session.qz_ID ='. $row["qz_ID"];
                    $result = mysqli_query($con, $query);
            ?>
                <div class="col">
                    <div class="card quiz-card h-100" onclick="window.location.href = 'participant.php?qz_id=<?php echo $row['qz_ID'] ?>'">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['Title'] ?></h5>
                            <p class="card-text"><?php echo $row['Description'] ?></p>                                         
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">Total Attempt: <?php echo mysqli_num_rows($result)?></small>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<style>
    .quiz-card:hover{
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transition: box-shadow 0.3s ease-in-out;
        cursor: pointer;
    }
</style>
