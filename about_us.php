<head>
    <title>KON Quiz - About_us</title>
</head>

<?php 
    include("session.php");
?>


<div class="container-fluid pt-5 mt-2 px-5">
    <div class="row mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </nav>
    </div>
</div>


<div class="container-fluid pt-2 mt-2 px-5">
    <div class="row">
        <div class="col-md-6 mt-1">
            <div class="card h-100 border-0 shadow">
                <div class="card-body" style="text-align: center;">
                    <h2 class="card-title fs-1 pt-3 mb-4 px-5 text-primary" style="font-weight: bold; color: 2F3C7E !important">About Us</h2>
                        <div class="card-text">
                            <div class="row pt-3 px-5">
                                <p class="fs-5">
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
                </div>
            </div>
        </div> 

        <div class="col-md-6 mt-1">
            <div class="card h-100 border-0 shadow" style="background-color: 2F3C7E">
                <div class="card-body" style="text-align: center;">
                    <h2 class="card-title fs-1 pt-3 mb-4 px-5" style=" color: white !important">Contact Us</h2>
                        <div class="card-text">
                            <form action="">
                                <div class="row pt-3 px-5">
                                    <div class="row px-5">
                                        <textarea class="form-control" placeholder="Enter your feedback here" style="height: 17vh; resize: none;"></textarea>
                                    </div>
                                    <div class="row px-5">
                                        <button class="btn home-btn" type="submit" name="">
                                            Submit
                                        </button>
                                        <p class="fs-6 pt-3 fst-italic" style="color: white !important">
                                            Please do not hesitate to reach out to us at konquiz@gmail.com
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid mt-5 pt-5 px-5">
    <div class="row d-flex align-items-center justify-content-center">
        <h2 class="card-title fs-1 pb-3 pt-3 mb-4 px-5" style="text-align: center; font-weight: bold; color: black !important">Frequently Asked Questions (FAQ)</h2>
            <div class="card h-100 border-0 shadow" style="width: 90vh">
                <div class="row px-5 mx-5">
                    <p class="fs-5 my-3 pt-4 px-4">
                        <p class="fw-bold">Q: How can I begin playing quizzes on this website?</p>
                        <p>A: To get started with playing quizzes on our website, you'll need to create an account and log in. Once you're logged in, you can browse our selection of quizzes and click on the one you want to play. Follow the instructions provided on the quiz page to begin playing.</p>
                        <p></p>
                        <p></p>
                        <p class="fw-bold">Q: Is there a fee for playing quizzes on this website?</p>
                        <p>A: No, all of the quizzes on our website are completely free to play.</p>
                        <p></p>
                        <p></p>
                        <p class="fw-bold">Q: Can I create my own quiz to share with others?
                        <p>A: Yes, we welcome user-generated content and encourage our users to create their own quizzes. To create a quiz, simply click on the "Create Quiz" button on the homepage and follow the instructions.</p>
                        <p></p>
                        <p></p>
                        <p class="fw-bold">Q: Can I access quizzes on this website from my mobile device?</p>
                        <p>A: Yes, our website is mobile-friendly and you can play quizzes on your phone or tablet.</p>
                        <p></p>
                        <p></p>
                        <p class="fw-bold">Q: What should I do if I come across a question that I cannot answer?</p>
                        <p>A: If you encounter a question that you're unsure of, you can skip it and move on to the next one, or use a hint (if one is available). However, keep in mind that using a hint may result in a deduction of points.</p>
                        <p></p>
                        <p></p>
                        <p class="fw-bold">Q: How can I earn points on this website?</p>
                        <p>A: You can earn points by playing quizzes and answering questions correctly. The more questions you answer correctly, the more points you'll earn.</p>
                        <p></p>
                        <p></p>
                        <p class="fw-bold">Q: How can I keep track of my progress on this website?</p>
                        <p>A: You can track your progress by checking your profile page. Your profile will display the number of quizzes you've played, how many questions you've answered correctly, and your total points.</p>
                        <p></p>
                        <p></p>
                        <p class="fw-bold">Q: What should I do if I encounter a problem with the website?</p>
                        <p>A: If you experience any issues with the website, you can contact our customer support team by using the "Contact Us" form on our website. We'll do our best to respond to your inquiry as soon as possible.</p>
                    </p>
                </div>
            </div>
    </div>
</div>

<?php 
    include("footer.php"); 
?>

