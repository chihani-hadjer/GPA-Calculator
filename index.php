<?php

$result = "";
$table = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $courses = $_POST['course'];
    $credits = $_POST['credits'];
    $grades = $_POST['grade'];

    $totalPoints = 0;
    $totalCredits = 0;

    $table .= "<table border='1'>
    <tr>
    <th>Course</th>
    <th>Credits</th>
    <th>Grade</th>
    <th>Points</th>
    </tr>";

    for ($i = 0; $i < count($courses); $i++) {

        $cr = floatval($credits[$i]);
        $gr = floatval($grades[$i]);

        if ($cr <= 0) continue;

        $points = $cr * $gr;

        $totalPoints += $points;
        $totalCredits += $cr;

        $table .= "<tr>
        <td>{$courses[$i]}</td>
        <td>$cr</td>
        <td>$gr</td>
        <td>$points</td>
        </tr>";
    }

    $table .= "</table>";

    if ($totalCredits > 0) {
        $gpa = $totalPoints / $totalCredits;

        if ($gpa >= 3.7) $mention = "Distinction";
        elseif ($gpa >= 3.0) $mention = "Merit";
        elseif ($gpa >= 2.0) $mention = "Pass";
        else $mention = "Fail";

        $result = "Your GPA is " . round($gpa,2) . " ($mention)";
    } else {
        $result = "No valid data";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>GPA Calculator</title>
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
</head>

<body>

<h1>GPA Calculator</h1>


<?php if ($result != ""): ?>
    <?php echo $table; ?>
    <h3><?php echo $result; ?></h3>
<?php endif; ?>


<form method="post" onsubmit="return validateForm();">

<div id="courses">

<div class="course-row">
<input type="text" name="course[]" placeholder="Course" required>
<input type="number" name="credits[]" placeholder="Credits" min="1" required>

<select name="grade[]">
<option value="4.0">A</option>
<option value="3.0">B</option>
<option value="2.0">C</option>
<option value="1.0">D</option>
<option value="0.0">F</option>
</select>

</div>

</div>

<button type="button" onclick="addCourse()">+ Add Course</button>
<br><br>

<input type="submit" value="Calculate GPA">

</form>

</body>
</html>
