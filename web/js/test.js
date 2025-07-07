if (document.URL != "http://localhost/quiz-school-demo/main/index" && document.URL != "http://localhost/quiz-school-demo/" && document.URL != "http://localhost/quiz-school-demo/users/select" && document.URL != "http://localhost/quiz-school-demo/main/about") {
  function testbegin() {
      const start = 40;
      let time = start * 60;
  
      const countDown = document.getElementById("time");
  
      setInterval(updateCountdown, 1000);
  
      function updateCountdown() {
        const minutes = Math.floor(time / 60);
        let seconds = time % 60;
  
        seconds = seconds < 10 ? '0' + seconds : seconds;
  
        countDown.innerHTML = `${minutes}:${seconds}`;
        if (time == 0) {
          res = "<img style='text-align: center;' src='https://miro.medium.com/v2/resize:fit:1400/1*CsJ05WEGfunYMLGfsT2sXA.gif'><h3>Iltimos kutib turing! Ma'lumotlar yuborilmoqda</h3>";
          $('#content').html(res);
          var score = displayScore();
          if (score == "") {
            $.ajax({
                url: "/quiz-school-demo/test/emptyendtime",
                type: "GET",
                data: "question_id=" + question_id + "&endtime=" + 1,
                success: function(res) {
                  alert(res);
                  if (!res) {
                      alert("Xatolik yuz berdi! Birozdan so'ng qayta urinib ko'ring");
                      window.location.href = "http://localhost:8080/quiz-school-demo/main/index";  
                  }
                  $('#content').html(res);
                }
            })
          } else {
              $.ajax({
                url: "/quiz-school-demo/test/endtime",
                type: "GET",
                data: "selected=" + score + "&question_id=" + question_id + "&endtime=" + 1,
                success: function(res) {
                  // if (!res) {
                  //     alert("Xatolik yuz berdi! Birozdan so'ng qayta urinib ko'ring");
                  //     window.location.href = "http://localhost:8080/quiz-school-demo/main/index";  
                  // }
                  $('#content').html(res);
                }
              })
          }
        } 
        time--;
      }
  }

  testbegin();
}

$('#a_input').click(function(){
	$('#b').addClass("alert-dark");
	$('#c').addClass("alert-dark");
	$('#d').addClass("alert-dark");
	$('#a').removeClass("alert-dark");
	$('#a').addClass("alert-primary");
})
$('#b_input').click(function(){
	$('#a').addClass("alert-dark");
	$('#c').addClass("alert-dark");
	$('#d').addClass("alert-dark");
	$('#b').removeClass("alert-dark");
	$('#b').addClass("alert-primary");
})
$('#c_input').click(function(){
	$('#a').addClass("alert-dark");
	$('#b').addClass("alert-dark");
	$('#d').addClass("alert-dark");
	$('#c').removeClass("alert-dark");
	$('#c').addClass("alert-primary");
})
$('#d_input').click(function(){
	$('#a').addClass("alert-dark");
	$('#b').addClass("alert-dark");
	$('#c').addClass("alert-dark");
	$('#d').removeClass("alert-dark");
	$('#d').addClass("alert-primary");
})
// var questions = [{
//     question: "What is 2*5?",
//     choices: [2, 5, 10, 15],
//     correctAnswer: 2
//   }, {
//     question: "What is 3*6?",
//     choices: [3, 6, 9, 18],
//     correctAnswer: 4
//   }, {
//     question: "What is 8*9?",
//     choices: [72, 99, 108, 134],
//     correctAnswer: 0
//   }, {
//     question: "What is 1*7?",
//     choices: [4, 5, 6, 7],
//     correctAnswer: 3
//   }, {
//     question: "What is 8*8?",
//     choices: [20, 30, 40, 50],
//     correctAnswer: 4
//   }];
  
  var questionCounter = 0; //Tracks question number
  var selections = []; //Array containing user choices
  var quiz = $('#quiz'); //Quiz div object
  
  // Display initial question
  displayNext();
  
  // Click handler for the 'next' button
  $('#next').on('click', function (e) {
    e.preventDefault();
    
    // Suspend click listener during fade animation
    if(quiz.is(':animated')) {        
      return false;
    }
    choose();
    
    // If no user selection, progress is stopped
    if (isNaN(selections[questionCounter])) {
      alert('Javobni belgilang');
    } else {
 	  questionCounter++;
      let id = '#' + questionCounter;
      $(id).addClass("selected");
      displayNext();
    }
  });
  
  // Click handler for the 'prev' button
  $('#prev').on('click', function (e) {
    e.preventDefault();
    
    if(quiz.is(':animated')) {
      return false;
    }
    choose();
    questionCounter--;
    displayNext();
  });
  
  // Click handler for the 'Start Over' button
  $('#start').on('click', function (e) {
    e.preventDefault();
    
    if(quiz.is(':animated')) {
      return false;
    }
    questionCounter = 0;
    selections = [];
    displayNext();
    $('#start').hide();
  });
  
  // Creates and returns the div that contains the questions and 
  // the answer selections
  function createQuestionElement(index) {
    var qElement = $('<div>', {
      id: 'question'
    });
    
    var header = $('<h2>' + (index + 1) + '-savol:</h2>');
    qElement.append(header);
    
    var question = $("<p style='font-size: 20px;'>").append(questions[index].question);
    qElement.append(question);
    
    var radioButtons = createRadios(index);
    qElement.append(radioButtons);
    
    return qElement;
  }
  
  // Creates a list of the answer choices as radio inputs
  function createRadios(index) {
    var radioList = $('<ul>');
    var item;
    var input = '';
    for (var i = 0; i < questions[index].choices.length; i++) {
      item = $('<div class="alert alert-dark">');
      input = '<input type="radio" name="answer" value=' + i + ' /></div>';
      input += questions[index].choices[i];
      item.append(input);
      radioList.append(item);
    }
    return radioList;
  }
  
  // Reads the user selection and pushes the value to an array
  function choose() {
    selections[questionCounter] = +$('input[name="answer"]:checked').val();
  }
  
  // Displays next requested element
  function displayNext() {
    quiz.fadeOut(function() {
      $('#question').remove();
      
      if(questionCounter < questions.length){
        var nextQuestion = createQuestionElement(questionCounter);
        quiz.append(nextQuestion).fadeIn();
        if (!(isNaN(selections[questionCounter]))) {
          $('input[value='+selections[questionCounter]+']').prop('checked', true);
        }
        
        // Controls display of 'prev' button
        if(questionCounter === 1){
          $('#prev').show();
        } else if(questionCounter === 0){
          
          $('#prev').hide();
          $('#next').show();
        }
      }else {
        res = "<img style='text-align: center;' src='https://miro.medium.com/v2/resize:fit:1400/1*CsJ05WEGfunYMLGfsT2sXA.gif'><h3>Iltimos kutib turing! Ma'lumotlar yuborilmoqda</h3>";
        $('#content').html(res);
        var scoreElem = displayScore();
       	$.ajax({
       		url: "/quiz-school-demo/test/endtest",
       		type: "GET",
       		data: "selected=" + scoreElem + "&question_id=" + question_id,
       		success: function(res) {
       			if (!res) return false;
       			// alert(res);
       			$('#content').html(res);
       		}
       	})
        // quiz.append(scoreElem).fadeIn();
        // $('#next').hide();
        // $('#prev').hide();
      }
    });
  }
  
  // Computes score and returns a paragraph element to be displayed
  function displayScore() {
    return selections;
  }