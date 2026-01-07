<?php
 
$correct_answers = [
    'q1' => 'PHP: Hypertext Preprocessor',
    'q2' => '$_POST',
    'q3' => '.php',
    'q4' => 'echo',
    'q5' => 'mySQL'
];

$score = 0;
$results = [];
$feedback = "";
$submitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;
    
  
    foreach ($correct_answers as $key => $correct_val) {
        $user_answer = $_POST[$key] ?? 'Not answered';
        if ($user_answer === $correct_val) {
            $score++;
            $results[$key] = "Correct";
        } else {
            $results[$key] = "Incorrect (Correct: $correct_val)";
        }
    }

    $percentage = ($score / count($correct_answers)) * 100;

    
    switch (true) {
        case ($percentage >= 90): $feedback = "Excellent"; break;
        case ($percentage >= 70): $feedback = "Good"; break;
        case ($percentage >= 50): $feedback = "Average"; break;
        default: $feedback = "Poor"; break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Web Tech Quiz</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background: #f4f4f4; }
        .quiz-container { background: white; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto; }
        .result-box { padding: 15px; margin-bottom: 20px; border-radius: 5px; background: #eef; }
        .correct { color: green; } .incorrect { color: red; }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h2>Web Technologies Quiz</h2>

        <?php if ($submitted): ?>
            <div class="result-box">
                <h3>Result: <?php echo $score; ?>/5 (<?php echo $percentage; ?>%)</h3>
                <p>Feedback: <strong><?php echo $feedback; ?></strong></p>
            </div>
        <?php endif; ?>

        <form method="POST">
            <p>1. What does PHP stand for?</p>
            <input type="radio" name="q1" value="PHP: Hypertext Preprocessor" <?php if(isset($_POST['q1']) && $_POST['q1'] == 'PHP: Hypertext Preprocessor') echo 'checked'; ?>> PHP: Hypertext Preprocessor<br>
            <input type="radio" name="q1" value="Private Home Page" <?php if(isset($_POST['q1']) && $_POST['q1'] == 'Private Home Page') echo 'checked'; ?>> Private Home Page<br>
            <?php if($submitted) echo "<span class='".($results['q1']=="Correct"?'correct':'incorrect')."'>".$results['q1']."</span>"; ?>

            <p>2. Which superglobal is used to collect form data after submitting an HTML form with method="post"?</p>
            <input type="radio" name="q2" value="$_GET" <?php if(isset($_POST['q2']) && $_POST['q2'] == '$_GET') echo 'checked'; ?>> $_GET<br>
            <input type="radio" name="q2" value="$_POST" <?php if(isset($_POST['q2']) && $_POST['q2'] == '$_POST') echo 'checked'; ?>> $_POST<br>
            <?php if($submitted) echo "<span class='".($results['q2']=="Correct"?'correct':'incorrect')."'>".$results['q2']."</span>"; ?>

            <p>3. PHP server scripts are surrounded by which file extension?</p>
            <input type="radio" name="q3" value=".php" <?php if(isset($_POST['q3']) && $_POST['q3'] == '.php') echo 'checked'; ?>> .php<br>
            <input type="radio" name="q3" value=".html" <?php if(isset($_POST['q3']) && $_POST['q3'] == '.html') echo 'checked'; ?>> .html<br>
            <?php if($submitted) echo "<span class='".($results['q3']=="Correct"?'correct':'incorrect')."'>".$results['q3']."</span>"; ?>

            <p>4. How do you write "Hello World" in PHP?</p>
            <input type="radio" name="q4" value="echo" <?php if(isset($_POST['q4']) && $_POST['q4'] == 'echo') echo 'checked'; ?>> echo "Hello World";<br>
            <input type="radio" name="q4" value="print" <?php if(isset($_POST['q4']) && $_POST['q4'] == 'print') echo 'checked'; ?>> Document.Write("Hello World");<br>
            <?php if($submitted) echo "<span class='".($results['q4']=="Correct"?'correct':'incorrect')."'>".$results['q4']."</span>"; ?>

            <p>5. Which database engine is most commonly used with PHP?</p>
            <input type="radio" name="q5" value="mySQL" <?php if(isset($_POST['q5']) && $_POST['q5'] == 'mySQL') echo 'checked'; ?>> MySQL<br>
            <input type="radio" name="q5" value="Oracle" <?php if(isset($_POST['q5']) && $_POST['q5'] == 'Oracle') echo 'checked'; ?>> Oracle<br>
            <?php if($submitted) echo "<span class='".($results['q5']=="Correct"?'correct':'incorrect')."'>".$results['q5']."</span>"; ?>

            <br><br>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>
</body>
</html>