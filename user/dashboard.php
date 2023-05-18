<?php 
    include("../session.php");
    include("../conn.php");

    $id = $_SESSION['id'];

    $query = "SELECT * FROM quiz where User_ID = $id";

    $title = 'Dashboard';

    $records_per_page = 11;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $total_records = mysqli_num_rows(mysqli_query($con, "SELECT * FROM quiz where User_ID = $id"));
    $total_pages = ceil($total_records / $records_per_page);

    $search = null;

    $sort = null;
    

    if(isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $query .= " AND Title LIKE '%$search%'";
    }
    if(isset($_GET['sortBy']) && !empty($_GET['sortBy'])) {
        $sort = $_GET['sortBy'];
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
    
    $category = "SELECT * FROM category ORDER BY ID ASC";
    $res = mysqli_query($con, $category);
?>

<head>
    <title>KON Quiz - <?php echo $title; ?></title>
</head>

<div class="container px-3">
    <?php include('../template/nav_tabs.php') ?>

        <h2 class="px-2 mt-4">Your Current Quizzes
            <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="You can create a new quiz or modify an existing quiz here">
                <i class="bi bi-question-circle"></i>
            </button>
        </h2>
        <form class="row px-2 my-4" action="dashboard.php">
            <div class="col">
                <input class="form-control" id="search-input" type="search" name="search" placeholder="Search Quiz Title" aria-label="Search"  value="<?php echo $search ?>">
            </div>
        
            <div class="col">
                <select id="select-input" name="sortBy" class="form-select" onchange="sortItem(this)">
                    <option value="All" <?php if ($sort === "All") echo "selected"; ?>>All</option>
                    <option value="Open" <?php if ($sort === "Open") echo "selected"; ?>>Open</option>
                    <option value="Close" <?php if ($sort === "Close") echo "selected"; ?>>Close</option>
                    <option value="Newest" <?php if ($sort === "Newest") echo "selected"; ?>>Newest</option>
                    <option value="Oldest" <?php if ($sort === "Oldest") echo "selected"; ?>>Oldest</option>
                </select>
            </div>
            <div class="col">
                <button class="btn btn-primary">Search</button>
            </div>
        </form>

        <div class="row">
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
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <div class="card h-100">
                        <button data-bs-toggle="modal" data-bs-target="#create-quiz" class="btn fs-1 h-100 text-secondary" type="submit" name= "">
                            +
                        </button>
                    </div>
                </div>
                
                <?php 
                    while($row=mysqli_fetch_array($result)) {
                ?>
                        <div class="col">
                            <div class="card quiz-card h-100">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col d-flex w-100 align-items-center">
                                            <div class="form-check my-0 form-switch">
                                                <input class="form-check-input switch" type="checkbox" role="switch" id="flexSwitchCheckDefault-<?php echo $row['qz_ID'] ?>" <?php echo ($row['Room_ID'] != '') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="flexSwitchCheckDefault-<?php echo $row['qz_ID'] ?>"><?php echo ($row['Room_ID'] != '') ? 'Open' : 'Close'; ?></label>
                                            </div>
                                        </div>

                                        <div class="col pe-0 text-end">
                                            <div class="dropdown">
                                                <button class="btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-pen-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <form method="POST" class="my-0" action="view_participant.php">
                                                        <input type="hidden" value="<?php echo $row['qz_ID']?>" name="qz_id">  
                                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-quiz-<?php echo $row['qz_ID']?>" value="<?php echo $row['qz_ID']?>" name="editQuiz">Edit</button></li>
                                                        <li><button type="button" class="dropdown-item del-btn" data-bs-toggle="modal" data-bs-target="#delete-quiz" value="<?php echo $row['qz_ID']?>">Delete</button></li>
                                                    </form>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <a type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Click to view question" class="text-decoration-none text-dark-emphasis" href="question_page.php?qz_id=<?php echo $row['qz_ID'] ?>"> -->
                                    <div class="card-body" onclick="window.location.href = 'question_page.php?qz_id=<?php echo $row['qz_ID'] ?>">
                                        <a class="text-decoration-none text-dark-emphasis" href="question_page.php?qz_id=<?php echo $row['qz_ID'] ?>">
                                            <h5 class="card-title"><?php echo $row['Title'] ?></h5>
                                            <p class="card-text"><?php echo $row['Description'] ?></p>
                                        </a>
                                    </div>
                                <!-- </a> -->

                                <?php if ($row['Room_ID'] != ""){ ?>
                                <div class="card-footer">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary share" value="<?php echo $row['Room_ID'] ?>"><i class="bi bi-share"></i></button>
                                        <input id="roomID-<?php echo $row['Room_ID'] ?>" class="form-control" type="text" value="<?php echo $row['Room_ID'] ?>" aria-label="default input example" readonly>
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
                    <div class="col">
                        <label for="quiz-title" class="form-label">Quiz Title</label>
                        <input id="quiz-title" class="form-control" type="text" name="qz_title">
                    </div>
                    <div class="col mt-2">
                        <label for="quiz-category" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="qz_cat">
                            <?php while(($row = mysqli_fetch_assoc($res))){
                            ?>
                                <option value="<?php echo $row['ID'] ?>"><?php echo $row['Category'] ?></option>
                            <?php
                                    }
                            ?>
                                <option value="0">Others</option>
                        </select>
                    </div>
                    <div class="col mt-2">
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

<!-- display qrcode -->
<div class="modal fade" id="display" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-success">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Join Quiz</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row w-50 d-flex justify-content-center mx-auto">
                        <div class="spinner-border text-dark" role="status" id="qr-spinner">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <img src="" alt="" id="qr-code" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-center">
                            <label for="" class="form-label">Room ID</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center mx-auto">
                            <input type="text" class="form-control text-center" id="room-id" disabled>
                        </div>
                    </div>
                </div>
            </div>
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

    function generateRoomID() {
        const num = '0123456789';
        let result = '';
        for (let i = 0; i < 6; i++) {
            result += num[Math.floor(Math.random() * num.length)];
        }
        return result;
    }

    function copyText(){
        var roomID = document.getElementById("room-id");
        roomID.select();
        // roomID.setSelectionRange(0, 99999);
        document.execCommand("copy");
    }

    function submitForm(e) {
        const form = document.getElementById(`edit-form-${e}`);
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'quiz_handler.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var data = response;
                if (data.response == "Success") {
                    window.location.href = 'dashboard.php?&message=' + encodeURIComponent(data.message);
                } else {
                    $('#liveToast').addClass('text-bg-danger');
                    $('#liveToast').find('.toast-body').html(data.message);
                    toastBootstrap.show();
                }
            }
        });
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

        // $('#edit-form').submit(function(e) {
        //     e.preventDefault();
        //     var formData = $(this).serializeArray();
        //     $.ajax({
        //         type: 'POST',
        //         url: 'quiz_handler.php',
        //         data: formData,
        //         success: function(response) {
        //             console.log(123,response)
        //             var data = response;
        //             if(data.response == "Success"){ 
        //                 window.location.href = 'dashboard.php?&message=' + encodeURIComponent(data.message);
        //             }else{
        //                 $('#liveToast').addClass('text-bg-danger');
        //                 $('#liveToast').find('.toast-body').html(data.message);
        //                 toastBootstrap.show();
        //             }
        //         }
        //     });
        // });

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

        function getUserIPAddress() {
            return new Promise((resolve, reject) => {
            const RTCPeerConnection = window.RTCPeerConnection || window.webkitRTCPeerConnection || window.mozRTCPeerConnection;

            if (RTCPeerConnection) {
            const rtc = new RTCPeerConnection({iceServers:[]});

            rtc.createDataChannel('test', {reliable:false});

            rtc.onicecandidate = function(evt) {
                if (evt.candidate) {
                resolve(evt.candidate.address);
                rtc.close();
                }
            };

            rtc.createOffer()
                .then(offerDesc => {
                rtc.setLocalDescription(offerDesc);
                })
                .catch(error => {
                reject(error);
                });
            } else {
            reject('WebRTC not supported');
            }
    });
        }

// call the function to get the IP address and log it
  
        $(".share").click(function() {
            let link;

            getUserIPAddress()
            .then(ipAddress => {
                var roomId = $(this).val();
                document.getElementById("room-id").value = roomId;
                console.log(123,ipAddress);
                $('#display').modal('show');
                var qrUrl = 'https://quickchart.io/qr?text=' + encodeURIComponent('http://'+ipAddress+'/FWDD-KON-QUIZ/quiz/quiz.php?room_id=' + roomId + '&login=');
                $('#qr-code').on('load', function() {
                    $('#qr-spinner').hide();
                    $('#qr-code').show();
                });
                $('#qr-code').attr('src', qrUrl)
            })
            .catch(error => console.error(error));

            // var roomId = $(this).val();
            // document.getElementById("room-id").value = roomId;
            // $('#display').modal('show');
            // var qrUrl = 'https://quickchart.io/qr?text=' + encodeURIComponent('http://'+link+'/FWDD-KON-QUIZ/quiz/quiz.php?room_id=' + roomId + '&login=');
            // $('#qr-code').on('load', function() {
            //     $('#qr-spinner').hide();
            //     $('#qr-code').show();
            // });
            // $('#qr-code').attr('src', qrUrl);
            // console.log(roomId);
        });
    });


</script>

<style>
    /* #modal-btn{
        background-color: #6E2BF2 !important;
        border-bottom: 5px solid #1c0052 !important;
        color: white !important;
    } */
    /* #edit-quiz-desc{
        height: 25vh;
        resize: none;
    } */
    
    /* #quiz-desc {
        height: 25vh;
        resize: none;
    } */

    /* .card{
        height: 25vh;
    } */

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
