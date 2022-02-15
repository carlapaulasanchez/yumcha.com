<?php include('partials-front/menu.php'); ?>
     
<!--food search section starts here-->
         <section class="food-search text-center">
             <div class="container">
                
                <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                    <input type="search" name="search" placeholder="Search for Food.." required>
                    <input type="submit" name="submit" value="Search" class="btn btn-primary">
                </form>

             </div>
         </section>
         <!--food search section ends here-->
     
         <!--food menu section starts here-->
         <section class="food-menu">
             <div class="container">
                 <h2 class="text-center">Food Menu</h2>

                 <?php
                    //display food that are active
                    $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows
                    $count = mysqli_num_rows($res);

                    //check whether categories available or not
                    if($count>0)
                    {
                        //food available
                        while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class= "food-menu-img">
                                <?php 
                                    //check whether image available or not
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
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">₱<?php echo $price; ?></p>
                                <p class="food-details"> 
                                     <?php echo $description; ?>       
                                </p>
                                <br>
            
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary"> Order Now</a>
            
                            </div>   
                        </div>

                        <?php
                        }   

                    }
                    else
                    {
                        //food not available
                        echo "<div class= 'error'>Food not found.</div>";
                    }
                 ?>
     
                

     
                 <div class="clearfix"> </div>
     
             </div>
         </section>
         <!--food menu section ends here-->
     
<?php include('partials-front/footer.php'); ?>