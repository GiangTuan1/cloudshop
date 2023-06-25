<?php
include_once 'header.php';
include_once 'connect.php';
if (isset($_POST['btnSubmit'])) {
    $ID = $_POST['ID'];
    $Name = $_POST['Name'];
    $Price = $_POST['Price'];
    $Status = $_POST['Status'];
    $Des = $_POST['Des'];
    $Quantity = $_POST['Quantity'];
    $Cat = $_POST['Cat'];
    $Supplier = $_POST['Supplier'];
    $UserID = $_POST['UserID'];
    $img = str_replace(' ', '-', $_FILES['Pro_image']['name']); //tùy chỉnh hình ảnh
    $storedImange = "./images/"; //duobng792 dẫn lưu hình ảnh

    $flag = move_uploaded_file($_FILES['Pro_image']['tmp_name'], $storedImange . $img); //lưu hình vào upload vào trong project
    if ($flag) {
        $c = new Connect();
        $dblink = $c->connectToPDO(); //connectToMySQL();
        // $namep = $_GET['search'];//DÙng đối với PDO
        $sql = "INSERT INTO `product`(`pid`, `pName`, `price`, `status`, `image`, `description`, `quantity`, `cat_id`, `Supplier_ID`, `user_ID`) 
        VALUES (?,?,?,?,?,?,?,?,?,?)"; //CONCAT('%',:namep,'%')'%..%' là thể hiện sự tìm kiếm
        // <1>
        $re = $dblink->prepare($sql); //query con trỏ chuột ở vị trí đầu tiên //prepare trong tìm kiếm: chuẩn bị
        // $re->bindParam(':namep',$namep, PDO::PARAM_STR);
        // $re->execute();//Chỉ dùng cho bindParam
        $stmt = $re->execute(array($ID, $Name, $Price, $Status, $img, $Des, $Quantity, $Cat, $Supplier, $UserID));
        if ($stmt == TRUE) {
            echo "Congrats!";
        } else {
            echo "Failed!!!";
        }
    }
}
?>
<div id="main" class="container mt-4">
    <form class="form form-vertical" method="POST" enctype="multipart/form-data"> <!--upload được file cần có enctype -->
        <div class="form-body">
            <div class="row">

                <div class="col-12">

                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">ID</label>
                    <input type="text" class="form-control" name="ID" id="exampleFormControlInput1" placeholder="ID">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" name="Name" id="exampleFormControlInput1" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Price</label>
                    <input type="text" class="form-control" name="Price" id="exampleFormControlInput1" placeholder="Price">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Status</label>
                    <input type="text" class="form-control" name="Status" id="exampleFormControlInput1" placeholder="Status">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Description</label>
                    <input type="text" class="form-control" name="Des" id="exampleFormControlInput1" placeholder="Des">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                    <input type="text" class="form-control" name="Quantity" id="exampleFormControlInput1" placeholder="Quantity">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category</label>
                    <input type="text" class="form-control" name="Cat" id="exampleFormControlInput1" placeholder="Cat">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Supplier</label>
                    <input type="text" class="form-control" name="Supplier" id="exampleFormControlInput1" placeholder="Supplier">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">UserID</label>
                    <input type="text" class="form-control" name="UserID" id="exampleFormControlInput1" placeholder="UserID">
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="image-vertical">Image</label>
                        <input type="file" name="Pro_image" id="Pro_image" class="form-control" value="">
                    </div>
                </div>

                <div class="col-12 d-flex mt-3 justify-content-center">
                    <button type="submit" class="btn btn-warning me-1 mb-1 rounded-pill" name="btnSubmit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div> <!--main-->