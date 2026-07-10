<!DOCTYPE html>
<html>
<head>
    <title>Job Application Confirmation System</title>

    <style>

        body{
            font-family:Arial, sans-serif;
            background:#eef7f1;
            margin:0;
            padding:0;
        }

        h1{
            background:#198754;
            color:white;
            padding:20px;
            text-align:center;
            margin:0;
        }

        form{
            width:450px;
            margin:30px auto;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px gray;
        }

        table{
            width:100%;
        }

        td{
            padding:10px;
        }

        input,select{
            width:100%;
            padding:8px;
            border:1px solid gray;
            border-radius:5px;
        }

        input[type=submit]{
            background:#198754;
            color:white;
            border:none;
            cursor:pointer;
            font-size:16px;
        }

        input[type=submit]:hover{
            background:#146c43;
        }

        .card{
            width:500px;
            margin:30px auto;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px gray;
        }

        .card h2{
            text-align:center;
            color:#198754;
        }

        .card table{
            border-collapse:collapse;
        }

        .card td{
            border:1px solid #ccc;
        }

        .error{
            text-align:center;
            color:red;
            font-weight:bold;
        }

        footer{
            background:#198754;
            color:white;
            text-align:center;
            padding:15px;
            margin-top:30px;
        }

    </style>

</head>

<body>

<h1>Job Application Confirmation System</h1>

<?php

$name="";
$email="";
$department="";
$company="";
$experience="";
$status="";
$message="";

if(isset($_POST["submit"]))
{

    $name=$_POST["name"];
    $email=$_POST["email"];
    $department=$_POST["department"];
    $company=$_POST["company"];
    $experience=$_POST["experience"];

    if($name=="" || $email=="" || $department=="" || $company=="" || $experience=="")
    {
        $message="Please fill all the fields.";
    }
    else
    {

        if($experience>=10)
            $status="Senior Candidate";
        elseif($experience>=5)
            $status="Experienced Candidate";
        elseif($experience>=2)
            $status="Intermediate Candidate";
        else
            $status="Fresher";

    }

}

?>

<form method="POST">

<table>

<tr>
<td>Applicant Name</td>
<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
</tr>

<tr>
<td>Email</td>
<td><input type="email" name="email" value="<?php echo $email; ?>"></td>
</tr>

<tr>
<td>Department</td>
<td>

<select name="department">

<option value="">Select</option>

<option value="Software Development"
<?php if($department=="Software Development") echo "selected"; ?>>
Software Development
</option>

<option value="Human Resources"
<?php if($department=="Human Resources") echo "selected"; ?>>
Human Resources
</option>

<option value="Marketing"
<?php if($department=="Marketing") echo "selected"; ?>>
Marketing
</option>

<option value="Finance"
<?php if($department=="Finance") echo "selected"; ?>>
Finance
</option>

<option value="Customer Support"
<?php if($department=="Customer Support") echo "selected"; ?>>
Customer Support
</option>

</select>

</td>
</tr>

<tr>
<td>Company Name</td>
<td><input type="text" name="company" value="<?php echo $company; ?>"></td>
</tr>

<tr>
<td>Experience (Years)</td>
<td><input type="number" name="experience" value="<?php echo $experience; ?>"></td>
</tr>

<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="Apply">
</td>
</tr>

</table>

</form>

<?php

if($message!="")
{
    echo "<p class='error'>$message</p>";
}

if($status!="")
{

echo "<div class='card'>";

echo "<h2>Application Submitted Successfully</h2>";

echo "<table>";

echo "<tr><td><b>Applicant Name</b></td><td>$name</td></tr>";

echo "<tr><td><b>Email</b></td><td>$email</td></tr>";

echo "<tr><td><b>Department</b></td><td>$department</td></tr>";

echo "<tr><td><b>Company</b></td><td>$company</td></tr>";

echo "<tr><td><b>Experience</b></td><td>$experience Years</td></tr>";

echo "<tr><td><b>Category</b></td><td>$status</td></tr>";

echo "<tr><td><b>Application Date</b></td><td>".date("d-m-Y")."</td></tr>";

echo "</table>";

echo "</div>";

}

?>

<footer>

Job Application Confirmation System © <?php echo date("Y"); ?>

</footer>

</body>
</html>