<?php 
    include("../session_admin.php");
    include("../conn.php");
    include("../template/toast.php");

    $title = 'quiz';
?>

<?php  
    // CATEGORY SQL
    if(isset($_GET['category'])){
        $query ="SELECT * FROM category ORDER BY ID ASC";  
    }else{
        $query ="SELECT * FROM quiz ORDER BY qz_ID ASC";  
    }

    $records_per_page = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $total_records = mysqli_num_rows(mysqli_query($con, $query));
    $total_pages = ceil($total_records / $records_per_page);

    $query .= " LIMIT $records_per_page OFFSET $offset";
     
    $result = mysqli_query($con, $query);

    // ADD CATEGORY
    if(isset($_POST['submitbtn'])){
        $category = $_POST['category'];

        $query = "INSERT INTO category (Category) VALUES ('$category')";
        $result = mysqli_query($con, $query);

        if (!$result) {
            // Close engineiva database connection  
            mysqli_close($con);
            echo '<script>window.location.href="adminhome.php?category&error=' . urlencode("Add Failed!") . '";</script>';
        }else {
            // Close engineiva database connection  
            mysqli_close($con);
            echo '<script>window.location.href="adminhome.php?category&message=' . urlencode("Category Added!") . '";</script>';
        }
    }

    // DELETE CATEGORY
    if(isset($_POST['deleteCat'])){
        $catID = $_POST['deleteCat'];

        $deleteCat = "DELETE FROM category WHERE ID=$catID";
        mysqli_query($con,$deleteCat);

        if (!mysqli_query($con, $deleteCat)) {
            // Close engineiva database connection  
            mysqli_close($con);
            // Redirect to adminhome.php with an error message
            echo '<script>window.location.href="adminhome.php?category&error=' . urlencode("Delete Failed!") . '";</script>';
        } else {
            // Close engineiva database connection  
            mysqli_close($con);
            // Redirect to adminhome.php with a success message
            echo '<script>window.location.href="adminhome.php?category&message=' . urlencode("Category Deleted!") . '";</script>';
        }
            
    }



    // QUIZ SQL
    if(isset($_POST['searchBtn'])){
        // Retrieve the search key
        $search_key =$_POST['search_key'];
        // Create SQL code to search if the search key exits in multiple attribute
        $query2 ="SELECT * FROM quiz WHERE CONCAT(qz_ID, Title, Room_ID)
        LIKE '%$search_key%' GROUP BY qz_ID ASC";
    }
    // Else create SQL code that displays every car record
    elseif(isset($_POST['searchBtn2'])){
        $query2 ="SELECT * FROM quiz ORDER BY qz_ID ASC"; 
    }
    else{
        $query2 ="SELECT * FROM quiz ORDER BY qz_ID ASC";   
    }

    $result2 = mysqli_query($con,$query2);
    $row_count = mysqli_num_rows($result2);


    // DELETE QUIZ
    if(isset($_POST['deleteQuiz'])){
        $quizID = $_POST['deleteQuiz'];

        $deleteQuiz = "DELETE FROM quiz WHERE qz_ID=$quizID";
        mysqli_query($con,$deleteQuiz);

        if (!mysqli_query($con,$deleteQuiz)) {
            // Close engineiva database connection  
            mysqli_close($con);
            // Echo delete failed and direct back to modify and remove page
            echo '<script>window.location.href="adminhome.php?quiz&message=' . urlencode("Delete Failed!") . '";</script>';
          }
          // Else if the SQL code successfully excuted
          else {
            // Close engineiva database connection  
            mysqli_close($con);
            // Echo deleted and direct back to modify and remove page
            echo '<script>window.location.href="adminhome.php?quiz&message=' . urlencode("Quiz Deleted!") . '";</script>';
          }
            
    }

?>

<head>
    <title>KON Quiz - AdminHomepage</title>
</head>

