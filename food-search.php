<?php include('partials-front/menu.php'); ?>

<!--food search section starts here-->
<section class="food-search text-center">
        <div class="container">
            
            <?php
                //Get the search keyword
                //$search = ($_POST['search']); -old method
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>

            <h2> Foods on Your Search <a href="#" class="text-black">"<?php echo $search; ?>"</a><h2>

        </div>
    </section>
    <!--food search section ends here-->

<!--food menu section starts here-->
         <section class="food-menu">
             <div class="container">
                 <h2 class="text-center">Food Menu</h2>

                 <?php
                        

                        //sql query based on search kewoard
                        //$search = 'burger'
                        //"SELECT * FROM tbl_food WHERE title LIKE '%burger%' OR description LIKE '%burger%'";
                        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                        //execute the query
                        $res = mysqli_query($conn, $sql);

                        //count rows
                        $count = mysqli_num_rows($res);

                        //check whether food available or not
                        if($count>0)
                        {
                            //Food available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the details
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $description = $row['description'];
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
                            //Food not available
                            echo "<div class= 'error'>Food not found.</div>";
                        }

                 ?>

     
                 
     
                 <div class="clearfix"> </div>
     
             </div>
         </section>
         <!--food menu section ends here-->

<?php include('partials-front/footer.php'); ?>