<?php

require_once 'config.php';

$name = $email = $status = $phone = "";
$name_err = $email_err = $status_err = $phone_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $name_err = 'Please enter a valid name.';
    } else{
        $name = $input_name;
    }

    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = 'Please enter an email.';
    } else{
        $email = $input_email;
    }

    $input_status = trim($_POST["status"]);
    if(empty($input_status)){
        $status_err = "Please enter the student's status.";
    } else{
        $status = $input_status;
    }

    $input_phone = trim($_POST["phone"]);
    if(empty($input_phone)){
        $phone_err = "Please enter student's phone number.";
    } elseif(!ctype_digit($input_phone)) {
        $phone_err = "Please enter correct phone number format.";
    } else{
        $phone = $input_phone;
    }

    if(empty($name_err) && empty($email_err) && empty($status_err) && empty($phone_err)){
        $sql = "INSERT INTO students (name, email, status, phone) VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_status, $param_phone);

            $param_name = $name;
            $param_email = $email;
            $param_status = $status;
            $param_phone = $phone;

            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Student Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>New Student Information</h2>
                </div>
                <p>Please fill this form and submit to add new student information to the student details.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Student's Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label>Student's Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        <span class="help-block"><?php echo $email_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($status)) ? 'has-error' : ''; ?>">
                        <label>Student's Status</label>
                        <input type="text" name="status" class="form-control" value="<?php echo $status; ?>">
                        <span class="help-block"><?php echo $status_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                        <label>Student's Phone Number</label>
                        <input type="tel" name="phone" class="form-control" value="<?php echo $phone; ?>">
                        <span class="help-block"><?php echo $phone_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
