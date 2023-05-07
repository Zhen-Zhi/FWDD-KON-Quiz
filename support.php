<?php 
    include("session.php");
?>

<head>
    <title>KON Quiz - Support</title>
</head>

<div class="container px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Support</a>
        </li>
    </ul>
    <div class="shadow p-5">
        <div class="row">
            <div class="col">
                <h3 class="fw-bold text-center">About Us</h3>
                <p>
                    Welcome to our quiz website for learning! We are a team of passionate 
                    educators and technology enthusiasts who believe that learning should 
                    be fun, interactive, and accessible to everyone. 
                    Our mission is to create an engaging learning experience for students of all ages and levels. <br></br>
                    At our core, we are committed to making learning accessible to everyone. 
                    Thank you for visiting our quiz website for learning. 
                    We hope that you find our quizzes and resources helpful in your learning journey. 
                    If you have any questions or feedback, please don't hesitate to reach out to us.
                </p>
            </div> 
        </div>
        <div class="row mt-4">
            <div class="col">
                <h3 class="fw-bold text-center">Frequently Asked Questions (FAQ)</h3>

                <a class="text-decoration-none" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    How can I begin playing quizzes on this website?
                </a>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                    To get started with playing quizzes on our website, you'll need to create an account and log in. Once you're logged in, you can browse our selection of quizzes and click on the one you want to play. Follow the instructions provided on the quiz page to begin playing.
                    </div>
                </div>
                <!-- <p class="fw-bold">Q: How can I begin playing quizzes on this website?</p>
                <p>A: To get started with playing quizzes on our website, you'll need to create an account and log in. Once you're logged in, you can browse our selection of quizzes and click on the one you want to play. Follow the instructions provided on the quiz page to begin playing.</p>
                <p class="fw-bold">Q: Is there a fee for playing quizzes on this website?</p>
                <p>A: No, all of the quizzes on our website are completely free to play.</p>
                <p class="fw-bold">Q: Can I create my own quiz to share with others?
                <p>A: Yes, we welcome user-generated content and encourage our users to create their own quizzes. To create a quiz, simply click on the "Create Quiz" button on the homepage and follow the instructions.</p>
                <p class="fw-bold">Q: Can I access quizzes on this website from my mobile device?</p>
                <p>A: Yes, our website is mobile-friendly and you can play quizzes on your phone or tablet.</p>
                <p class="fw-bold">Q: What should I do if I come across a question that I cannot answer?</p>
                <p>A: If you encounter a question that you're unsure of, you can skip it and move on to the next one, or use a hint (if one is available). However, keep in mind that using a hint may result in a deduction of points.</p>
                <p class="fw-bold">Q: How can I earn points on this website?</p>
                <p>A: You can earn points by playing quizzes and answering questions correctly. The more questions you answer correctly, the more points you'll earn.</p>
                <p class="fw-bold">Q: How can I keep track of my progress on this website?</p>
                <p>A: You can track your progress by checking your profile page. Your profile will display the number of quizzes you've played, how many questions you've answered correctly, and your total points.</p>
                <p class="fw-bold">Q: What should I do if I encounter a problem with the website?</p>
                <p>A: If you experience any issues with the website, you can contact our customer support team by using the "Contact Us" form on our website. We'll do our best to respond to your inquiry as soon as possible.</p> -->
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
            <a class="text-decoration-none" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Is there a fee for playing quizzes on this website?
                </a>
                <div class="collapse" id="collapseExample1">
                    <div class="card card-body">
                        No, all of the quizzes on our website are completely free to play.
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <a class="text-decoration-none" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Can I create my own quiz to share with others?
                </a>
                <div class="collapse" id="collapseExample2">
                    <div class="card card-body">
                        Yes, we welcome user-generated content and encourage our users to create their own quizzes. To create a quiz, simply click on the "Create Quiz" button on the homepage and follow the instructions.
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col text-center">
                <h3 class="fw-bold text-center">Contact Us</h3>
                <textarea class="form-control" placeholder="Enter your feedback here" style="height: 17vh; resize: none;"></textarea>
                <p class="fst-italic">
                    Please do not hesitate to reach out to us at konquiz@gmail.com
                </p>
                <button class="btn btn-primary" type="submit" name="">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>

<?php 
    // include("/template/footer.php"); 
?>

