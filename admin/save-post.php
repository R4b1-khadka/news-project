<?php include "config.php";
session_start();
       if(isset($_FILES['fileToUpload'])){
        $erros=array();
        $file_name= $_FILES['fileToUpload']['name'];
        echo "---------------------$file_name---------------------------";
         $file_size= $_FILES['fileToUpload']['size'];
         $file_tmp= $_FILES['fileToUpload']['tmp_name'];
          $file_type= $_FILES['fileToUpload']['type'];
           $file_ext= strtolower(end(explode('.',$file_name)));
           $entensions=array('jpeg','jpg','png');
           if(!in_array($file_ext,$entensions)){
            $errors[]="this extension is not allowed. please chose jpg, jpeg or png";
           }

           if($file_size>2097152){
            $errors[]='File size must be less than 2 MB';
           }
           if(empty( $errors)===true){
            move_uploaded_file($file_tmp,'./upload'.$file_name);
           }else{
             print_r($errors);
             die();
           }
       }

    $title= mysqli_real_escape_string($conn,$_POST['post_title']);
    $description= mysqli_real_escape_string($conn,$_POST['postdesc']);
    $category= mysqli_real_escape_string($conn,$_POST['category']);
    $date= date("d M, Y");
    $author= $_SESSION['user_id'];
    $sql="INSERT INTO post(title, description, category, post_date, author, post_img) VALUES('{$title}', '{$description}', '{$category}', '{$date}', '{$author}', '{$file_name}');";
  
    $sql .="UPDATE category SET post= post+1 WHERE category_id= {$category};";
    echo $sql;
    if(mysqli_multi_query($conn,$sql)){
        header("Location: {$hostname}/admin/post.php");
    }else{
        echo "<div class='alert alert-danger'>can't run query</div>";
    }
?>