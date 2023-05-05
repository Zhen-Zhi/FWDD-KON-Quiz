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
        console.log(question);
        console.log(question.length);
        let copyQues = [...question];
        console.log(copyQues);
        let currentQuestion = {};
        const opt = Array.from(document.getElementsByClassName("option"));

        function startQuiz() {
            nextQuestion(quesCounter);
        }

        function nextQuestion(index) {
            currentQuestion = copyQues[index];
            document.getElementById("q1").textContent = currentQuestion.ques;

            opt.forEach(option => {
                const optNo = option.dataset["opt"];
                option.innerText = currentQuestion['opt' + optNo];
            });
        }

        opt.forEach(option => {
            option.addEventListener("click", event => {
                quesCounter += 1;
                const selectedOption = event.target;
                const optNo = selectedOption.dataset['opt'];

                if (currentQuestion.correct_opt == ("opt" + optNo)) {
                    console.log("Answer correct: " + (marks += 10));
                }
                else {
                    console.log("Answer Incorrect: " + marks);
                }

                if (quesCounter < question.length) {
                    nextQuestion(quesCounter);
                }
                else {
                    alert("Quiz done!");
                }
            })
        });

        startQuiz();
    }
)