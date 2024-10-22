<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="assets/daitm.jpeg" alt="" id="logo">
        <h2>Dinabandhu Andrews Institute of Technology & Management</h2>
        <a href="#">About</a>
    </header>
    <section id="subjects-container">
        <!-- <div class="subject-dropdown">
            <h2 class="subject-name">Software Engineering</h2>
            <img src="assets/down-arrow.svg" alt="" class="icon">
            <div class="subject-year-container">
                <h3>2020</h3>
                <h3>2020</h3>
                <h3>2020</h3>
                <h3>2020</h3>
                <h3>2020</h3>
            </div>
        </div> -->
        <?php
            require "db.php";
            $sql = "select subjectName from subjects group by subjectName";
            $result = $conn->query($sql);
            foreach ($result as $row) {
                $subjectName = $row["subjectName"];
                $sql = "select questionYear, subjectCode from subjects where subjectName=\"$subjectName\"";
                $r = $conn->query($sql);
                $html = "<div class=\"subject-dropdown\">
                <h2 class=\"subject-name\">$subjectName</h2>
                <img src=\"assets/down-arrow.svg\" alt=\"\" class=\"icon\">
                <div class=\"subject-year-container\">";
                echo $html;
                foreach($r as $v) {
                    $year = $v["questionYear"];
                    $code = $v["subjectCode"];
                    echo "<h3 code=\"$code-$year\" onclick=\"submitData(this)\">$year</h3>";
                }
                echo "</div>
                </div>";
            }
        ?>
    </section>
</body>
<script>
    function submitData(e) {
        const data = e.getAttribute("code").split("-")
        const form = document.createElement("form")
        form.method = "post"
        form.action = "question.php"
        const codeInput = document.createElement("input")
        codeInput.value = data[0]
        codeInput.type = "hidden"
        codeInput.name = "code"
        const yearInput = document.createElement("input")
        yearInput.type = "hidden"
        yearInput.value = data[1]
        yearInput.name = "year"
        form.appendChild(codeInput)
        form.appendChild(yearInput)
        document.body.appendChild(form)
        form.submit()
    }
    let icons = document.querySelectorAll(".icon")
    icons.forEach(icon => {
        icon.addEventListener("click", e => {
            e.target.classList.toggle("active-icon")
            e.target.parentNode.childNodes[5].classList.toggle("active-subject-year-container")
        })
    })
</script>
</html>