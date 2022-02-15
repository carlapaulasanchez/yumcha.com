<?php include('partials-front/menu.php'); ?>

<?php
    //check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        //Category id is not set amd get the id
        $category_id = $_GET['category_id'];
        //Get the category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //execute the query
        $res = mysqli_query($conn, $sql);
        //get the value from database
        $row = mysqli_fetch_assoc($res);
        //get the title
        $category_title = $row['title'];
    }
    else
    {
        //category not passed
        //rediret to home page
        header('location:' .SITEURL);
    }
?>

<!--food search section starts here-->
    <section class="food-search text-center">
        <div class="container">
            <h2> Foods on <a href="#" class="text-black">"<?php echo $category_title; ?>"</a></h2>
        </div>
    </section>
    <!--food search section ends here-->

    <!--food menu section starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //create sql query to get foods based on selected category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                //excecute the query
                $res2 = mysqli_query($conn, $sql2);

                //count the rows
                $count2 = mysqli_num_rows($res2);

                //check whether food is available or not
                if($count2>0)
                {
                    //Food is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        //get the values
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $description = $row2['description'];
                        $price = $row2['price'];
                        $image_name = $row2['image_name'];
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
                    //food is not availble
                    echo "<div class= 'error'>Food not available.</div>";
                }
            
            ?>

            <div class="clearfix"> </div>

        </div>
    </section>
    <!--food menu section ends here-->

<?php include('partials-front/footer.php'); ?>