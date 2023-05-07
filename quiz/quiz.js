//get question first with promise
let fxPromise = new Promise(function (resolve, reject) {
    $.ajax({
        type: 'POST',
        url: 'get_ques.php',
        data: '',
        success: function(response) {
            var temp = JSON.parse(response);
            resolve(temp);
            reject("Error");
        },
    });
})

fxPromise.then(
    function(value) {
        let marks = 0;
        let question = value;
        let quesCounter = 0;
        let copyQues = [...question];
        let currentQuestion = {};
        let correctQues = 0;
        var quiz_id;
        var quiz_title;

        const opt = Array.from(document.getElementsByClassName("option"));

        const progressBar = document.querySelector('.progress-bar');

        let timer;

        function startTimer(){
            const timerEl = document.getElementById('timer');
        
            let seconds = 0;
            let minutes = 0;
        
            timer = setInterval(() => {
                seconds++;
        
                if (seconds < 10) {
                    seconds = `0${seconds}`;
                }
                if (seconds == 60) {
                    seconds = '00';
                    minutes++;
                }
        
                timerEl.textContent = `${minutes}:${seconds}`;
            }, 1000);
        }

        function stopTimer() {
            clearInterval(timer);
        }

        function updateProgressBar(e, i) {
            let progress = (e/i)*100;
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', progress);
        }

        function startQuiz() {
            nextQuestion(quesCounter);
            startTimer();
        }

        function nextQuestion(index) {
            let list = index;
            currentQuestion = copyQues[index];
            quiz_id = currentQuestion.qz_ID;
            quiz_title = currentQuestion.Title;
            document.getElementById("q1").textContent = list+1 + '. ' + currentQuestion.ques;

            opt.forEach(option => {
                const optNo = option.dataset["opt"];
                option.innerText  = currentQuestion['opt' + optNo];
            });
        }

        opt.forEach(option => {
            option.addEventListener("click", event => {
                quesCounter += 1;
                const selectedOption = event.target;
                const optNo = selectedOption.dataset['opt'];

                if (currentQuestion.correct_opt == ("opt" + optNo)) {
                    correctQues += 1;
                    marks += 10;
                    console.log("Answer correct: " + marks);
                    document.getElementById("score").textContent = marks;
                    document.getElementById("score").classList.add('changed');
                    setTimeout(() => {
                        document.getElementById("score").classList.remove('changed');
                    }, 200);
                }
                else {
                    console.log("Answer Incorrect: " + marks);
                }

                if (quesCounter < question.length) {
                    nextQuestion(quesCounter);
                    updateProgressBar(quesCounter, question.length);
                }
                else {
                    // alert("Quiz done!");
                    time_data = document.getElementById("timer").textContent;
                    $.ajax({
                        type: 'GET',
                        url: 'save_session.php',
                        data: {'score' : marks, 'correct_ques' : correctQues, 'tot_ques' : question.length, 'time' : time_data, 'quiz_title' : quiz_title, 'quiz_id' : quiz_id},
                        success: function(response) {      
                            const result_url = "result.php" +
                                "?score=" + marks +
                                "&correct_ques=" + correctQues +
                                "&tot_ques=" + question.length +
                                "&time=" + time_data +
                                "&quiz_title=" + quiz_title +
                                "&quiz_id=" + quiz_id;

                            stopTimer();
                            
                            window.location.href = result_url;
                        },
                    });

                }
            })
        });

        function setQuizTitle () {
            document.getElementById('quiz-title').textContent = quiz_title;
        }

        startQuiz();
        setQuizTitle();
    }
)