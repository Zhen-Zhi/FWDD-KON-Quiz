<!-- Modal -->
<div class="modal custom-fade" id="sidebar" tabindex="-1" role="dialog">
    <div class="modal-dialog sidebar-dialog" role="document">
        <div class="modal-content sidebar-content">
            <div class="modal-header sidebar-header shadow">
                <table>
                    <tr>
                        <td><img src="img/nerd.png" class="img-thumbnail thumbnail mx-5" alt="..."><td>
                    </tr>
                    <tr>
                        <td><h4 class="username p-3"><?php if (isset($_SESSION['id'])) echo $_SESSION['username']; ?></h4></td>
                    </tr>
                </table>
            </div> 
            <div class="modal-body">
                <div class="sidebar">
                    <a href="#">Home</a>
                    <a href="#">Home1</a>
                    <a href="#">Home2</a>
                    <a href="#">Home3</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .thumbnail{
        border-radius: 100% !important;
        width: 150px;
        height: 150px;
    }

    .sidebar-dialog {
        position: fixed;
        margin: auto;
        height: 100%;
    }

    .sidebar-content {
        height: 100%;
        border-radius: 0px;
        width: 280x;
    }

    .sidebar-header {
        border-radius: 0px;
    }

    .sidebar {
        height: 100%;
        width: 100%;
    }

    .sidebar a {
        display: block;
        width: 100%;
        padding: 20px;
        text-align: center;
    }

    .modal.custom-fade {
        left: -270px;
		transition: left 0.5s ease-in-out;
    }

    .modal.custom-fade.show {
        left: -1px;
    }

</style>