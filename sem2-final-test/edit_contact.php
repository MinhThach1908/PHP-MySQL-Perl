<?php

require_once 'config.php';

$name = $phone = "";
$name_err = $phone_err = "";

if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    $id = $_POST["ID"];

    $input_name = trim($_POST["Name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var(trim($_POST["Name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $name_err = 'Please enter a valid name.';
    } else{
        $name = $input_name;
    }

    $input_phone = trim($_POST["Phone Number"]);
    if(empty($input_phone)){
        $phone_err = "Please enter student's phone number.";
    } elseif(!ctype_digit($input_phone)) {
        $phone_err = "Please enter correct phone number format.";
    } else{
        $phone = $input_phone;
    }

    if(empty($name_err) && empty($phone_err)){
        $sql = "UPDATE contacts SET name=?, phone=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_phone);

            $param_name = $name;
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
} else{
    if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
        $id = trim($_GET["ID"]);

        $sql = "SELECT * FROM students WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $name = $row["Name"];
                    $phone = $row["Phone"];
                } else{
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);

        mysqli_close($link);
    } else{
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Contact</title>
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
                    <h2>Edit Contact</h2>
                </div>
                <p>Please edit the input values and submit to update the details.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" class="form-control" value="<?php echo $phone; ?>">
                        <span class="help-block"><?php echo $phone_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" class="btn btn-primary" value="Save">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
