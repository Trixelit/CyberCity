<?php include "template.php"; ?>
<title>Cyber City - Registration</title>

<h1 class='text-primary'>Please register for our city</h1>


<!--create a bootstrap form for 2 fields-->
<!-- username-->
<!-- password-->
<!--data will need to be collected and stored in the "user" table with an access level of 1-->
<!--password needs to be hashed before sending to the database-->


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <!--Customer Details-->

            <div class="col-md-12">
                <h2>Account Details</h2>
                <p>Please enter wanted username and password:</p>
                <p>User Name<input type="text" name="username" class="form-control" required="required"></p>
                <p>Password<input type="password" name="password" class="form-control" required="required"></p>

            </div>
        </div>
    </div>
    <input type="submit" name="formSubmit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitise_data($_POST['username']);
    $password = sanitise_data($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (username, hashed_password, access_level) VALUES (:newUsername, :newPassword, 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':newUsername', $username);
    $stmt->bindValue(':newPassword', $hashed_password);
    $stmt->execute();

}


?>