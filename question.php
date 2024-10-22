<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
    if($_POST["code"] == "") {
        echo "wrong access";
        return;
    }
    $code = $_POST["code"];
    $year = $_POST["year"];
?>
<body>
    <header>
        <img src="assets/daitm.jpeg" alt="" id="logo">
        <h2>Dinabandhu Andrews Institute of Technology & Management</h2>
        <a href="#">About</a>
    </header>
        <?php
            require "db.php";
            $sql = "SELECT question, questionId, subjects.subjectName FROM questions INNER JOIN subjects ON questions.subjectCode = subjects.subjectCode AND questions.questionYear = subjects.questionYear where subjects.subjectCode=\"$code\" and subjects.questionYear=\"$year\"";
            $result = $conn->query($sql);
            $subjectName = "";
            $html = "";
            foreach($result as $row) {
                $question = $row["question"];
                $subjectName = $row["subjectName"];
                $questionId = $row["questionId"];
                $sql = "select answer from answers where questionId=\"$questionId\"";
                $r = $conn->query($sql);
                $html = $html . "<div class=\"question-dropdown\">
                    <h2 class=\"question\">$question</h2>
                    <img src=\"assets/down-arrow.svg\" alt=\"\" class=\"icon\">";
                foreach($r as $v) {
                    $ans = $v["answer"];
                    $html = $html . "<div class=\"answer\">$ans</div></div>";
                }
            }
            echo "<h2 id=\"subject-name\">$subjectName</h2>
            <section id=\"question-container\">" .
            $html .
        "</section>";
        ?>
</body>
<script>
    let icons = document.querySelectorAll(".icon")
    icons.forEach(icon => {
        icon.addEventListener("click", e => {
            e.target.classList.toggle("active-icon")
            e.target.parentNode.childNodes[4].classList.toggle("active-answer")
        })
    })
</script>
</html>