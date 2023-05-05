<!DOCTYPE html>
<?php 
    include("../session.php");
    include("../conn.php");
?>
<html>
    <head>
        <title>KON Quiz - Quiz</title>
    </head>
    
    <body>
        <div class="container shadow">
            <div class="">
                <h3 id="q1">Question title</h3>
            </div>
            <form>
                <div class="row">
                    <div class="col">
                        <div class="form-control shadow m-1 option-container">
                            <button type="button" class="btn option p-2" data-opt="1">Option 1</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-control shadow m-1 option-container">
                            <button type="button" class="btn option p-2" data-opt="2">Option 1</button>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="form-control shadow m-1 option-container">
                            <button type="button" class="btn option p-2" data-opt="3">Option 1</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-control shadow m-1 option-container">
                            <button type="button" class="btn option p-2" data-opt="4">Option 1</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script src="quiz.js"></script>
    </body>
</html>

<style>
    .option-container {
        display: flex;
        background-color: #d9dbff;
    }

    .option {
        width: 100%;
    }
</style>