<div class="container mt-2">
<?php include('../template/nav_tabs.php') ?>
<?php if (isset($_GET['category'])){ ?>
    <!-- <div class="shadow p-5"> -->
        <h2 class="my-3">Categories</h2>
        <!-- Start of main content -->
            <form action="adminhome.php" method="POST">
                <div class="row">
                    <div class="col-auto">
                        <input type="text" class="form-control" id="category" name="category" placeholder="Add Category">
                    </div>
                    <div class="col">
                        <button class="btn btn-dark" type="submit" name="submitbtn" value="searchBtn">
                            Create
                        </button>
                    </div>
                </div>
            </form>

            <nav aria-label="Page navigation example">
                <ul class="pagination my-3">
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

            <!-- Start of table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="asc" data-sort="ID">ID</th>
                            <th data-sort="Category">Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        // Fetch record and echo one by one
                        while($cat = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td><?php echo $cat['ID'] ?></td>
                                <td><?php echo $cat['Category'] ?></td>
                                <td>
                                    <form action="adminhome.php" method="POST">
                                        <button class="btn btn-danger" name="deleteCat" value="<?php echo $cat['ID'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php 
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- End of table -->
    <!-- </div> -->
<?php } ?>

<?php if (isset($_GET['quiz'])){ ?>
    <!-- <div class="shadow p-5 mt-3 mb-5"> -->

            <h2 class="my-3">Quizzes</h2>

            <div class="seach-contain">
                <h5>Total Quizzes found: <?php echo $row_count;?></h5>
                <form action="adminhome.php" method="POST">
                    <div class="row">
                        <div class="col-5">
                            <input type="text" placeholder="Search..." class="form-control" name="search_key">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-dark" type="submit" name="searchBtn" value="searchBtn">
                                Search
                            </button>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-dark" type="submit" name="searchBtn2" value="searchBtn">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>

                <nav aria-label="Page navigation example">
                    <ul class="pagination my-3">
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
            </div>
                
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="asc" data-sort="qz_ID">qz_ID</th>
                            <th data-sort="Title">Title</th>
                            <th data-sort="Description">Description</th>
                            <th data-sort="User_ID">User_ID</th>
                            <th data-sort="Room_ID">Room_ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            // Fetch record and echo one by one
                            while($quiz = mysqli_fetch_array($result2)){
                                echo "<tr>";
                                echo "<td>".$quiz['qz_ID']."</td>";
                                echo "<td>".$quiz['Title']."</td>";
                                echo "<td>".$quiz['Description']."</td>";
                                echo "<td>".$quiz['User_ID']."</td>";
                                echo "<td>".$quiz['Room_ID']."</td>";
                                echo '<td>
                                        <form action="adminhome.php" method="POST">
                                            <button class="btn btn-danger" name="deleteQuiz" value="'.$quiz['qz_ID'].'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>';
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

    <!-- </div> -->
<?php } ?>
</div>

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    // const toastLiveExample = document.getElementById('alertToast')
    // const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

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

    function sortTable(columnIndex) {
        const table = document.querySelector('.table');
        const headers = Array.from(table.querySelectorAll('th[data-sort]'));
        const rows = Array.from(table.querySelectorAll('tbody tr'));

        const clickedHeader = headers[columnIndex];
        const isAscending = clickedHeader.classList.toggle('asc');
        const isDescending = !isAscending;

        headers.forEach((header, index) => {
            if (index !== columnIndex) {
                header.classList.remove('asc', 'desc');
            }
        });

        if (isAscending) {
            clickedHeader.classList.add('asc');
            clickedHeader.classList.remove('desc');
        } else {
            clickedHeader.classList.add('desc');
            clickedHeader.classList.remove('asc');
        }

        rows.sort((a, b) => {
            const aValue = a.querySelector(`td:nth-child(${columnIndex + 1})`).textContent.trim();
            const bValue = b.querySelector(`td:nth-child(${columnIndex + 1})`).textContent.trim();

            if (!isNaN(Number(aValue))) { // ID column
                return Number(aValue) - Number(bValue);
            } else { // Category column
                return aValue.localeCompare(bValue);
            }

        });

        if (isDescending) {
            rows.reverse();
        }

        rows.forEach(row => table.querySelector('tbody').appendChild(row));
    }

    document.addEventListener('DOMContentLoaded', () => {
        const headers = Array.from(document.querySelectorAll('th[data-sort]'));

        headers.forEach((header, index) => {
            header.addEventListener('click', () => {
                sortTable(index);
            });
        });
    });
</script>

<style>
    .asc::after {
        content: '\25B2'; /* Upward-pointing triangle */
        margin-left: 5px;
        font-weight: bold;
    }

    .desc::after {
        content: '\25BC'; /* Downward-pointing triangle */
        margin-left: 5px;
        font-weight: bold;
    }

    thead{
        cursor:pointer;
    }
</style>