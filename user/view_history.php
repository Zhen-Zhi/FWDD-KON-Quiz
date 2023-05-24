<?php 
    include("../session.php");
    include("../conn.php");
    $id = $_SESSION['id'];

    $query = "SELECT * FROM session INNER JOIN quiz ON session.qz_ID = quiz.qz_ID where session.User_ID = $id";

    $title = 'History';

    $records_per_page = 12;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $total_records = mysqli_num_rows(mysqli_query($con, "SELECT * FROM session INNER JOIN quiz ON session.qz_ID = quiz.qz_ID where session.User_ID = $id"));
    $total_pages = ceil($total_records / $records_per_page);

    $search = null;

    $sort = null;

    if(isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $query .= " AND Title LIKE '%$search%'";
    }
    if(isset($_GET['sortBy']) && !empty($_GET['sortBy'])) {
        $sort = $_GET['sortBy'];
        if($sort == 'Oldest'){
            $query .= " ORDER BY session.Session_ID ASC";
        }else{
            $query .= " ORDER BY session.Session_ID DESC";
        }
    }else{
        $query .= " ORDER BY session.Session_ID DESC";
    }

    $query .= " LIMIT $records_per_page OFFSET $offset";

    $result = mysqli_query($con, $query);
    
    $category = "SELECT * FROM category ORDER BY ID ASC";
    $res = mysqli_query($con, $category);
?>

<head>
    <title>KON Quiz - <?php echo $title; ?></title>
</head>

<div class="container px-3">
    <?php include('../template/nav_tabs.php') ?>

        <h2 class="px-2 my-4">Your Past Quizzes
            <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="You can find all the quizzes that you done previously">
                <i class="bi bi-question-circle"></i>
            </button>
        </h2>

        <form class="row px-2 my-4" action="view_history.php">
            <div class="col">
                <input class="form-control" id="search-input" type="search" name="search" placeholder="Search Quiz Title" aria-label="Search"  value="<?php echo $search ?>">
            </div>
        
            <div class="col">
                <select id="select-input" name="sortBy" class="form-select" onchange="sortItem(this)">
                    <option value="All" <?php if ($sort === "All") echo "selected"; ?>>All</option>
                    <option value="Newest" <?php if ($sort === "Newest") echo "selected"; ?>>Newest</option>
                    <option value="Oldest" <?php if ($sort === "Oldest") echo "selected"; ?>>Oldest</option>
                </select>
            </div>
            <div class="col">
                <button class="btn btn-primary">Search</button>
            </div>
        </form>

        <nav aria-label="Page navigation example">
            <ul class="pagination px-2">
                <li class="page-item">
                    <a class="page-link" <?php if ($page > 1){ ?> onclick="navigateToPage(<?php echo $page - 1; ?>)" <?php } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo $page === $i ? 'active' : ''; ?>">
                    <a class="page-link" onclick="navigateToPage(<?php echo $i; ?>)"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($page < $total_pages){ ?> onclick="navigateToPage(<?php echo $page + 1; ?>)" <?php } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                
                <?php 
                    while($row=mysqli_fetch_array($result)) {
                ?>
                        <div class="col">
                            <div class="card quiz-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $row['Title'] ?>
                                    </h5>
                                    <div class="card-text h-100">
                                        <?php echo $row['Description'] ?>
                                        <div class="d-flex my-1">
                                            <label><?php echo $row['Time_used']?></label>
                                            <i class="bi bi-stopwatch-fill col"></i>
                                            <label><?php echo $row['Correct_question'] ?> / <?php echo $row['Total_question'] ?></label>
                                        </div>
                                        <div class="progress shadow" style="height: 15px" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-success" style="width:<?php echo ($row['Correct_question'] / $row['Total_question']) * 100?>%" id="cor-bar"></div>
                                            <div class="progress-bar progress-bar-striped bg-danger" style="width:<?php echo (($row['Total_question'] - $row['Correct_question']) / $row['Total_question']) * 100?>%" id="wrg-bar"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-center">
                                    <small class="text-body-secondary">Last Completed <?php echo $row['Date']?></small>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
</div>

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    function sortItem(e){
        let newValue = e.value;

        if (window.location.search) {
            const urlParams = new URLSearchParams(window.location.search);
            const sortByParam = urlParams.get('sortBy');

            if (sortByParam) {
                // Replace the value of the sortBy parameter
                urlParams.set('sortBy', newValue);
            } else {
                // Add a new sortBy parameter
                urlParams.append('sortBy', newValue);
            }

            // Update the URL with the new query string
            window.history.replaceState({}, '', `${window.location.pathname}?${urlParams.toString()}`);
        }else{
            const urlParams = new URLSearchParams('?search=&sortBy=');
            urlParams.set('sortBy', newValue);

            window.history.replaceState({}, '', `${window.location.pathname}?${urlParams.toString()}`);
        }

        location.reload();
    }

    function navigateToPage(page) {
        history.replaceState(null, null, window.location.pathname + window.location.search.split('&message=')[0]);
        if(window.location.search){
            const urlParams = new URLSearchParams(window.location.search);
            const sortByParam = urlParams.get('page');

            if (sortByParam) {
                // Replace the value of the sortBy parameter
                urlParams.set('page', page);
            } else {
                // Add a new sortBy parameter
                urlParams.append('page', page);
            }

            window.history.replaceState({}, '', `${window.location.pathname}?${urlParams.toString()}`);

            location.reload();
        }else{
            window.location.href = `?page=${page}`;
        }
    }
</script>

<style>

    .modal-img-danger{
        width: 40vh;
    }

    .quiz-card:hover{
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transition: box-shadow 0.3s ease-in-out;
    }

    .page-link:hover{
        cursor: pointer;
    }
</style>
