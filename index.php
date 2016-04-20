<?php
    // vars
    session_start();
    $user_name = "";
    $password = "";
    $sess_id = session_id();

    // check if already a session
    if(!empty($_SESSION["user_name"]))
        header("Location: classInformation.php");
    else if(!empty($_POST["submit"])){ // if submit was pressed
        $user_name = trim($_POST["user_name"]);
        $password = trim($_POST["password"]);
        if(!($user_name === "cmsc298s") || !($password === "terps")){ // check values submitted
            $error_message = "<strong>Invalid login information provided.</strong><br/>";
            // scrub values from text boxes
            $user_name = "";
            $password = "";
        } else { // correct login, set flag for session
            $_SESSION["user_name"] = $user_name;
            header("Location: classInformation.php");
        }
    }

    // output HTML
  print <<<END
        <!doctype html>
          <html>
            <head>
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
              <title>Stuff</title>
            </head>
            <body>
              <h1>Grades Submission System</h1>
              <form action="{$_SERVER["PHP_SELF"]}" method="post"/>
              <p>
                <strong>LoginId:</strong>
                <input type="text" name="user_name" value="$user_name"/>
              </p>
              <p>
                <strong>Password:</strong>
                <input type="password" name="password" value="$password"/>
              </p>
              <p>
                <input type="submit" name="submit"/>
              </p>
              <p>
                $error_message
              </p>
            </body>
          </html>
END;

?>
