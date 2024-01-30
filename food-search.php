<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 

            //Get the search Keyword
            $search = $_POST['search'];

            ?>
            <h2>Foods on Your Search <a href="#" class="text-white text-with-border">"<?php echo $search; ?>"</a></h2>
    
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
            //SQL Query to Get foods based on search keyword
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            
            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Check whether food is available or not
            if($count>0)
            {
                //Food available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
            ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php
                                        //Check whether the image is available or not
                                        if($image_name=="")
                                        {
                                            //Image not available
                                            echo "<div class='error'>Image not found.</div>";
                                        }
                                        else
                                        {
                                            //Image Available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                ?>
                        </div>
                        <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">RM<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?> </p>
                        <br>

                        <a href="<?php SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Add To Cart</a>
                        </div>
                    </div>
                    
                    <?php
                    
                }
                
            }
            else
            {
                //Food Not Available
                echo "<div class='error' style='text-align: center;'>Food not found.</div>";
            }
            ?>

            
            <div class="clearfix"></div>
        </div>
        <div style="text-align: center;">
            <?php echo "<form method='post' action='index.php'><input type='submit' value='Browse More Foods'></form>"; ?>
        </div>       
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>