<?php
    include("session.php");
    include("conn.php");
    include("toast.php");
    if (isset($_GET['qz_id'])) {
        $quiz_id = $_GET['qz_id'];
        $_SESSION['quiz_id'] = $quiz_id;
    }
    else {
        $quiz_id = $_SESSION['quiz_id'];
    }
    $count = 0;
    $id = $_SESSION['id'];

    $query = "SELECT * FROM quiz WHERE qz_ID = $quiz_id AND User_ID = $id";
    $result = mysqli_query($con, $query);
    $quiz_data = mysqli_fetch_assoc($result);

    //get question
    $query_ques = "SELECT * FROM quiz_ques WHERE qz_ID = $quiz_id";
    $question_result = mysqli_query($con, $query_ques);
?>

<head>
    <title>KON Quiz - Create Quiz</title>
    <meta name="description" content="Our first page">
    <meta name="keywords" content="html tutorial template">
</head>

<div class="container px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profile.php">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">View Question</a>
        </li>
    </ul>
    <div class="shadow p-5 pt-4">
        <h3><?php echo $quiz_data['Title'] ?></h3>

        <!-- show all available question -->
        <div class="row row-cols-1 row-cols-md-1 g-4">
            <div class="col">
                <div class="card">
                    <a type="button" class="btn btn-lg h-100" href="create_ques.php"><button class="btn fs-1 text-secondary border-0 h-100">+</button></a>
                </div>
            </div>
        <?php 
            while($row=mysqli_fetch_array($question_result)) {
                $count += 1;
            ?>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h5 class="col"><?php echo $count ?>. <?php echo $row['ques'] ?></h5>
                        </div>
                    </div>
                    <div class="card-body" id="answer">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="opt1" id="flexCheckDefault" <?php echo ($row['correct_opt'] == 'opt1') ? 'checked' : ''; ?> disabled>
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo $row['opt1'] ?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="opt2" id="flexCheckDefault" <?php echo ($row['correct_opt'] == 'opt2') ? 'checked' : ''; ?> disabled>
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo $row['opt2'] ?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="opt3" id="flexCheckDefault" <?php echo ($row['correct_opt'] == 'opt3') ? 'checked' : ''; ?> disabled>
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo $row['opt3'] ?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="opt4" id="flexCheckDefault" <?php echo ($row['correct_opt'] == 'opt4') ? 'checked' : ''; ?> disabled>
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo $row['opt4'] ?>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="edit_ques.php" method="POST">
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <button type="button" class="btn btn-danger del-btn" data-bs-toggle="modal" data-bs-target="#delete-confirm" value="<?php echo $row['ID']?>" onclick="">Delete</button>                       
                            <input type="hidden" value="<?php echo $row['ID']?>" name="ques_id">
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

<!-- Confirm delete modal -->
<div class="modal fade" id="delete-confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog flex-column modal-dialog-centered">
        <img class="modal-img-danger" src="img/Cave_Monkey.png" alt="">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Quiz</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="toast align-items-center mx-auto border-0" id="alert" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="mx-auto my-3">
                    Are you sure you want to delete this?
                </div>
            </div>
            <div class="modal-footer">
                <form id="del">
                    <input type="hidden" value="" name="ques_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" name="">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const toastLiveExample = document.getElementById('liveToast')
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

    $('.form-check-input:checked').each(function() {
        $(this).parent('.form-check').addClass('checked');
    });

    $(document).ready(function() {
        var message = decodeURIComponent(getUrlParameter('message'));
        if (message) {
            $('#liveToast').addClass('text-bg-success');
            $('#liveToast').find('.toast-body').html(message);
            toastBootstrap.show();

            const newUrl = window.location.href.replace(`&message=${message}`, '');
            history.replaceState(null, null, newUrl);
        }
    });

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };
    $('#del').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            console.log(formData)
            $.ajax({
                type: 'POST',
                url: 'del_ques.php',
                data: formData,
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.response == 'Success') {
                            $('#alert').removeClass('text-bg-danger').addClass('text-bg-success');
                            setTimeout(function() {
                                window.location.href = 'question_page.php';
                            }, 1000);
                        } else {
                            $('#alert').removeClass('text-bg-success').addClass('text-bg-danger');
                        }
                        $('#alert').find('.toast-body').html(data.message);
                        bootstrap.Toast.getOrCreateInstance(document.getElementById('alert')).show();
                }
            });
        });    
        
    $(".del-btn").click(function() {
        var btn_val = $(this).val();
        $("#delete-confirm input[name='ques_id']").val(btn_val);
        $('#delete-confirm').modal('show');
    });
</script>

<style>
    /* .card{
        height: 30vh;
    } */

    .checked{
        background-color: #9cff82;
    }

    .modal-img-danger{
        width: 40vh;
    }
</style>