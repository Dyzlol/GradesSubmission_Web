<?php

    // vars
    session_start();
    $course = "";
    $section = "";
    $sess_id = session_id();

    // check if submit pressed and fill in values and call next page
    if(!empty($_POST["submit"])){
        $course = trim($_POST["course"]);
        $section = trim($_POST["section"]);
        $_SESSION["filename"] = $course.$section.".txt";
        header("Location: submit_grades.php");
    }

    // HTML COde for self referencing page
    print <<<END
          <!doctype html>
            <html>
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
                <title>Section Information</title>
              </head>
              <body>
                <h1>Grades Submission System</h1>
                <form action="{$_SERVER["PHP_SELF"]}" method="post"/>
                <p>
                  <strong>Course Name (e.g., cmsc128):</strong>
                  <input type="text" name="course" value="$course"/>
                </p>
                <p>
                  <strong>Section (e.g., 0101):</strong>
                  <input type="password" name="section" value="$section"/>
                </p>
                <p>
                  <input type="submit" name="submit"/>
                </p>
              </body>
            </html>
END;
?>
