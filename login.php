<?php
include_once("connect.php");
include_once("header.php");
session_start();

if(isset($_POST['btnLogin'])){
	if(isset($_POST['txtPass'])&&isset($_POST['txtEmail'])){
		$pwd = $_POST['txtPass'];
		$email = $_POST['txtEmail'];
		$c = new Connect();
		$dblink = $c->connectToPDO();
		$sql = "SELECT * FROM user WHERE email = ? and password = ?";
		$stmt = $dblink->prepare($sql);
		$re = $stmt->execute(array("$email","$pwd"));
		$numrow = $stmt->rowCount();
		$row = $stmt->fetch(PDO::FETCH_BOTH);
		if ($numrow==1){
			echo "Login successfully"; 
			setcookie("cc_username",$row['fullname'],time()+3600);
			setcookie("cc_id",$row['id'],time()+3600);
			header("Location: index.php");
		} else{
			echo "Your username or password does not correct please enter it again <br>";
		}
	}else{
		echo "Please enter your information";
	}
}
/*
Put your code right here
1. Check if button 'btnLogin' is submitted, if it's true, go to 2.
2. Check if you get $_POST of input of email and input of password. if it's true, go to 3.
3. Connect to PDO
4. write a query to check from table 'Users' if user's email and user's password are both true.
5. Excute it.
6. Count row of result
7. Fetch data from result
8. save session 
9. Redirect to homepage.
*/
?>
 
<div class="container">
        <h2 class="pt-3">Member Login</h2>
        <form id="form1" name="form1" method="POST" 
	action="login.php">

	<div class="row">
		<div class="form-group">				    
			<label for="txtEmail" class="col-sm-2 control-label">Email(*):  </label>
			<div class="col-sm-10">
				<input type="email" name="txtEmail" id="txtEmail" class="form-control" placeholder="Email" value=""/>
			</div>
		</div>  
		
		<div class="form-group">
			<label for="txtPass" class="col-sm-2 control-label">Password(*):  </label>			
			<div class="col-sm-10">
					<input type="password" name="txtPass" id="txtPass" class="form-control" placeholder="Password" value=""/>
			</div>
		</div> 
		<div class="form-group pt-3"> 
			<div class="col-sm-2"></div>
			<div class="col-sm-10">
				<input type="submit" name="btnLogin"  class="btn btn-primary" id="btnLogin" value="Login"/>
				<input type="reset" name="btnCancel"  class="btn btn-primary" id="btnCancel" value="Cancel"/>
			</div>  
		</div>
	</div>
		
	</form>
</div>
    

<?php
include_once './footer.php';
?>
