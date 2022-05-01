<?php

include '../constants/messages.php';

# check if username, password, name submitted
if (isset($_POST['name']) &&
    isset($_POST['last_name']) &&
    isset($_POST['username']) &&
    isset($_POST['career']) &&
    isset($_POST['semester']) &&
    isset($_POST['email']) &&
    isset($_POST['password'])
    ) {

    # database connection file
    include '../db.conn.php';

    # get data from POST request and store them in var
    $name      = trim($_POST['name']);
    $last_name = trim($_POST['last_name']);
    $username  = trim($_POST['username']);
    $career    = $_POST['career'];
    $semester  = $_POST['semester'];
    $email     = trim($_POST['email']);
    $password  = trim($_POST['password']);
    $role      = 'student';
    
    # Expresión regular del correo electrónico
    $email_pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";

    # making URL data format
    $data = 'name=' . $name . '&last_name=' . $last_name . '&username=' . $username .
            '&career=' . $career . '&semester=' . $semester . '&email=' . $email . '&password=' . $password;

    #simple form Validation
    if (empty($name)) {
        # error message
        $em = Messages::ERR_NAME_REQUIRED;

        # redirect to 'signup.php' and passing error message
        header("Location: ../../signup.php?error=$em");
        exit;
    } else if (empty($last_name)) {
        # error message
        $em = Messages::ERR_LAST_NAME_REQUIRED;

        /*
        redirect to 'signup.php' and
        passing error message and data
        */
        header("Location: ../../signup.php?error=$em&$data");
        exit;
    } else if(empty($username)) {
        # error message
        $em = Messages::ERR_ENROLLMENT_REQUIRED;

        /*
        redirect to 'signup.php' and
        passing error message and data
        */
        header("Location: ../../signup.php?error=$em&$data");
        exit;
    } else if(!preg_match("/[0-9]{8}/", $username)){
        # error message
        $em = Messages::ERR_FORMAT_ENROLLMENT;

        /*
        redirect to 'signup.php' and
        passing error message and data
        */
        header("Location: ../../signup.php?error=$em&$data");
        exit;
    } else if(empty($career)){
        # error message
        $em = Messages::ERR_CAREER_REQUIRED;

        /*
        redirect to 'signup.php' and
        passing error message and data
        */
        header("Location: ../../signup.php?error=$em&$data");
        exit;
    } else if (empty($semester)){
        # error message
        $em = Messages::ERR_SEMESTER_REQUIRED ;

        /*
        redirect to 'signup.php' and
        passing error message and data
        */
        header("Location: ../../signup.php?error=$em&$data");
        exit;
    } else if (empty($email)) {
        $em = Messages::ERR_EMAIL_REQUIRED;
        header("Location: ../../signup.php?error=$em&$data");
        exit;
    } else if (!preg_match($email_pattern, $email)){
        # error message
        $em = Messages::ERR_FORMAT_EMAIL;

        /*
        redirect to 'signup.php' and
        passing error message and data
        */
        
        header("Location: ../../signup.php?error=$em&$data");
        exit;
    } else if (empty($password)) {
        # error message
        $em = Messages::ERR_PASSWORD_REQUIRED;

        /*
        redirect to 'signup.php' and
        passing error message and data
        */
        header("Location: ../../signup.php?error=$em&$data");
        exit;
    } else {
        # checking the database if the username is taken
        $sql = "SELECT username
                FROM users
                WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            $em = Messages::ERR_USERNAME_ALREADY_EXISTS;
            header("Location: ../../signup.php?error=$em&$data");
            exit;
        }
        # checking the database if the email is taken
        $sql = "SELECT email
                FROM users
                WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $em = Messages::ERR_EMAIL_ALREADY_EXISTS;
            header("Location: ../../signup.php?error=$em&$data");
            exit;
        }

        # Profile Picture Uploading
        if (isset($_FILES['pp'])) {
            # get data and store them in var
            $img_name = $_FILES['pp']['name'];
            $tmp_name = $_FILES['pp']['tmp_name'];
            $error    = $_FILES['pp']['error'];

            # if there is not error occurred while uploading
            if ($error === 0) {

                # get image extension store it in var
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

                /*
                convert the image extension into lower case
                and store it in var
                    */
                $img_ex_lc = strtolower($img_ex);

                /*
                crating array that stores allowed
                to upload image extension.
                    */
                $allowed_exs = array("jpg", "jpeg", "png");

                /*
                check if the the image extension
                is present in $allowed_exs array
                    */
                if (in_array($img_ex_lc, $allowed_exs)) {
                    /*
                    renaming the image with user's username
                    like: username.$img_ex_lc
                    */
                    $new_img_name = $username . '.' . $img_ex_lc;

                    # crating upload path on root directory
                    $img_upload_path = '../../uploads/' . $new_img_name;

                    # move uploaded image to ./upload folder
                    move_uploaded_file($tmp_name, $img_upload_path);
                }else {
                    $em = Messages::ERR_INCORRECT_FILE_EXTENSION;
                    header("Location: ../../signup.php?error=$em&$data");
                    exit;
                }
            }
        }

        // password hashing
        $password = password_hash($password, PASSWORD_DEFAULT);

        # if the user upload Profile Picture
        if (isset($new_img_name)) {

        # inserting data into database
        $sql = "INSERT INTO users
                            (username, password, email, p_p, role)
                            VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $password, $email, $new_img_name, $role]);

        } else {
            # inserting data into database
            $sql = "INSERT INTO users
                                (username, password, email, role)
                                VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $password, $email, $role]);
        }

        # Obteniendo el id del usuario recien insertado
        $sql = "SELECT user_id
                FROM users
                WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);

        $user = $stmt->fetch();

        # Insertando al usuario en la tabla 'students'
        $sql = "INSERT INTO students
                            (user_id, name, last_name, semester, career)
                            VALUES (?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$user['user_id'], $name, $last_name, $semester, $career]);

        # success message
        $sm = Messages::SCS_CREATION_ACCOUNT;

        # redirect to 'index.php' and passing success message
        header("Location: ../../index.php?success=$sm");
        exit;
    }
} else {
    header("Location: ../../signup.php");
    exit;
}
?>