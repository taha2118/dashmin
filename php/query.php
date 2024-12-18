<?php
include("connection.php");

$catImgAddress = 'img/categories/';
$prodImgAddress = 'img/product/';

if(isset($_POST['AddCategory'])){
    $name = $_POST['catName'];
    $imageName = $_FILES['catImage']['name'];
    $imageObject = $_FILES['catImage']['tmp_name'];
    $extension = pathinfo($imageName, PATHINFO_EXTENSION);
    $pathDirectory = 'img/categories/'.$imageName;
    if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "webp") {
if(move_uploaded_file($imageObject, $pathDirectory)){
    $query = $pdo ->prepare("insert into categories(name, image) values (:pn, :pimg)");
    $query -> bindParam("pn", $name);
    $query -> bindParam("pimg", $imageName);
    $query -> execute();
    echo "<script>alert('data submitted successfully');</script>";
    // header("Location: " . $_SERVER['PHP_SELF']);
    // exit;

}
}else{
    echo "<script>alert('invalid file type use only jpeg,png,jpg or webp');</script>";
}
}




//update categories
if(isset($_POST['UpdateCategory'])){
    $name = $_POST['catName'];
    $id = $_POST['catId'];
    if(!empty($_FILES['catImage']['name'])){
        $imageName = $_FILES['catImage']['name'];
        $imageObject = $_FILES['catImage']['tmp_name'];
        $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $pathDirectory = 'img/categories/'.$imageName;
        if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "webp") {
    if(move_uploaded_file($imageObject, $pathDirectory)){
        $query = $pdo ->prepare("update categories set name = :catName, image = :catImage where id = :catId");
        $query -> bindParam("catId", $id);
        $query -> bindParam("catName", $name);
        $query -> bindParam("catImage", $imageName);
        $query -> execute();
        echo "<script>alert('data updated successfully');</script>";
        // header("Location: " . $_SERVER['PHP_SELF']);
        // exit;
    
    }
    }else{
        echo "<script>alert('invalid file type use only jpeg,png,jpg or webp');</script>";
    }
    }else{
        $query = $pdo ->prepare("update categories set name = :catName where id = :catId");
        $query -> bindParam("catId", $id);
        $query -> bindParam("catName", $name);
        $query -> execute();
        echo "<script>alert('data updated successfully');</script>";
    }
}


//delete categories


if(isset($_POST['deleteCategory'])){
    $id = $_POST['catId'];
    $query = $pdo ->prepare("delete from categories where id = :catId");
    $query -> bindParam("catId", $id);
    $query -> execute();
    echo "<script>alert('data deleted successfully');</script>";

}





//add products
if(isset($_POST['AddProduct'])){
    $prodQuantity = $_POST['prodQuantity'];
    $prodPrice = $_POST['prodPrice'];
    $prodCatId = $_POST['prodCatId'];
    $prodImage = $_FILES['prodImage']['name'];
    $prodDesc = $_POST['prodDesc'];
    $prodName = $_POST['prodName'];
$prodTmpName = $_FILES['prodImage']['tmp_name'];
$extension = pathinfo($prodImage, PATHINFO_EXTENSION);
$PathAddress = 'img/product/'.$prodImage;
if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "webp") {
    if(move_uploaded_file($prodTmpName, $PathAddress)){
        $query = $pdo ->prepare("insert into products(productName, productQuantity,productImage, productPrice, productCatId, productDesc) values (:pn, :pq, :pi, :pp, :pci, :pd)");
        $query -> bindParam("pn", $prodName);
        $query -> bindParam("pi", $prodImage);
        $query -> bindParam("pq", $prodQuantity);
        $query -> bindParam("pp", $prodPrice);
        $query -> bindParam("pd", $prodDesc);
        $query -> bindParam("pci", $prodCatId);
        $query -> execute();
        echo "<script>alert('Product submitted successfully');</script>";
    }else{
        echo "<script>alert('Something went wrong');</script>";

    }
   
}
else{
    echo "<script>alert('Error!');</script>";

}
    
}












//delete product
if(isset($_POST['deleteProduct'])){
    $id = $_POST['prodId'];
    $query = $pdo ->prepare("delete from products where productId = :prodId");
    $query -> bindParam("prodId", $id);
    $query -> execute();
    echo "<script>alert('product deleted successfully');</script>";

}







//update product
if(isset($_POST['UpdateProduct'])){
    $prodId = $_POST['prodId'];
    $prodName = $_POST['prodName'];
    $prodQuantity = $_POST['prodQuantity'];
    $prodDesc = $_POST['prodDesc'];
    $prodPrice = $_POST['prodPrice'];
    $prodCatId = $_POST['prodCatId'];
    if(!empty($_FILES['prodImage']['name'])){
        $prodImage = $_FILES['prodImage']['name'];
        $prodTmpName = $_FILES['prodImage']['tmp_name'];
        $extension = pathinfo($prodImage, PATHINFO_EXTENSION);
        $PathAddress = 'img/product/'.$prodImage;
        if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "webp") {
    if(move_uploaded_file($prodTmpName, $PathAddress)){
        $query = $pdo ->prepare("update products set productName = :pname, productQuantity = :pquantity, productImage = :pimage, productPrice = :pprice, productCatId = :pcatid, productDesc = :pdesc where productId = :pid");
        $query -> bindParam("pid", $prodId);
        $query -> bindParam("pname", $prodName);
        $query -> bindParam("pimage", $prodImage);
        $query -> bindParam("pquantity", $prodQuantity);
        $query -> bindParam("pprice", $prodPrice);
        $query -> bindParam("pcatid", $prodCatId);
        $query -> bindParam("pdesc", $prodDesc);

        $query -> execute();
        echo "<script>alert('product updated successfully');</script>";
        // header("Location: " . $_SERVER['PHP_SELF']);
        // exit;
    
    }
    }else{
        echo "<script>alert('invalid file type use only jpeg,png,jpg or webp');</script>";
    }
    }else{
        $query = $pdo ->prepare("update products set productName = :pname, productQuantity = :pquantity, productPrice = :pprice, productCatId = :pcatid, productDesc = :pdesc where productId = :pid");
        $query -> bindParam("pid", $prodId);
        $query -> bindParam("pname", $prodName);
        $query -> bindParam("pquantity", $prodQuantity);
        $query -> bindParam("pprice", $prodPrice);
        $query -> bindParam("pcatid", $prodCatId);
        $query -> bindParam("pdesc", $prodDesc);
        $query -> execute();
        echo "<script>alert('product updated successfully');</script>";
    }
}


?>