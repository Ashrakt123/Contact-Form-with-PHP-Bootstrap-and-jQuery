<?php
include 'connect.php' ;
//check if user coming from a request
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $user = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
   $phone = filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
   $message = filter_var($_POST['message'],FILTER_SANITIZE_STRING);
   $header ='from:'. $email . '\r\n';
   $errors = array();
   if(strlen($user)<= 3){
    $errors[]= 'the name must <strong> bigger than 3char';
}
  if(empty($email)){
    $formerrors[]= 'email<strong> empty </strong>';
}	
   if(empty($errors)){
    $stmt=$con->prepare("INSERT INTO form
                              (Username , Email ,Phone, Message)
                              VALUES (:vname , :vemail ,  :vphone, :vmess )");
 //تنفيذ للقيم اللى جايه من الفورم
    $stmt ->execute(array(
       'vname' =>$user ,
       'vemail'=>$email ,
       'vmess'=>$message ,
       'vphone'=>$phone


      ));
       mail('ashraktamin@gmail.com' ,'contact form' , $message ,$header);
   }
}

?>


<DOCTYPE html>

    <html lang='en'>
        <head>
            <meta charset ='utf-8'>
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>form</title>
            <link rel="stylesheet" href="css/bootstrap.min.css"></link>
            <link rel="stylesheet" href="css/font-awesome.css"></link>
            <link rel="stylesheet" href="css/backend.css"></link>

</head>
<body>
            <h1 class="text-center">Contact Me</h1>
			<div class="container">
            <form class="form" action=<?php echo $_SERVER['PHP_SELF'] ?> method="post">
            <?php
             if(! empty($errors)){?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert"></button>
                <?php 
                  foreach($errors as $e){
                        echo  $e ;
                     }
                ?>
                     </div>
                     <?php  } ?>
				   <input type="text"  name="username" vlaue='<?php if(isset($user)){echo $user;} ?>' class="form-control" autocomplete="off" required ='required'  placeholder="Username To Login Into Shop"/>
                   <i class="fa fa-user fa-fw"></i>
				   
                   <input type="email"  name="email" vlaue='<?php if(isset($email)){echo $email;} ?>' required ='required'  class="form-control" placeholder="Enter Your Email"/>
                   <i class="fa fa-envelope fa-fw"></i>

                   <input type="text"  name="phone" vlaue='<?php if(isset($phone)){echo $phone;} ?>' required ='required' class="form-control" placeholder="Enter Your phone"/>
                   <i class="fa fa-phone fa-fw"></i>

                   <textarea class="form-control" vlaue='<?php if(isset($message)){echo $message;} ?>' required ='required'  name ="message"></textarea>
                   
				   <input type="submit" value="Send" class="btn btn-success " />

            </form>
         </div>
			


    <script src="js/JQuery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/backend.js"></script>


</body>
        </html>