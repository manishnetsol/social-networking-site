<?php
$title = "Dashboard";
$currentPage = 'home.php';
include 'includes/header.php';
?>
<?php

if(isset($_POST['sub'])){
    global $conn;
    global $user_id;
    $content = $_POST['content'];
    $upload_image = $_FILES['upload_image']['name'];
    $image_tmp = $_FILES['upload_image']['tmp_name'];
    $random_number = rand(1, 100);

    if(strlen($content) > 250)
    {
        echo "sdfghjgerthj";
         echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
        echo "<script>window.open('home.php', '_self')</script>";
        //header('location:home.php');
    }
    else
    {
        if(strlen($upload_image) >= 1 && strlen($content) >= 1)
        {
            move_uploaded_file($image_tmp, "imagepost/$upload_image");
            $insert = "insert into posts ( user_id,caption, post_url) values('$user_id', '$content', '$upload_image')";

            $run = mysqli_query($conn, $insert);

            if($run)
            {
             
               echo "<script>alert('uploaded!')</script>";
                 echo "<script>window.open('home.php', '_self')</script>";
               // header('location:home.php');

         
            }
            exit();
        }
        else
        {
            if($upload_image=='' && $content == '')
            {
                 echo "<script>alert('Error Occured while uploading!')</script>";
                echo "<script>window.open('home.php', '_self')</script>";
               // header('location:home.php');
            }
            else
            {
                if($content=='')
                {
                    move_uploaded_file($image_tmp, "imagepost/$upload_image");
                    $insert = "insert into posts (user_id,caption,post_url) values ('$user_id','--','$upload_image')";
                    $run = mysqli_query($conn, $insert);

                    if($run)
                    {
                        echo "<script>alert('Your Post updated a moment ago!')</script>";
                        echo "<script>window.open('home.php', '_self')</script>";
                        //header('location:home.php');
                    }

                    exit();
                }
                else
                {
                    $insert = "insert into posts (user_id,caption) values( '$user_id','$content')";
                    $run = mysqli_query($conn, $insert);

                    if($run)
                    {
                        echo "<script>alert('Your Post updated a moment ago!')</script>";
                         echo "<script>window.open('home.php', '_self')</script>";
                        //header('location:home.php');
                    }
                }
            }
        }
    }
}

?>


<div class="wrapper">
<?php
include 'includes/sidebar.php';
?>

        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
            </nav>
            <div class="row ">
                <div id="insert_post" class="col-sm-6">
                    <form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" 
                            enctype="multipart/form-data">
                        <textarea class="form-control" id="content" rows="4" name="content"
                            placeholder="What's in your mind?" style="font-size:18px"></textarea><br>
                        <label class="btn btn-warning" id="upload_image_button">Select Image
                            <input type="file" name="upload_image" size="300">
                        </label>
                        <button id="btn-post" class="btn btn-success" name="sub">Post</button>
                    </form>	
                    
                </div>
        </div>
</div>

</div>



<?php
include 'includes/footer.php';
?> 

<script src="./assets/js/sidebar.js"></script> 