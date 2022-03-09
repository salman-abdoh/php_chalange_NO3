<?php

session_start();
$conn=mysqli_connect("localhost","root","","products");

/*if(isset($_GET["add_to_cart"]) == 'add'){
    $id = $_GET['id'];
    if(isset($_SESSION['cartpro'][$id])){
        $item_id = $_SESSION['cartpro'][$id]['quantity'];
        $_SESSION['cartpro'][$id] = array(
            "id"=>$id,
            "name"=> $_POST['name'],
            "image"=> $_POST['image'],
            "descr"=> $_POST['descr'],
            "price"=> $_POST['price'],
            "quantity"=> $_POST['quantity']);
    }else{
        $_SESSION['cartpro'][$id] = array(
            "id"=>$id,
            "name"=> $_POST['name'],
            "image"=> $_POST['image'],
            "descr"=> $_POST['descr'],
            "price"=> $_POST['price'],
            "quantity"=> $_POST['quantity']
        );
    }*/
    if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["item_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["item_cart"], "id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["item_cart"]);  
                $item_array = array(  
                     'id'               =>     $_GET["id"],  
                     'name'               =>     $_POST["name"], 
                     'image'               =>     $_POST["image"],  
                     'descr'               =>     $_POST["descr"],   
                     'price'          =>     $_POST["price"],  
                     'quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["item_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="index.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
            'id'               =>     $_GET["id"],  
            'name'               =>     $_POST["name"], 
            'image'               =>     $_POST["image"],  
            'descr'               =>     $_POST["descr"],   
            'price'          =>     $_POST["price"],  
            'quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["item_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["item_cart"] as $keys => $values)  
           {  
                if($values["id"] == $_GET["id"])  
                {  
                     unset($_SESSION["item_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="index.php"</script>';  
                }  
           }  
      }  
 }  
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
   
   
       
</head>

<body>
<div class="container ">
            <h1 class="headerh text-center text-dark mb-3 ">products </h1>
             
        <?php  
        $query = "SELECT * FROM items ";  
        $result = mysqli_query($conn, $query);  
        if(mysqli_num_rows($result) > 0)  
        {  
             while($item = mysqli_fetch_array($result))  
             {  
                
                ?>
                 <div class="col-md-4">
                <form action="index.php?action=add&id=<?php echo  $item['id'];?>" method="POST">
                
            <div class="text-info"><?php echo  $item['name']?></div>
            <div class="product-image"><img src="<?php echo $item['image']; ?>"></div>
			<div class="text-danger"><?php echo  $item['descr'];?></div>
			<div class="text-danger"><?php echo  $item['price'];?></div>
			<input type="text" class="form-control" name="quantity" value="1"  />
                      <input type="hidden" name="name" value="<?php echo  $item['name'];?>">
                      <input type="hidden" name="image" value="<?php echo  $item['image']?>">
                     
                    <input type="hidden" name="descr" value="<?php echo  $item['descr'];?>">
                    <input type="hidden" name="price" value="<?php echo  $item['price'];?>">
                    <input type="hidden" name="quantity" value="1">
            <input type="submit" value="Add to Cart" style="margin-top:5px;" class="btn btn-seccess" name="add_to_cart" />
			
			</form>
		
                   
        </div>   <?php }}?>
             
                <div style="clear:both"></div>  
                <br />  
                <h3>Order Details</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["item_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["item_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["name"]; ?></td>  
                               <td><?php echo $values["quantity"]; ?></td>  
                               <td>$ <?php echo $values["price"]; ?></td>  
                               <td>$ <?php echo number_format($values["quantity"] * $values["price"], 2); ?></td>  
                               <td><a href="index.php?action=delete&id=<?php echo $values["id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["quantity"] * $values["price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" >Total</td>  
                               <td >$ <?php echo number_format($total, 2); ?></td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
    </script>
</body>
</html>