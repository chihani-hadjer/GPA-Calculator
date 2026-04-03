<?php

$courses = $_POST['course'];
$credits = $_POST['credits'];
$grades = $_POST['grade'];

$totalPoints = 0;
$totalCredits = 0;

echo "<h2>Results</h2>";
echo "<table border='1'>
<tr>
<th>Course</th>
<th>Credits</th>
<th>Grade</th>
<th>Points</th>
</tr>";

for ($i = 0; $i < count($courses); $i++) {

    $cr = floatval($credits[$i]);
    $gr = floatval($grades[$i]);

    $points = $cr * $gr;

    $totalPoints += $points;
    $totalCredits += $cr;

    echo "<tr>
    <td>{$courses[$i]}</td>
    <td>$cr</td>
    <td>$gr</td>
    <td>$points</td>
    </tr>";
}

echo "</table>";

$gpa = $totalPoints / $totalCredits;

echo "<h3>Your GPA: " . round($gpa,2) . "</h3>";

if ($gpa >= 3.7) echo "Distinction";
elseif ($gpa >= 3.0) echo "Merit";
elseif ($gpa >= 2.0) echo "Pass";
else echo "Fail";

?>
