<?php

    session_start();

    # Incluyendo el archivo que contiene los mensajes de error
    include '../constants/messages.php';

    # Verificando su la sesión del admin permanece abierta
    if(isset($_SESSION['admin_id'])){

        # Verificando si todos los datos fueron enviados
        if(isset($_POST['username']) &&
           isset($_POST['password']) &&
           isset($_POST['email']) &&
           isset($_POST['department']) &&
           isset($_POST['info']) &&
           isset($_POST['boss'])){

            # Estableciendo la conexión con la BD
            include '../db.conn.php';

            # Obteniendo los datos enviados
            $username   = trim($_POST['username']);
            $password   = trim($_POST['password']);
            $email      = trim($_POST['email']);
            $department = trim($_POST['department']);
            $info       = trim($_POST['info']);
            $boss       = trim($_POST['boss']);
            $role       = 'department';

            # Expresión regular del correo electrónico
            $email_pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";

            # Elaborando el formato de la URL para devolver datos
            $data = 'username=' . $username . '&password=' . $password . '&email=' . $email .
                    '&department=' . $department . '&info=' . $info . '&boss=' . $boss;

            # Validación de los de datos enviados en el formulario
            if(empty($username)){
                # Mensaje de error
                $em = Messages::ERR_USERNAME_REQUIRED;

                # Redireccionando a 'add-dep' y pasando el mensaje de error
                header("Location: ../../admin/add-dep.php?error=$em");
                exit;
            }else if(empty($password)){
                # Mensaje de error
                $em = Messages::ERR_PASSWORD_REQUIRED;

                # Redireccionando a 'add-dep' y pasando el mensaje de error
                header("Location: ../../admin/add-dep.php?error=$em&$data");
                exit;
            }else if(empty($email)){
                # Mensaje de error
                $em = Messages::ERR_EMAIL_REQUIRED;

                # Redireccionando a 'add-dep' y pasando el mensaje de error
                header("Location: ../../admin/add-dep.php?error=$em&$data");
                exit;
            }else if(!preg_match($email_pattern, $email)){
                # Mensaje de error
                $em = Messages::ERR_FORMAT_EMAIL;

                # Redireccionando a 'add-dep' y pasando el mensaje de error
                header("Location: ../../admin/add-dep.php?error=$em&$data");
                exit;
            }else if(empty($department)){
                # Mensaje de error
                $em = Messages::ERR_NAME_DEPARTMENT_REQUIRED;

                # Redireccionando a 'add-dep' y pasando el mensaje de error
                header("Location: ../../admin/add-dep.php?error=$em&$data");
                exit;
            }else if(empty($info)){
                # Mensaje de error
                $em = Messages::ERR_INFO_DEPARTMENT_REQUIRED;

                # Redireccionando a 'add-dep' y pasando el mensaje de rror
                header("Location: ../../admin/add-dep.php?error=$em&$data");
                exit;
            }else if(empty($boss)){
                # Mensaje de error
                $em = Messages::ERR_BOSS_DEPARTMENT_REQUIRED;

                # Redireccionando a 'add-dep' y pasando el mensaje de rror
                header("Location: ../../admin/add-dep.php?error=$em&$data");
                exit;
            }else{

                # Verificando si el usuario ya ha sido registrado
                $sql = "SELECT username
                        FROM users
                        WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$username]);

                if ($stmt->rowCount() > 0) {
                    $em = Messages::ERR_USERNAME_DEPARTMENT_ALREADY_EXISTS;
                    header("Location: ../../admin/add-dep.php?error=$em&$data");
                    exit;
                }
                
                # Verificando si el email ya ha sido registrado
                $sql = "SELECT email
                        FROM users
                        WHERE email = ?";
                        $stmt = $conn->prepare($sql);
                $stmt->execute([$email]);

                if ($stmt->rowCount() > 0) {
                    $em = Messages::ERR_EMAIL_ALREADY_EXISTS;
                    header("Location: ../../admin/add-dep.php?error=$em&$data");
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
                            header("Location: ../../admin/add-dep.php?error=$em&$data");
                            exit;
                        }
                    }
                }

                // Cifrado del password
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

                # Insertando al usuario en la tabla 'departments'
                $sql = "INSERT INTO departments
                                    (user_id, department_name, info, department_head)
                                    VALUES (?,?,?,,?)";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$user['user_id'], $department, $info, $boss]);

                # Mensaje de éxito
                $sm = Messages::SCS_CREATION_DEPARTMENT;

                # redirect to 'index.php' and passing success message
                header("Location: ../../admin/add-dep.php?success=$sm");
                exit;
            }
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>