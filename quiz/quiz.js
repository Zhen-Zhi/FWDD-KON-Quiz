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
        // console.log(123,value)
        let marks = 0;
        let question = value;
        let quesCounter = 0;
        console.log(question);
        console.log(question.length);
        let copyQues = [...question];
        console.log(copyQues);
        let currentQuestion = {};
        let correctQues = 0;

        const opt = Array.from(document.getElementsByClassName("option"));

        const progressBar = document.querySelector('.progress-bar');

        function updateProgressBar(e, i) {
            let progress = (e/i)*100;
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', progress);
        }

        function startQuiz() {
            nextQuestion(quesCounter);
        }

        function nextQuestion(index) {
            let list = index;
            currentQuestion = copyQues[index];
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
                }
                else {
                    console.log("Answer Incorrect: " + marks);
                }

                if (quesCounter < question.length) {
                    nextQuestion(quesCounter);
                    updateProgressBar(quesCounter, question.length);
                }
                else {
                    alert("Quiz done!");
                    const result_url = "result.php" +
                        "?score=" + marks +
                        "&correct_ques=" + correctQues +
                        "&tot_ques=" + question.length;

                    window.location.href = result_url;
                }
            })
        });

        startQuiz();
    }
)