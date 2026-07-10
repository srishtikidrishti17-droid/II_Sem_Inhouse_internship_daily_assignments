<?php
$name = $email = $phone = $gender = $department = $address = "";
$errors = [];

if(isset($_POST['submit']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $department = $_POST['department'];
    $address = trim($_POST['address']);

    if($name=="")
        $errors[]="Employee Name is required.";
    else if(preg_match('/[0-9]/',$name))
        $errors[]="Employee Name should not contain numbers.";

    if($email=="")
        $errors[]="Email is required.";
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        $errors[]="Please enter a valid Email.";

    if($phone=="")
        $errors[]="Phone Number is required.";
    else if(!preg_match('/^[0-9]{10}$/',$phone))
        $errors[]="Phone Number must contain exactly 10 digits.";

    if($gender=="")
        $errors[]="Please select Gender.";

    if($department=="")
        $errors[]="Please select Department.";

    if($address=="")
        $errors[]="Office Address is required.";
    else if(strlen($address)<10)
        $errors[]="Office Address should be at least 10 characters.";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Employee Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#eef2f7;
    font-family:Arial;
}

.container-box{
    width:700px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 0 10px gray;
}

h2{
    text-align:center;
    margin-bottom:25px;
    color:#0d3b66;
}

.error-box{
    background:#ffe6e6;
    color:red;
    padding:15px;
    border-radius:8px;
    margin-bottom:20px;
}

.success-box{
    background:#e8ffe8;
    padding:20px;
    border-radius:10px;
}

img{
    margin-top:10px;
    border-radius:10px;
}

</style>

</head>

<body>

<div class="container-box">

<?php

if(isset($_POST['submit']) && count($errors)==0)
{

?>

<div class="success-box">

<h2>Employee Registered Successfully</h2>

<p><b>Employee Name :</b> <?php echo $name; ?></p>

<p><b>Email :</b> <?php echo $email; ?></p>

<p><b>Phone :</b> <?php echo $phone; ?></p>

<p><b>Gender :</b> <?php echo $gender; ?></p>

<p><b>Department :</b> <?php echo $department; ?></p>

<p><b>Office Address :</b><br><?php echo nl2br($address); ?></p>

<?php
if($_FILES['photo']['name']!="")
{
?>

<p><b>Uploaded ID Photo :</b></p>

<img src="<?php echo $_FILES['photo']['tmp_name']; ?>" width="180">

<?php
}
?>

<br><br>

<a href="" class="btn btn-primary">Register Another Employee</a>

</div>

<?php
}
else
{
?>

<h2>Employee Registration Form</h2>

<?php

if(count($errors)>0)
{
?>

<div class="error-box">

<b>Please correct the following errors:</b>

<ul>

<?php

foreach($errors as $e)
{
    echo "<li>$e</li>";
}

?>

</ul>

</div>

<?php
}
?>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">Employee Name</label>

<input
type="text"
class="form-control"
name="name"
value="<?php echo $name; ?>">

</div>

<div class="mb-3">

<label class="form-label">Email</label>

<input
type="email"
class="form-control"
name="email"
value="<?php echo $email; ?>">

</div>

<div class="mb-3">

<label class="form-label">Phone Number</label>

<input
type="text"
class="form-control"
name="phone"
value="<?php echo $phone; ?>">

</div>

<div class="mb-3">

<label class="form-label">Upload ID Photo</label>

<input
type="file"
class="form-control"
name="photo">

</div>

<div class="mb-3">

<label class="form-label">Gender</label>
<br>

<input
type="radio"
name="gender"
value="Male"
<?php if($gender=="Male") echo "checked"; ?>>
Male

&nbsp;&nbsp;

<input
type="radio"
name="gender"
value="Female"
<?php if($gender=="Female") echo "checked"; ?>>
Female

&nbsp;&nbsp;

<input
type="radio"
name="gender"
value="Other"
<?php if($gender=="Other") echo "checked"; ?>>
Other

</div>

<div class="mb-3">

<label class="form-label">Department</label>

<select
class="form-select"
name="department">

<option value="">Select Department</option>

<option value="Human Resources"
<?php if($department=="Human Resources") echo "selected"; ?>>
Human Resources
</option>

<option value="Information Technology"
<?php if($department=="Information Technology") echo "selected"; ?>>
Information Technology
</option>

<option value="Finance"
<?php if($department=="Finance") echo "selected"; ?>>
Finance
</option>

<option value="Marketing"
<?php if($department=="Marketing") echo "selected"; ?>>
Marketing
</option>

<option value="Sales"
<?php if($department=="Sales") echo "selected"; ?>>
Sales
</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">Office Address</label>

<textarea
class="form-control"
name="address"
rows="4"><?php echo $address; ?></textarea>

</div>

<div class="text-center">

<button
type="submit"
name="submit"
class="btn btn-success px-5">
Submit
</button>

<button
type="reset"
class="btn btn-secondary px-5">
Reset
</button>

</div>

</form>

<?php
}
?>

</div>

</body>
</html>