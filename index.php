<?php 
include 'api/connect.php'; ?>
<html>
<head>
<title>AlgoFocus UserForm</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="js/angular.min.js"></script>
<script type="text/javascript" src="app/app.js"></script>
</head>
<br/>
<body ng-app="myApp" ng-controller="formController">
<div class="container" style="margin-right: -100px;">
<div class="row">
<br/>
<div class="col-md-offset-1 col-md-6 col-sm-12" >
<div class="login">
<h2>User Form</h2>
<div id="messages" class="alert alert-info" ng-show="message">{{ message }}</div>
<form ng-submit="processForm()">
<div id="name-group" class="form-group" ng-class="{ 'has-error' : errorName }">
<label id="label" class="control-label">First Name:</label>
<input type="text" class="form-control" name="name" ng-model="formData.name" placeholder="Enter First Name" autocomplete="off" ng-minlength="4" ng-maxlength="50" required />
<span class="msg" ng-show="formData.name.$dirty && formData.name.$error.minlength">name must contain atleast 4 charecters</span>
<span class="msg" ng-show="formData.name.$dirty && formData.name.$error.maxlength">max-length of password reached</span>
</div>

<div id="email-group" class="form-group" ng-class="{ 'has-error' : errorEmail }">
<label id="label" class="control-label">Email:</label>
<input type="email" class="form-control" ng-model="formData.email" name="email" placeholder="Enter Email Address" autocomplete="off" required>
<span class="msg" ng-show="formData.email.$dirty && formData.email.$invalid">Email Address is not valid</span>
</div>

<div id="phone-group" class="form-group" ng-class="{ 'has-error' : errorPhone }">
<label id="label" class="control-label">Phone Number:</label>
<input type="text" class="form-control" ng-model="formData.phone" name="phone" placeholder="Enter Phone Number" autocomplete="off" ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/" required>
<span class="msg" ng-show="formData.phone.$dirty && formData.phone.$error.pattern">phone number is not valid</span>
</div>

<div id="dob-group" class="form-group" ng-class="{ 'has-error' : errorDob }">
<label id="label" class="control-label">Date of Birth:</label>
<input type="date" name="dob" class="form-control" ng-model="formData.dob" placeholder="Date of Birth" autocomplete="off" required>
</div>
<div class="form-group">
<button ng-disabled="formData.$invalid" class="btn btn-warning" type="submit"> Submit </button>
</div>
</form>
</div>
</div> 
<!--code to show values after clicking pn submit button-->
 <div class="col-md-offset-1 col-md-4 col-sm-12">
 <table class="table">
  <?php
  $sql = "SELECT * From usr_table order by id desc";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<tr>
    <th>Name</th>
    <th>Mail</th> 
    <th>DOB</th>
  </tr>";
    while($row = $result->fetch_assoc()) {

  echo "
  <tr>
    <td>".$row["name"]."</td>
    <td>".$row["email"]."</td> 
    <td>".$row["date"]."</td>
  </tr>";
    }
}
?>
</table>
 <pre>
    {{ formData }}
  </pre>
  </div>

</div>

</body>
</html>