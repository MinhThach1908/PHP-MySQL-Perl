<?php
//Include config file
require_once 'config.php';

//Define variables and initialize with empty values
$name  = $phone = "";
$name_err = $phone_err = "";

//Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])) {
//Get hidden input value
    $id = $_POST["id"];
}

$input_name = trim($_POST["name"]);
if(empty($input_name)){
    $name_err = "Please change the current name.";
} elseif(!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
    $name_err = 'Please enter a valid name.';
} else{
    $name = $input_name;
}

$input_phone = trim($_POST["phone"]);
if(empty($input_phone)){
    $phone_err = "Please change the current phone number.";

}elseif (!ctype_digit($input_phone)){
    $phone_err = 'Please enter a positive integer value. ';
}else{
    $phone = $input_phone;
}


if(empty($name_err) && empty($phone_err)){
    $sql = "UPDATE contacts SET name=?, phone=? WHERE id=?";

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_phone, $param_id);

        $param_name = $name;
        $param_phone = $phone;
        $param_id = $id;

        if(mysqli_stmt_execute($stmt)){
            header("location: index.php");
            exit();
        }else{
            echo "Something went wrong. Please try again later.";
        }

        //Close statement
        mysqli_stmt_close($stmt);
    }

//Close connection
    mysqli_close($link);
}else{

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM contacts WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $name = $row["Name"];
                    $phone = $row["Phone Number"];
                }else{
                    header("location: error.php");
                    exit();
                }
            }else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        //Close statement
        mysqli_stmt_close($stmt);

        //Close connection
        mysqli_close($link);
    }else{
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