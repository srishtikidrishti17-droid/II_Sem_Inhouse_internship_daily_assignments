<?php
$name = $email = $phone = $gender = $department = $address = $joining_date = "";
$errors = [];
$photoPath = "";

if(isset($_POST['submit']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $department = $_POST['department'];
    $address = trim($_POST['address']);
    $joining_date = $_POST['joining_date'];

    // Name Validation
    if($name=="")
        $errors[]="Employee Name is required.";
    else if(!preg_match("/^[a-zA-Z ]+$/",$name))
        $errors[]="Employee Name should contain only alphabets.";

    // Email Validation
    if($email=="")
        $errors[]="Email is required.";
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        $errors[]="Enter a valid Email.";

    // Phone Validation
    if($phone=="")
        $errors[]="Phone Number is required.";
    else if(!preg_match("/^[0-9]{10}$/",$phone))
        $errors[]="Phone Number must be exactly 10 digits.";

    // Gender Validation
    if($gender=="")
        $errors[]="Please select Gender.";

    // Department Validation
    if($department=="")
        $errors[]="Please select Department.";

    // Address Validation
    if($address=="")
        $errors[]="Office Address is required.";

    // Joining Date Validation
    if($joining_date=="")
        $errors[]="Please select Joining Date.";

    // Photo Upload
    if($_FILES['photo']['name']=="")
    {
        $errors[]="Please upload Employee Photo.";
    }
    else
    {
        if(!file_exists("uploads"))
        {
            mkdir("uploads");
        }

        $photoPath="uploads/".time()."_".$_FILES['photo']['name'];

        $ext=strtolower(pathinfo($photoPath,PATHINFO_EXTENSION));

        if($ext!="jpg" && $ext!="jpeg" && $ext!="png")
        {
            $errors[]="Only JPG, JPEG and PNG files are allowed.";
        }

        if(count($errors)==0)
        {
            move_uploaded_file($_FILES["photo"]["tmp_name"],$photoPath);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Employee Joining Form</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#eef4f8;
    font-family:Arial;
}

.container-box{
    width:720px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 0 12px gray;
}

h2{
    text-align:center;
    margin-bottom:25px;
    color:#198754;
}

.error-box{
    background:#ffe5e5;
    color:red;
    padding:15px;
    border-radius:8px;
    margin-bottom:20px;
}

.success-box{
    background:#e9ffe8;
    padding:25px;
    border-radius:10px;
}

img{
    border-radius:10px;
    border:2px solid gray;
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

<table class="table table-bordered">

<tr>
<th>Photo</th>
<td><img src="<?php echo $photoPath; ?>" width="180"></td>
</tr>

<tr>
<th>Employee Name</th>
<td><?php echo $name; ?></td>
</tr>

<tr>
<th>Email</th>
<td><?php echo $email; ?></td>
</tr>

<tr>
<th>Phone Number</th>
<td><?php echo $phone; ?></td>
</tr>

<tr>
<th>Joining Date</th>
<td><?php echo $joining_date; ?></td>
</tr>

<tr>
<th>Gender</th>
<td><?php echo $gender; ?></td>
</tr>

<tr>
<th>Department</th>
<td><?php echo $department; ?></td>
</tr>

<tr>
<th>Office Address</th>
<td><?php echo nl2br($address); ?></td>
</tr>

</table>

<a href="" class="btn btn-success">Register Another Employee</a>

</div>

<?php
}
else
{
?>

<h2>Employee Joining Form</h2>

<?php
if(count($errors)>0)
{
?>

<div class="error-box">

<b>Please fix the following errors:</b>

<ul>

<?php
foreach($errors as $e)
echo "<li>$e</li>";
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
maxlength="10"
value="<?php echo $phone; ?>">
</div>

<div class="mb-3">
<label class="form-label">Employee Photo</label>
<input
type="file"
class="form-control"
name="photo"
accept=".jpg,.jpeg,.png">
</div>

<div class="mb-3">
<label class="form-label">Joining Date</label>
<input
type="date"
class="form-control"
name="joining_date"
value="<?php echo $joining_date; ?>">
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

&nbsp;&nbsp;&nbsp;

<input
type="radio"
name="gender"
value="Female"
<?php if($gender=="Female") echo "checked"; ?>>
Female

&nbsp;&nbsp;&nbsp;

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

<option value="Human Resources" <?php if($department=="Human Resources") echo "selected"; ?>>Human Resources</option>

<option value="Information Technology" <?php if($department=="Information Technology") echo "selected"; ?>>Information Technology</option>

<option value="Finance" <?php if($department=="Finance") echo "selected"; ?>>Finance</option>

<option value="Marketing" <?php if($department=="Marketing") echo "selected"; ?>>Marketing</option>

<option value="Sales" <?php if($department=="Sales") echo "selected"; ?>>Sales</option>

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
