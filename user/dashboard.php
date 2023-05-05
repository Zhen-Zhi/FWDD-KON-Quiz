<head>
    <title>KON Quiz - Profile Page</title>
</head>

<?php 
    include("../session.php");
    include("../conn.php");
    include("../template/toast.php");
    $id = $_SESSION['id'];

    $query = "SELECT * FROM quiz where User_ID = $id ORDER BY qz_ID DESC";
    $result = mysqli_query($con, $query);
?>

<div class="container px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="../homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
        </li>
    </ul>
    <!-- <div class="border-0 shadow-lg" style="height: 80vh;"> -->
        <h2 class="px-2">Your Current Quizzes</h2>
        <!-- HELLOOOOOOOOOOOOOOOOOOOOOOOOO need put loop here from database -->
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <div class="card">
                        <button data-bs-toggle="modal" data-bs-target="#create-quiz" class="btn fs-1 h-100 text-secondary" type="submit" name= "">
                            +
                        </button>
                    </div>
                </div>
                
                <?php 
                    while($row=mysqli_fetch_array($result)) {
                ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['Title'] ?></h5>
                                    <p class="card-text"><?php echo $row['Description'] ?></p>
                                </div>
                                <div class="card-footer">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input switch" type="checkbox" role="switch" id="flexSwitchCheckDefault-<?php echo $row['qz_ID'] ?>" <?php echo ($row['Room_ID'] != '') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="flexSwitchCheckDefault-<?php echo $row['qz_ID'] ?>"><?php echo ($row['Room_ID'] != '') ? 'Open' : 'Close'; ?></label>
                                    </div>

                                    <form method="GET" class="my-0" action="question_page.php">
                                        <input type="hidden" value="<?php echo $row['qz_ID']?>" name="qz_id">                     
                                        <button type="submit" class="btn btn-primary">View</button>
                                        <button type="button" class="btn text-light btn-secondary" data-bs-toggle="modal" data-bs-target="#edit-quiz-<?php echo $row['qz_ID']?>" value="<?php echo $row['qz_ID']?>" name="editQuiz">Edit</button>
                                        <button type="button" class="btn btn-danger del-btn" data-bs-toggle="modal" data-bs-target="#delete-quiz" value="<?php echo $row['qz_ID']?>">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="edit-quiz-<?php echo $row['qz_ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header text-bg-secondary shadow">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit quiz</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="needs-validation" action="" method="POST" novalidate id="edit-form">
                                        <div class="modal-body">
                                            <div class="mx-auto">
                                                <label for="quiz-title" class="form-label">Quiz Title</label>
                                                <input id="quiz-title" class="form-control" type="text" name="qz_title" value="<?php echo $row['Title'] ?>">
                                            </div>
                                            <div class="mx-auto">
                                                <label for="quiz-desc" class="form-label">Quiz Description</label>
                                                <textarea class="form-control" id="quiz-desc" name="qz_desc"><?php echo $row['Description'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" value="<?php echo $row['qz_ID']?>" name="qz_id">
                                            <input type="hidden" value="1" name="editQuiz">
                                            <button class="btn btn-primary edit-btn" name="create_quiz" type="submit">
                                                Save
                                            </button>
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

<!--  Modal  -->
<div class="modal fade" id="create-quiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-bg-secondary shadow">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create new quiz</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="" method="POST" novalidate id="quiz-form">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['id'];?>" name="id">
                    <div class="mx-auto">
                        <label for="quiz-title" class="form-label">Quiz Title</label>
                        <input id="quiz-title" class="form-control" type="text" name="qz_title">
                    </div>
                    <div class="mx-auto">
                        <label for="quiz-desc" class="form-label">Quiz Description</label>
                        <textarea class="form-control" id="quiz-desc" name="qz_desc"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="1" name="createQuiz">
                    <button class="btn btn-primary" name="create_quiz" type="submit">
                        Create Quiz
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete quiz modal -->
<div class="modal fade" id="delete-quiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog flex-column modal-dialog-centered">
        <img class="modal-img-danger" src="../img/Cave_Monkey.png" alt="">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Quiz</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mx-auto my-3">
                    Are you sure you want to delete this?
                </div>
            </div>
            <div class="modal-footer">
                <form id="del">
                    <input type="hidden" value="" name="deleteQuiz">
                    <input type="hidden" value="" name="qz_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" name="">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function generateRoomID() {
        const num = '0123456789';
        let result = '';
        for (let i = 0; i < 6; i++) {
            result += num[Math.floor(Math.random() * num.length)];
        }
        return result;
    }

    $(document).ready(function() {
        $('.switch').change(function() {
            let roomID = null;
            let id = parseInt(this.id.replace('flexSwitchCheckDefault-', ''));
            let state = 1;

            if ($(this).is(':checked')) {
                $('label[for='+ this.id +'').text('Open');
                roomID = generateRoomID();
                state = 1;
            } else {
                $('label[for='+ this.id +'').text('Close');
                state = 0;
            }

            $.ajax({
                type: 'POST',
                url: 'quiz_handler.php',
                data: {
                    qz_id: id,
                    room_ID: roomID,
                    changeState: true,
                    state: state
                },
                success: function(response) {
                    var data = response;
                    if (data.response == 'Success') {
                        window.location.href = 'dashboard.php?&message=' + encodeURIComponent(data.message);
                    } else {
                        $('#liveToast').addClass('text-bg-danger');
                        $('#liveToast').find('.toast-body').html(data.message);
                        toastBootstrap.show();
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX error: " + status + " - " + error);
                }
            });
            // console.log(222,roomID,id)
        });

        $('#quiz-form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            $.ajax({
                type: 'POST',
                url: 'quiz_handler.php',
                data: formData,
                success: function(response) {
                    var data = response;
                    if (data.response == 'Success') {
                        window.location.href = 'dashboard.php?&message=' + encodeURIComponent(data.message);
                    } else {
                        $('#liveToast').addClass('text-bg-danger');
                        $('#liveToast').find('.toast-body').html(data.message);
                        toastBootstrap.show();
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX error: " + status + " - " + error);
                }
            });
        });

        $('#edit-form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            $.ajax({
                type: 'POST',
                url: 'quiz_handler.php',
                data: formData,
                success: function(response) {
                    var data = response;
                    if(data.response == "Success"){ 
                        window.location.href = 'dashboard.php?&message=' + encodeURIComponent(data.message);
                    }else{
                        $('#liveToast').addClass('text-bg-danger');
                        $('#liveToast').find('.toast-body').html(data.message);
                        toastBootstrap.show();
                    }
                }
            });
        });

        $('#del').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'quiz_handler.php',
                data: $(this).serializeArray(),
                success: function(response) {
                    var data = response;
                    if (data.response == 'Success') {
                        window.location.href = 'dashboard.php?&message=' + encodeURIComponent(data.message);
                    } else {
                        $('#liveToast').addClass('text-bg-danger');
                        $('#liveToast').find('.toast-body').html(data.message);
                        toastBootstrap.show();
                    }
                }
            });
        });

        // $(".edit-btn").click(function() {
        //     var btn_val = $(this).val();
        //     $("#edit-quiz input[name='qz_id']").val(btn_val);
        //     $('#edit-quiz').modal('show');
        // });

        $(".del-btn").click(function() {
            var btn_val = $(this).val();
            $("#delete-quiz input[name='qz_id']").val(btn_val);
            $('#delete-quiz').modal('show');
        });

        // $(".start-quiz").click(function() {
        //     var roomID = generateRoomID();
        //     console.log(roomID);
        //     $("#quiz input[name='room_ID']").val(roomID);
        // });
    });


</script>

<style>
    /* #modal-btn{
        background-color: #6E2BF2 !important;
        border-bottom: 5px solid #1c0052 !important;
        color: white !important;
    } */
    #edit-quiz-desc{
        height: 25vh;
        resize: none;
    }
    
    #quiz-desc {
        height: 25vh;
        resize: none;
    }

    .card{
        height: 25vh;
    }

    .modal-img-danger{
        width: 40vh;
    }
</style>
