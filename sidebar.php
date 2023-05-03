<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close position-absolute top-0 start-0 m-1" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <div class="offcanvas-title mx-auto">
            <img src="img/nerd.png" class="img-thumbnail thumbnail" alt="...">
            <h4 class="username p-3"><?php if (isset($_SESSION['id'])) echo $_SESSION['username']; ?></h4>
        </div>
    </div>

    <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="homepage.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">My Question</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="edit_profile2.php">Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
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