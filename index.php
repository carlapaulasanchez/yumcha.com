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

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset ($_SESSION['order']);
        }
    ?>

    <!--categories section starts here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                //create sql query to display categories from data base
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //category is available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the value like title,image_name and ID
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    //check whether image is available or not
                                    if($image_name=="")
                                    {
                                        //display message
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Milk-tea" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a> 

                        <?php

                    }
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!--categories section ends here-->

    <!--food menu section starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //getting foods from database that are active and featured
                //sql query
                $sql2 = "SELECT * FROM  tbl_food WHERE active='Yes' AND featured='Yes' Limit 6";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //countt rows
                $count2 = mysqli_num_rows($res2);

                //check food available or not
                if($count2>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //get all the value
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
                                        echo "<div class= 'error'>Image not Available.</div>";
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
                    echo "<div class= 'error'>Food not available.</div>";
                }
            ?>


            

            <div class="clearfix"> </div>

        </div>
        <p class="text-center">
            <a href="#"> See All Foods </a>
        </p>
    </section>
    <!--food menu section ends here-->

    <?php include('partials-front/footer.php'); ?>

    