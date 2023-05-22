<?php 
    include("../conn.php");
    include("../template/navigation_admin.php");
    include("../template/template.html");
?>

<?php  
    // CATEGORY SQL
    $query ="SELECT * FROM category";   
    $result = mysqli_query($con, $query);


    // ADD CATEGORY
    if(isset($_POST['submitbtn'])){
        $category = $_POST['category'];

        $query = "INSERT INTO category (Category) VALUES ('$category')";
        $result = mysqli_query($con, $query);

        if (!$result) {
            // Close engineiva database connection  
            mysqli_close($con);
            // Echo delete failed and direct back to modify and remove page
            echo '<script>alert("Add Category Failed!"); window.location.href="adminhome.php";</script>;';
            }
            // Else if the SQL code successfully excuted
            else {
            // Close engineiva database connection  
            mysqli_close($con);
            // Echo car deleted and direct back to modify and remove page
            echo '<script>alert("Category Added");
            window.location.href= "adminhome.php";
            </script>';
        }
    }

    // DELETE CATEGORY
    if(isset($_POST['deleteCat'])){
        $catID = $_POST['deleteCat'];

        $deleteCat = "DELETE FROM category WHERE ID=$catID";
        mysqli_query($con,$deleteCat);

        if (!mysqli_query($con,$deleteCat)) {
            // Close engineiva database connection  
            mysqli_close($con);
            // Echo delete failed and direct back to modify and remove page
            echo '<script>alert("Record Delete Failed!"); window.location.href="adminhome.php";</script>;';
          }
          // Else if the SQL code successfully excuted
          else {
            // Close engineiva database connection  
            mysqli_close($con);
            // Echo car deleted and direct back to modify and remove page
            echo '<script>alert("Record Deleted!");
            window.location.href= "adminhome.php";
            </script>';
          }
            
    }



    // QUIZ SQL
    if(isset($_POST['searchBtn'])){
        // Retrieve the search key
        $search_key =$_POST['search_key'];
        // Create SQL code to search if the search key exits in multiple attribute
        $query2 ="SELECT * FROM quiz WHERE CONCAT(qz_ID, Title, Room_ID)
        LIKE '%$search_key%' GROUP BY qz_ID";
    }
    // Else create SQL code that displays every car record
    elseif(isset($_POST['searchBtn2'])){
        $query2 ="SELECT * FROM quiz GROUP BY qz_ID"; 
    }
    else{
        $query2 ="SELECT * FROM quiz GROUP BY qz_ID";   
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
            echo '<script>alert("Record Delete Failed!"); window.location.href="adminhome.php";</script>;';
          }
          // Else if the SQL code successfully excuted
          else {
            // Close engineiva database connection  
            mysqli_close($con);
            // Echo car deleted and direct back to modify and remove page
            echo '<script>alert("Record Deleted!");
            window.location.href= "adminhome.php";
            </script>';
          }
            
    }

?>

<head>
    <title>KON Quiz - AdminHomepage</title>
</head>

<div class="container-fluid px-5">
    <div class="shadow p-5 mt-3 mb-5">
        <div class="row">
            <div class="col">

                <!-- Start of main content -->
                <div class="content-container">
                    <h2 class="fw-bold pb-4">Categories</h2>

                    <h5 class="fw-bold">Add Category</h5>
                        <form action="adminhome.php" method="POST">
                            <div class="d-flex pb-4">
                                <div class="col-md-2 me-3">
                                    <input type="text" class="form-control" name="category">
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-dark" type="submit" name="submitbtn" value="searchBtn">
                                        Enter
                                    </button>
                                </div>
                            </div>
                        </form>

                    <!-- Start of table -->
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                        
                        <?php 
                            // Fetch record and echo one by one
                            while($cat = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>".$cat['ID']."</td>";
                                echo "<td>".$cat['Category']."</td>";
                                echo '<td>
                                        <form action="adminhome.php" method="POST">
                                            <button class="btn" name="deleteCat" onclick="return confirm(\'Are you sure you want to do that?\')" value="'.$cat['ID'].'">Delete</button>
                                        </form>
                                    </td>';
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <!-- End of table -->
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-5">
    <div class="shadow p-5 mt-3 mb-5">
        <div class="row">
            <div class="col">

                <div class="content-container">
                <h2 class="fw-bold pb-4">Quizzes</h2>

                <div class="seach-contain">
                    <h5 class="fw-bold">Total Quizzes found: <?php echo $row_count;?></h5>
                    <form action="adminhome.php" method="POST">
                        <div class="d-flex pb-4">
                            <div class="col-md-2 me-3">
                                <input type="text" placeholder="Search..." class="form-control" name="search_key">
                            </div>
                            <div class="me-3">
                                <button class="btn btn-dark" type="submit" name="searchBtn" value="searchBtn">
                                    Enter
                                </button>
                            </div>
                                <button class="btn btn-dark" type="submit" name="searchBtn2" value="searchBtn">
                                    Reset
                                </button>
                        </div>
                    </form>
                </div>
                    
                <table class="table">
                            <tr>
                                <th>qz_ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>User_ID</th>
                                <th>Room_ID</th>
                                <th></th>
                            </tr>
                            
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
                                                <button class="btn" name="deleteQuiz" onclick="return confirm(\'Are you sure you want to do that?\')" value="'.$quiz['qz_ID'].'">Delete</button>
                                            </form>
                                        </td>';
                                    echo "</tr>";
                                }
                            ?>
                </table>
            </div>
        </div>
    </div>
</div>