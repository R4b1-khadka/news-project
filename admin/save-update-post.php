<?php 
include "config.php";
if(empty($_FILES['new-image']['name'])){
    $file_name= $_POST['old_image'];}
else{
 $erros=array();
        $file_name= $_FILES['new-image']['name'];
        // echo "---------------------$file_name---------------------------";
         $file_size= $_FILES['new-image']['size'];
         $file_tmp= $_FILES['new-image']['tmp_name'];
          $file_type= $_FILES['new-image']['type'];
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


 $sql="UPDATE post SET title = '{$_POST["post_title"]}', description='{$_POST["postdesc"]}', category={$_POST["category"]}, post_img='{$file_name}' WHERE post_id='{$_POST["post_id"]}'";

$result= mysqli_query($conn,$sql);

if($result){
  header("location:{$hostname}/admin/post.php");

}else{
  echo "query failed";
}