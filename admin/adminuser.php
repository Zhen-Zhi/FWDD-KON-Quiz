<?php 
    include("../session.php");
    include("../conn.php");
    include("../template/toast.php");
    
    $title = 'user';
?>

<?php  
    // USER SQL

    if(isset($_POST['searchBtn'])){
        // Retrieve the search key
        $search_key =$_POST['search_key'];
        // Create SQL code to search if the search key exits in multiple attribute
        $query ="SELECT * FROM user WHERE CONCAT(ID, Username, Email)
        LIKE '%$search_key%' ORDER BY ID ASC";
    }
    // Else create SQL code that displays every car record
    elseif(isset($_POST['searchBtn2'])){
        $query ="SELECT * FROM user ORDER BY ID ASC "; 
    }
    else{
        $query ="SELECT * FROM user ORDER BY ID ASC";   
    }

    $records_per_page = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $total_records = mysqli_num_rows(mysqli_query($con, $query));
    $total_pages = ceil($total_records / $records_per_page);

    $query .= " LIMIT $records_per_page OFFSET $offset";

    $result = mysqli_query($con,$query);
    $row_count = mysqli_num_rows($result);

    // DELETE USER
    if(isset($_POST['deleteUser'])){
        $userID = $_POST['deleteUser'];

        $deleteUser = "DELETE FROM user WHERE ID=$userID";
        mysqli_query($con,$deleteUser);

        if (!mysqli_query($con,$deleteUser)) {
            // Close engineiva database connection  
            mysqli_close($con);
            // Echo delete failed and direct back to modify and remove page
            echo '<script>window.location.href="adminuser.php?error=' . urlencode("Delete Failed!") . '";</script>';
          }
          // Else if the SQL code successfully excuted
          else {
            // Close engineiva database connection  
            mysqli_close($con);
            // Echo deleted and direct back to modify and remove page
            echo '<script>window.location.href="adminuser.php?message=' . urlencode("User Deleted!") . '";</script>';
          }
            
    }
?>

<head>
    <title>KON Quiz - AdminEdituser</title>
</head>

<div class="container mt-2">
    <!-- <div class="shadow p-3"> -->
        <div class="row">
            <div class="col pb-5">
            <?php include('../template/nav_tabs.php') ?>


                <!-- Start of main content -->
                
                    <h2 class="my-3">All Users</h2>

                    <div class="seach-contain">
                        <h5>Total User(s) found: <?php echo $row_count;?></h5>
                        <form action="adminuser.php" method="POST">
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
                    <!-- Start of table -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>DOB</th>
                                <th>Tel</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php 
                            // Fetch record and echo one by one
                            while($user = mysqli_fetch_array($result)){ ?>
                               <tr class="table-hover">
                                <td><?php echo $user['ID']?></td>
                                <td><?php echo $user['Username']?></td>
                                <td><?php echo $user['Email']?></td>
                                <td><?php echo $user['DOB']?></td>
                                <td><?php echo $user['Tel']?></td>
                                <td><?php echo $user['Gender']?></td>
                                <td>
                                    <form action="adminuser.php" method="POST">
                                        <button class="btn btn-danger" name="deleteUser" onclick="return confirm('\Are you sure you want to do that?\')" value="<?php echo $user['ID'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                               </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- End of table -->
                </div>

            </div>
        </div>
    <!-- </div> -->
</div>

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

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