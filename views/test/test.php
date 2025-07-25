<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\bootstrap5\ActiveForm;
	$this->title = $test_name;
  $this->registerCssFile("@web/css/test.css");
?>
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