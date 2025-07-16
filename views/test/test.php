<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\bootstrap5\ActiveForm;
	$this->title = $test_name;
?><style>
    * { box-sizing: border-box; }
    body, html {
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      background: #f4f6fa;
    }
    .quiz-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      gap: 40px;
      padding: 20px;
    }
    .quiz-form {
      flex: 1;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      max-height: 90vh;
      overflow-y: auto;
    }
    .question {
      margin-bottom: 30px;
    }
    .question h3 {
      margin-bottom: 10px;
    }
    .options div {
      margin-bottom: 10px;
    }
    .options input[type="radio"] {
      display: none;
    }
    .options .form-check-label {
      display: block;
      padding: 12px 16px;
      background-color: #f7f9fc;
      border: 2px solid #dce3ea;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s ease-in-out;
      font-weight: 500;
    }
    .options input[type="radio"]:checked + .form-check-label {
      background-color: #e0f7fa;
      border-color: #00acc1;
      color: #006064;
    }
    .options .form-check-label:hover {
      background-color: #e3f2fd;
      border-color: #90caf9;
    }
    .sidebar {
      width: 200px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      position: sticky;
      top: 20px;
      align-self: flex-start;
    }
    .timer-bar {
      background: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      font-size: 20px;
      font-weight: bold;
      text-align: center;
      color: #d32f2f;
    }
    #timer {
      font-size: 26px;
      margin-top: 5px;
      display: block;
    }
    .question-nav {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 10px;
    }
    .question-btn {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #e0e0e0;
      text-align: center;
      line-height: 40px;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }
    .question-btn.answered {
      background: #4caf50;
      color: white;
    }

    @media (max-width: 768px) {
      body {
        padding-top: 60px;
      }
      .quiz-container {
        flex-direction: column;
        padding: 10px;
      }
      .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        flex-direction: row;
        justify-content: center;
        gap: 20px;
        padding: 10px;
        background: white;
        z-index: 1000;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      }
      .question-nav {
        display: none;
      }
      .timer-bar {
        font-size: 18px;
        padding: 10px;
        border-radius: 0;
        box-shadow: none;
        background: none;
      }
      #timer {
        font-size: 20px;
      }
    }
  </style>
  <div class="quiz-container" style="margin-top: 100px;">
    <?php $f = ActiveForm::begin([
    	"class" => "quiz-form",
    	"id" => "quizForm"
    ]); ?>
    	<?php for ($i = $start; $i < count($rows); $i++): ?>
	    	<?php
	    		$question_num = $rows[$i][0];
	    		$question = $rows[$i][1];
	    		$variant_A = $rows[$i][3];
	    		$variant_B = $rows[$i][4];
	    		$variant_C = $rows[$i][5];
	    		$variant_D = $rows[$i][6];
	    	?>
	    	<div class="question" id="question-<?=$question_num?>">
		    	<h3><?=$question_num?>. <?=$question?></h3>
		    	<div class="options">
		    		<?= $f->field($model, "answers[$question_num]")->radioList([
		    			"A" => "A) $variant_A",
		    			"B" => "B) $variant_B",
		    			"C" => "C) $variant_C",
		    			"D" => "D) $variant_D"
		    		])->label(false); ?>
		    	</div>
			</div>
    	<?php endfor; ?>
    <?php ActiveForm::end(); ?>
    <div class="sidebar">
      <div class="timer-bar">
        Qolgan vaqt: <span id="timer">30:00</span>
        <button class="btn btn-primary" onclick="submitData()">Testni tugatish</button>
      </div>
      <div class="question-nav" id="questionNav"></div>
    </div>
  </div>

<script>
	function submitData() {
	  document.getElementById('quizForm').submit();
	}
   document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('quizForm');
    const modelName = 'UserAnswers';
    const nav = document.getElementById('questionNav');
    const totalQuestions = <?=$count_tests?>;

    // === Test raqamlari navigatsiyasini yaratish ===
    for (let i = 1; i <= totalQuestions; i++) {
	  const btn = document.createElement('button');
	  btn.className = 'question-btn';
	  btn.type = 'button';
	  btn.textContent = i;

	  btn.addEventListener('click', () => {
	    const target = document.getElementById('question-' + i);
	    if (target) {
	      // header balandligi yoki ofset (masalan: 100px)
	      const offset = 100;
	      const y = target.getBoundingClientRect().top + window.scrollY - offset;
	      window.scrollTo({ top: y, behavior: 'smooth' });
	    }
	  });

	  nav.appendChild(btn);
	}


    // === Radio tanlanganda localStorage ga saqlash va button rangini o‘zgartirish ===
    form.addEventListener('change', (e) => {
      const input = e.target;
      if (!input || input.tagName !== 'INPUT' || input.type !== 'radio') return;

      const match = input.name.match(/UserAnswers\[answers\]\[(\d+)\]/);
      if (!match) return;

      const qNum = parseInt(match[1]);
      localStorage.setItem(input.name, input.value);

      const btn = document.querySelectorAll('.question-btn')[qNum - 1];
      if (btn) btn.classList.add('answered');
    });

    // === Sahifa yuklanganda tanlangan javoblarni tiklash ===
    for (let i = 1; i <= totalQuestions; i++) {
      const name = `UserAnswers[answers][${i}]`;
      const saved = localStorage.getItem(name);
      if (saved) {
        const input = document.querySelector(`input[name='${name}'][value='${saved}']`);
        if (input) input.checked = true;

        const btn = document.querySelectorAll('.question-btn')[i - 1];
        if (btn) btn.classList.add('answered');
      }
    }

    // === Timer ===
    const timerEl = document.getElementById('timer');
    const TIMER_KEY = 'quiz_timer_seconds';
    let timeLeft = parseInt(localStorage.getItem(TIMER_KEY));
    if (isNaN(timeLeft) || timeLeft <= 0) timeLeft = <?=$timer?> * 60;

    function updateTimer() {
      const mins = String(Math.floor(timeLeft / 60)).padStart(2, '0');
      const secs = String(timeLeft % 60).padStart(2, '0');
      timerEl.textContent = `${mins}:${secs}`;

      if (timeLeft > 0) {
        timeLeft--;
        localStorage.setItem(TIMER_KEY, timeLeft);
      } else {
        localStorage.removeItem(TIMER_KEY);
        alert("Vaqt tugadi!");
        submitData();
      }
    }

    updateTimer();
    setInterval(updateTimer, 1000);
  });
</script>