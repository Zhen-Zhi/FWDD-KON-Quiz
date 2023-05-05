<?php 
    include("../session.php");
    include("../conn.php");
    $_SESSION['room_id'] = $_POST['room_id'];
?>
<head>
    <title>KON Quiz - Quiz</title>
</head>

<div class="container text-center">
    <i class="bi bi-stopwatch-fill fs-3"><div class="fs-3" id="timer">0:00</div></i>
</div>

<div class="container">
    Your Progress:
    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar" style="width: 1%"></div>
    </div>
</div>

<div class="container mt-5">
    <div class="card border-0 shadow">
        <h5 class="card-header text-bg-dark px-5 p-3" id="q1">
            Question title
        </h5>
        <form class="card-body p-5">
            <div class="row mb-4">
                <div class="col text-center">
                    <button type="button" class="btn h-100 btn-secondary w-100 option p-2" data-opt="1">Option 1</button>
                </div>
                <div class="col text-center">
                    <button type="button" class="btn h-100 btn-secondary w-100 option p-2" data-opt="2">Option 2</button>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <button type="button" class="btn h-100 btn-secondary w-100 option p-2" data-opt="3">Option 3</button>
                </div>
                <div class="col text-center">
                    <button type="button" class="btn h-100 btn-secondary w-100 option p-2" data-opt="4">Option 4</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- <div class="container">
    <img src="../img/dart_monkey.png" alt="">
</div> -->

<script src="quiz.js"></script>

<style>
    .option {
        transition: all 0.3s ease-in-out;
    }
    
</style>

