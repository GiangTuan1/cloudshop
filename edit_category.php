<?php
include_once 'header.php';
?>

<body>
    <!-- Sidebar -->
    <!-- div content -->
    <div id="main" class="container">
        <div className="page-heading pb-2 mt-4 mb-2 ">
            <h1>Product Category</h1>
        </div>
        <?php
           //put your code here
           require_once 'connect.php';
           $conn = new Connect();
           $db_link = $conn->connectToPDO();
           if(isset($_POST['oldcid']) && isset($_POST['txtID']) && isset($_POST['txtName'])):
           $oldcid = $_POST['oldcid'];
           $cid = $_POST['txtID'];
           $cname = $_POST['txtName'];
        if(isset($_POST['btnUpdate'])):
                $sqlupdate = "update category set cat_id = ?, catName =? where cat_id =?";
                $stmt = $db_link->prepare($sqlupdate);
                $execute = $stmt->execute(array("$cid","$cname","$oldcid"));
                if($execute){
                        header("Location: product_management.php");
                } else{
                        echo "Failed".$execute;
                }
        endif;
endif;
        ?>

        <?php
        if(isset($_GET['cid'])){ 
                $c = new connect();
                $dblink = $c->connectToMySQL();
                $catid = $_GET['cid']; 
                $sqlcatname = "select catName from category where cat_id='" . $catid ."'";
                $re = $dblink->query($sqlcatname);
                $catnamedb = $re->fetch_row();
                ?>
        <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
            <div class="form-group pb-3">
                <label for="txtTen" class="col-sm-2 control-label">Category ID(*): </label>
                <div class="col-sm-10">
                    <input type="text" name="txtID" id="txtID" class="form-control" placeholder="category ID"
                        value="<?php echo $catid?>">
                </div>
            </div>
            <div class="form-group pb-3">
                <label for="txtTen" class="col-sm-2 control-label">Category Name(*): </label>
                <div class="col-sm-10">
                    <input type="text" name="txtName" id="txtName" class="form-control" placeholder="category Name"
                        value="<?php echo $catnamedb[0]?>">
                </div>
            </div>


            <div class="form-group pb-3">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value='Update' />
                    <input type="hidden" class="btn btn-primary" name="oldcid" id="oldcid"
                        value="<?php echo $catid?>" />
                    <input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Back to list"
                        onclick="window.location.href='product_management.php'" />

                </div>
            </div>
        </form>
        <?php } ?>
    </div>
    <!--main-->
</body>

</html>