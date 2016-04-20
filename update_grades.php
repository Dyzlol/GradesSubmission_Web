<?php
    require_once("person.php");
    session_start();

    // vars
    $students = $_SESSION["students"];
    $index = 0;

    // loop through and set grades
    while ($index < count($students)){
      $student = unserialize($students[$index]);
      $tempStr = "grade".$student->getLastName()."_".$student->getFirstName();
      $student->setGrade($_POST[$tempStr]); // set grade
      $skey = array_search($students[$index], $students); // get key
      $_SESSION["students"][$skey] = serialize($student); // serialize so we dont lose it
      $index += 1;
    }

    // More HTML
    print <<<END
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
            <title>Submission</title>
        </head>
        <body>
            <h1>Grades to Submit</h1><br/>
            <form action="success.php" method="post">
                <input type="submit" name="submit" value="Submit Grades"/>
            </form>
            <form action="submit_grades.php" method="post">
                <input type="submit" name="back" value="Back"/>
            </form>

        </body>
    </html>
END;



?>
