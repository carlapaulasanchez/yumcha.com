<?php include('partials-front/menu.php'); ?>

<?php
    //check whether food id is set or not
    if(isset($_GET['food_id']))
    {
        //get the food id and details of the selected food
        $food_id = $_GET['food_id'];

        //get the details of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        //Execute the query
        $res = mysqli_query($conn, $sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check whether the data isavailable or not
        if($count==1)
        {
            //we have data
            //GET THE DATA FROM DATABASE
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            //food not available
            //redirect to home pAGE
            header('location:' .SITEURL);
        }
    }
    else
    {
        //redirect the message
        header('location:' .SITEURL);
    }

?>

<!--food search section starts here-->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-black"> Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend> Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                        //check whether image is available or not
                        if($image_name=="")
                        {
                            //image not available
                            echo "<div class= 'error'>Image not available.</div>";
                        }
                        else
                        {
                            //image available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Milk-tea" class="img-responsive img-curve">
                            <?php
                        }
                    
                    ?>
                    
                </div>

        <div class="food-menu-desc">
            <h3><?php echo $title; ?></h3>
            <input type="hidden" name="food" value="<?php echo $title; ?>">

            <p class="food-price">₱<?php echo $price; ?></p>
            <input type="hidden" name="price" value="<?php echo $price; ?>">

            <div class="order-label">Quantity</div>
            <input type="number" name="qty" class="input-responsive" value="1" required>

        </div>
    </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label"> Full Name</div>
                <input type="text" name="full_name" placeholder="E.g. Carla Paula Sanchez" class="input-responsive" required>

                <div class="order-label"> Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 09843xxxxxx" class="input-responsive" required>

                <div class="order-label"> Email</div>
                <input type="email" name="email" placeholder="E.g. abcde12@gmail.com" class="input-responsive" required>
                
                <div class="order-label"> Address</div>
                <textarea name="address" rows="10" placeholder=" E.g. Street, City, Country" class="input-responsive" required> </textarea>  
                
                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <?php

            //check whether button is clicked or not
            if(isset($_POST['submit']))
            {
                //get all the details from the form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty; //total = price x qty

                $order_date = date("Y-m-d h:i:sa"); //order date
                $status = "Ordered"; //ordered, On delivery, Delivered, Cancelled

                $customer_name = $_POST['full_name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                //save the order in data base
                //create sql to save the data
                $sql2 = "INSERT INTO tbl_order SET
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                ";

                //echo $sql2; die();

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check whether query executed succesfully or not
                if($res2==true)
                {
                    //query executed and order saved
                    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                    header('location:' .SITEURL);
                }
                else
                {
                    //failed to save order
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Order.</div>";
                    header('location:' .SITEURL);
                }

                
            }

        ?>
    </div>
</section>
<!--food search section ends here-->

<?php include('partials-front/footer.php'); ?>
