<?php
include_once 'header.php';

    include_once 'header.php';
    include_once 'connect.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if(isset($_POST['btnRegister'])){
        $gender = $_POST['grpGender'];
        $usrname = $_POST['txtUsername'];
        $pass = $_POST['txtPass1'];
        $email = $_POST['txtEmail'];
        $phone = $_POST['txtPhone'];
        $dateBirthday = date('Y-m-d',strtotime($_POST['txtBirth']));
        $c = new Connect();
        // $db = $c->connectToMySQL();
        // $sql = 'INSERT INTO `user`( `email`, `username`, `gender`, `address`, `password`, `role`, `phone`, `birthday`)
        //  VALUES ("$email","$usrname",$gender,"Cantho","$pass","user","$phone","$dateBirthday")';
        // $stmt = $db->query($sql);
       try{ $dblink = $c->connectToPDO();
        $sql = "INSERT INTO `user`(`email`, `fullname`, `gender`, `address`, `password`, `role`, `phone`, `birthday`) VALUES(?,?,?,?,?,?,?,?)";    
        $re = $dblink->prepare($sql); 
        
        $stmt = $re->execute(array("$email","$usrname",$gender,"Cantho","$pass","user","$phone","$dateBirthday"));
        if ($stmt == TRUE){
            echo "Congrats!";
        } else {
            echo "Failed! ".$stmt;
        }
    }catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
    }    
?>

<div class="container">
    
    <h2>Member Registration</h2>
             <form id="form1" name="form1" method="post" class="form-horizontal needs-validation" role="form">
                <div class="form-group">
                        
                        <label for="txtTen" class="col-sm-2 control-label">Username(*):  </label>
                        <div class="col-sm-10">
                              <input type="text" name="txtUsername" id="txtUsername" class="form-control" placeholder="Username" value="" required/>
                 
                        </div>
                  </div>  
                  
                   <div class="form-group">   
                        <label for="" class="col-sm-2 control-label">Password(*):  </label>
                        <div class="col-sm-10">
                              <input type="password" name="txtPass1" id="txtPass1" class="form-control" placeholder="Password" required/>
                        </div>
                   </div>     
                   
                   <div class="form-group"> 
                        <label for="" class="col-sm-2 control-label">Confirm Password(*):  </label>
                        <div class="col-sm-10">
                              <input type="password" name="txtPass2" id="txtPass2" class="form-control" placeholder="Confirm your Password" required/>
                        </div>
                   </div>     
                   
                   <div class="form-group">                               
                        <label for="lblFullName" class="col-sm-2 control-label">Full name(*):  </label>
                        <div class="col-sm-10">
                              <input type="text" name="txtFullname" id="txtFullname" value="" class="form-control" placeholder="Enter Fullname" required/>
                        </div>
                   </div> 
                   
                   <div class="form-group">      
                        <label for="lblEmail" class="col-sm-2 control-label">Email(*):  </label>
                        <div class="col-sm-10">
                              <input type="text" name="txtEmail" id="txtEmail" value="" class="form-control" placeholder="Email" required/>
                        </div>
                   </div>
                   <div class="form-group">      
                        <label for="lblEmail" class="col-sm-2 control-label">Phone:  </label>
                        <div class="col-sm-10">
                              <input type="text" name="txtPhone" id="txtPhone" value="" class="form-control" placeholder="Phone" required/>
                        </div>
                   </div>  
                     
                    <div class="form-group">  
                    <label for="lblGioiTinh" class="col-sm-2 control-label">Gender(*):  </label>
                    <div class="col-sm-10">                              
                        <div class="form-check">
                            <label class="radio-inline"><input type="radio" name="grpGender" value="0" id="grpRender"  class="form-check-input"/>
                            Male</label>
                        </div>
                        <div class="form-check">
                            <label class="radio-inline"><input type="radio" name="grpGender" value="1" id="grpRender" class="form-check-input"/>
                            
                            Female</label>
                        </div>

                    </div>
                    </div> 
                     
                    <div class="form-group"> 
                        <label for="lblNgaySinh" class="col-sm-2 control-label">Date of Birth(*):  </label>
                        <div class="col-sm-10">
                            <input type="date" id="txtBirth" name="txtBirth" class="form-control">
                           
                       </div>
                  </div>	
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                          <input type="submit"  class="btn btn-primary" name="btnRegister" id="btnRegister" value="Register"/>
                              
                    </div>
                 </div>
            </form>
</div>


<?php
include_once 'footer.php';
?>