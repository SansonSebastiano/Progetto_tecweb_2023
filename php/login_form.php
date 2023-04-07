<?php
    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";

    const INDEX = "Location: ../index.php";

    // import the connection script
    require_once('admin_conn.php');
    // import input cleaner script
    include('input_cleaner.php');

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
            if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
                // get the data from the form:
                // username
                $username = clearInput($_POST['username']);
                if (empty($username)) {
                    echo "<li>Username is required<li>";
                }
                // password
                $password = clearInput($_POST['password']);
                if (empty($password)) {
                    echo "<li>Password is required<li>";
                }
                // create a query
                $query = "SELECT * FROM `utente` WHERE `nome` = '$username' AND `password` = '$password'";
                // execute the query
                $result = $mysqli->query($query);
                // check if the query was executed successfully and if the result is not empty
                if ($result->num_rows == 0) {
                    echo "<script>console.log('Error: the query to MySQL eLusive was not executed successfully or the result is empty.');</script>";

                    $mysqli->close();
                    
                    header("Location: ../html/login-form.html");
                } else {
                    echo "<script>console.log('Success: A proper query to MySQL eLusive was made.');</script>";
                    echo "<script>console.log('Number of rows: " . $result->num_rows . "');</script>";

                    // iterate over the result set
                    // fetch each row as an associative array
                    while ($row = $result->fetch_assoc()) {
                        if ($row["ruolo"] == ADMIN_ROLE) {

                            echo "<script>console.log('ADMIN SECTION');</script>";

                            $_SESSION["ruolo"] = ADMIN_ROLE;
                            $_SESSION["username"] = $row["nome"];
                            $_SESSION["id"] = $row["id"];

                            echo "<script>console.log('USERNAME: " . $_SESSION["username"] . "');</script>";
                            echo "<script>console.log('PASSWORD: " . $row["password"] . "');</script>";
                            echo "<script>console.log('EMAIL: " . $row["email"] . "');</script>";
                            echo "<script>console.log('RUOLO: " . $_SESSION["ruolo"] . "');</script>";

                            header(INDEX);
                        } elseif ($row["ruolo"] == WRITER_ROLE) {
                            echo "<script>console.log('WRITER SECTION');</script>";

                            $_SESSION["ruolo"] = WRITER_ROLE;
                            $_SESSION["username"] = $row["nome"];
                            $_SESSION["id"] = $row["id"];

                            echo "<script>console.log('USERNAME: " . $_SESSION["username"] . "');</script>";
                            echo "<script>console.log('PASSWORD: " . $row["password"] . "');</script>";
                            echo "<script>console.log('EMAIL: " . $row["email"] . "');</script>";
                            echo "<script>console.log('RUOLO: " . $_SESSION["ruolo"] . "');</script>";

                            header(INDEX);
                        } elseif ($row["ruolo"] == USER_ROLE) {
                            echo "<script>console.log('LOGGED SECTION');</script>";

                            $_SESSION["ruolo"] = USER_ROLE;
                            $_SESSION["username"] = $row["nome"];
                            $_SESSION["id"] = $row["id"];

                            echo "<script>console.log('USERNAME: " . $_SESSION["username"] . "');</script>";
                            echo "<script>console.log('PASSWORD: " . $row["password"] . "');</script>";
                            echo "<script>console.log('EMAIL: " . $row["email"] . "');</script>";
                            echo "<script>console.log('RUOLO: " . $_SESSION["ruolo"] . "');</script>";

                            header(INDEX);
                        } else {
                            echo "Error: no role found for the user.";
                            // TODO: redirect to the login page
                            //header("Location: ../html/login-form.html");
                        }
                    }

                    // free the result set
                    $result->free();
                    // close the connection
                    $mysqli->close();
                }
            }
        }
    }
?>