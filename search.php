<?php
    include_once 'header.php';
    ?>
<div class="container px-2 py-7">
    <div class="py-2">
        <form method="post" action="search.php">
            <input type="text" id="searchbox" name="searchbox" value="" />
            <input type="submit" id="btnSearch" name="btnSearch" class="btn btn-primary" value="Search &#x1F50E" />
        </form>
    </div>
    <div class="container px-4 py-1">
        <h2>All product</h2>
        <div class="row">
            <?php
            include_once 'connect.php';
            $c = new Connect();
            $dblink = $c->connectToPDO();
            $nameP = $_POST['searchbox'];
            $sql = "SELECT * FROM product Where pName LIKE ?";
            
            $re = $dblink->prepare($sql);
           // $re->bindparam(':nameP',$nameP, PDO ::PARAM_STR);
            $re->execute(array("%$nameP%"));
            $rows = $re->fetchAll(PDO::FETCH_BOTH);
            
            foreach($rows as $r):
                        ?>
            <div class="col-md-4 pb-3">
                <div class="display-flex">
                    <div class="card">
                        <img src="../asset/img/<?=$r['image']?>" class="card-img-top" alt="Product1>" style="margin: auto;
                        width: auto; height: 290px;" />
                        <div class="card-body">
                            <a href="detail.php?id=<?=$r['pid']?>" class="text-decoration-none">
                                <h5 class="card-title"><?=$r['pName']?></h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted"><span>&#8363;</span><?=$r['price']?></h6>
                            <a href="#" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            endforeach;
            //else:
            //   echo "Not found";
            ?>
        </div>
    </div>
    <?php
include_once 'footer.php';
?>