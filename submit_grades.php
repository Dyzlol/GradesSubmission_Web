<?php

    require_once("person.php");
    session_start();

    // check to see if names are already read in
    if(empty($_SESSION["students"])) {
        $fp = fopen($_SESSION["filename"],"r");
        while(!feof($fp)){
            $name_str = explode("_",fgets($fp, 1024)); // seperate name by "_"
            // create new Person object and store Information
            // use serialization so its static
            $students[] = serialize(new Person($name_str[1], $name_str[0],""));
        }
        $_SESSION["students"] = $students;
    }

    // more variables.... jfc
    $course = substr($_SESSION["filename"],0,7);
    $section = substr($_SESSION["filename"],7,4);
    $students = $_SESSION["students"];
      // values for grades
    $button_vals[0] = "A";
    $button_vals[1] = "B";
    $button_vals[2] = "C";
    $button_vals[3] = "D";
    $button_vals[4] = "E";
    $temp_array = "";
    $stud_index = 0;

    // fill in the table with students info and possible grades
    // tho im not sure if we are just supposed to save grades on back button or
    // after the close window, this saves on the back button, resets on window close
    while ($stud_index < count($students)) {
      $student = unserialize($students[$stud_index]);
      $tempStr = $student->getLastName()."_".$student->getFirstName();
      $tempArray.="<tr><td>"."$tempStr"."</td>";
      $index = 0;
      while ($index < count($button_vals)) { // create radio buttons
        $output_str = "<td><input type=\"radio\" name=\"grade$tempStr\" value=\"$button_vals[$index]\"";
        if($student->getGrade() === $button_vals[$index])
            $tempArray.=$output_str." checked/>$button_vals[$index]</td>"; // check if grade present
        else
            $tempArray.=$output_str."/>$button_vals[$index]</td>"; // no grade present
        $index += 1;
      }
      $stud_index += 1;
    }

    $tempArray.="</tr>"; // close table

    // HTML
    print <<<ENDSTUFF
        <html>
          <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
            <title>Grades</title>
          </head>
          <body>
            <h1>Grades Submission Form</h1>
            <h2>Course: $course, Section: $section </h2>
            <form action="update_grades.php" method = "post">
              <table border="1">
                $tempArray
              </table>
              <br/>
              <input type="submit" name="submit" value="Continue"/>
            </form>
          <body>
        </html>
ENDSTUFF;
?>
