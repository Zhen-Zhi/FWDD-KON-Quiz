<?php
    include("session.php");
    include("conn.php");
    $cat_id = $_GET['cat_id'];
    $query = "SELECT * FROM quiz WHERE Category_ID = $cat_id AND Room_ID <> ''";

    $search = null;
    $sort = null;

    $records_per_page = 11;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $total_records = mysqli_num_rows(mysqli_query($con, "SELECT * FROM quiz where Room_ID <> ''"));
    $total_pages = ceil($total_records / $records_per_page);

    if(isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $query .= " AND Title LIKE '%$search%'";
    }

    if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])) {
        $sort = $_GET['cat_id'];
        if ($sort == 'Open'){
            $query .= " AND COALESCE(Room_ID, '') != ''";
        }else if($sort == 'Close'){
            $query .= " AND COALESCE(Room_ID, '') = ''";
        }else if($sort == 'Newest'){
            $query .= " ORDER BY qz_ID DESC";
        }else if($sort == 'Oldest'){
            $query .= " ORDER BY qz_ID ASC";
        }
    }

    $query .= " LIMIT $records_per_page OFFSET $offset";
    $result = mysqli_query($con, $query);
?>

<head>
    <title>KON Quiz - Quizzes</title>
</head>

<div class="container px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Quizzes</a>
        </li>
    </ul>
    <!-- <div class="border-0 shadow-lg" style="height: 80vh;"> -->
        <h2 class="px-2 my-4">Quizzes
            <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="You can find all the quizzes available here">
                <i class="bi bi-question-circle"></i>
            </button>
        </h2>
        <form class="row px-2 my-4" action="all_quiz.php">
            <div class="col">
                <input class="form-control" id="search-input" type="search" name="search" placeholder="Search Quiz Title" aria-label="Search"  value="<?php echo $search ?>">
            </div>
        
            <div class="col">
                <select class="form-select" onchange="sortItem(this)" name="cat_id">
                    <?php 
                        $category = "SELECT * FROM category ORDER BY ID DESC";
                        $res = mysqli_query($con, $category);

                        while(($row = mysqli_fetch_assoc($res))){
                    ?>
                        <option value="<?php echo $row['ID'] ?>" <?php if ($sort === $row['ID']) echo "selected"; ?>><?php echo $row['Category'] ?></option>
                    <?php
                            }
                    ?>

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
                                <!-- <a type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Click to view question" class="text-decoration-none text-dark-emphasis" href="question_page.php?qz_id=<?php echo $row['qz_ID'] ?>"> -->
                                    <div class="card-body" onclick="window.location.href = 'quiz/quiz.php?room_id=<?php echo $row['Room_ID'] ?>">
                                        <a class="text-decoration-none text-dark-emphasis" href="quiz/quiz.php?room_id=<?php echo $row['Room_ID'] ?>">
                                            <h5 class="card-title"><?php echo $row['Title'] ?></h5>
                                            <p class="card-text"><?php echo $row['Description'] ?></p>
                                        </a>
                                    </div>
                                <!-- </a> -->

                                <?php if ($row['Room_ID'] != ""){ ?>
                                <div class="card-footer">
                                    <div class="input-group">
                                        <p>Click to join quiz</p>
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

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    function navigateToPage(page) {
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

    function sortItem(e){
        let newValue = e.value;

        if (window.location.search) {
            const urlParams = new URLSearchParams(window.location.search);
            const sortByParam = urlParams.get('cat_id');

            if (sortByParam) {
                // Replace the value of the sortBy parameter
                urlParams.set('cat_id', newValue);
            } else {
                // Add a new sortBy parameter
                urlParams.append('cat_id', newValue);
            }

            // Update the URL with the new query string
            window.history.replaceState({}, '', `${window.location.pathname}?${urlParams.toString()}`);
        }else{
            const urlParams = new URLSearchParams('?search=&cat_id=');
            urlParams.set('cat_id', newValue);

            window.history.replaceState({}, '', `${window.location.pathname}?${urlParams.toString()}`);
        }

        location.reload();
    }
</script>

<style>
    .page-link:hover{
        cursor: pointer;
    }
    
    .quiz-card:hover{
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transition: box-shadow 0.3s ease-in-out;
    }
</style>