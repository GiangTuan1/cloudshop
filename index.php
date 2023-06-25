<?php
    include_once 'header.php';
    ?>

<div class="container px-2 py-7">
    <div class="py-2">
        <form method="post" action = "search.php"> 
        <input type="text" id="searchbox" name="searchbox" value="" />
        <input type="submit" id="btnSearch" name="btnSearch" class="btn btn-primary" value="Search &#x1F50E" />
        </form>
    </div>
    <div class="container px-4 py-1">
        <h2>All Product </h2>
        <div class="row">
            <?php
                include_once 'connect.php';
                $c = new connect();
                $dblink = $c->connectToMySQL();
                if(isset($_GET['categoryid'])){
                    $categoryid = $_GET['categoryid'];
                    $sql = "SELECT * FROM product where cat_id='".$categoryid."'";
                }else{
                    $sql = "SELECT * FROM product";
                }
                //<l>
                $re = $dblink->query($sql);
                // $row1 = $re->fetch_row();
                // echo $row1[5];
                echo "<br>";
                $re->data_seek(0);
                if($re->num_rows>0):
                    while($row = $re->fetch_assoc()):
                        if($row['quantity'] > 0){
                        
                ?>
            <div class="col-md-4 pb-3">
                <div class="display-flex">
                    <div class="card">
                        <img style="width:auto; height: 300px;" src="./asset/img/<?=$row['image']?>"
                            class="card-img-top" alt="Product1>" />

                        <div class="card-body">

                            <a href="detail.php?id=<?=$row['pid']?>" class="text-decoration-none">
                                <h5 class="card-title"><?=$row['pName']?></h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted"><span>&#8363;</span><?=$row['price']?></h6>
                            <a href="detail.php?id=<?=$row['pid']?>" class="btn btn-primary" class="text-decoration-none">Add To Cart<h5?>
                                    </h5></a>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                        }
            endwhile;
            else:
                echo "Not found";
            endif;
            ?>
        </div>
    </div>
</div>
<?php
include_once 'footer.php';
?>

</html>