<?php 
    include("conn.php");
    include("template/navigation_admin.php");
?>

<?php  
    // USER SQL

    if(isset($_POST['searchBtn'])){
        // Retrieve the search key
        $search_key =$_POST['search_key'];
        // Create SQL code to search if the search key exits in multiple attribute
        $query ="SELECT * FROM user WHERE CONCAT(ID, Username, Email, Password, DOB, Tel, Gender, Profile_pic)
        LIKE '%$search_key%' GROUP BY ID";
    }
    // Else create SQL code that displays every car record
    elseif(isset($_POST['searchBtn2'])){
        $query ="SELECT * FROM user GROUP BY ID"; 
    }
    else{
        $query ="SELECT * FROM user GROUP BY ID";   
    }

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
            echo '<script>alert("Record Delete Failed!"); window.location.href="adminuser.php";</script>;';
          }
          // Else if the SQL code successfully excuted
          else {
            // Close engineiva database connection  
            mysqli_close($con);
            // Echo car deleted and direct back to modify and remove page
            echo '<script>alert("Record Deleted!");
            window.location.href= "adminuser.php";
            </script>';
          }
            
    }
?>

<head>
    <title>KON Quiz - AdminEdituser</title>
</head>

<div class="container-fluid px-5">
    <div class="shadow p-5 mt-3 mb-5">
        <div class="row">
            <div class="col pb-5">

                <!-- Start of main content -->
                <div class="content-container">
                    <h2 class="fw-bold pb-4">All Users</h2>

                    <div class="seach-contain">
                        <h5 class="fw-bold">Total User(s) found: <?php echo $row_count;?></h5>
                        <form action="adminuser.php" method="POST">
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
                    

                    <!-- Start of table -->
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>DOB</th>
                            <th>Tel</th>
                            <th>Gender</th>
                            <th></th>
                            <th></th>
                        </tr>
                        
                        <?php 
                            // Fetch record and echo one by one
                            while($user = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>".$user['ID']."</td>";
                                echo "<td>".$user['Username']."</td>";
                                echo "<td>".$user['Email']."</td>";
                                echo "<td>".$user['DOB']."</td>";
                                echo "<td>".$user['Tel']."</td>";
                                echo "<td>".$user['Gender']."</td>";
                                echo '<td>
                                        <button class="btn"><a href="ad-car-edit.php?ID='.$user['ID'].'">Edit</a></button>
                                    </td>';
                                echo '<td>
                                        <form action="adminuser.php" method="POST">
                                            <button class="btn" name="deleteUser" onclick="return confirm(\'Are you sure you want to do that?\')" value="'.$user['ID'].'">Delete</button>
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