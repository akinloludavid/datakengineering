<?php
  $msg = '';
  $msgClass = ''

  if (filter_has_var(INPUT_POST, 'submit')) {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if(!empty($email) && !empty($name) && !empty($message)){

      if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
        $msg = 'Enter a valid email';
        $msgClass = 'alert-danger';
      }else {
        $toEmail = 'akinloludavid27@yahoo.com';
        $subject = 'Contact Request from '.$name;
        $body ='<h1>Contact Request</h1>
                <h4>Name</h4><p>'.$name.'</p>
                <h4>Email</h4><p>'.$email.'</p>
                <h4>Message</h4><p>'.$message.'</p>
                ';

        $headers = "MIME-Version: 1.0" ."\r\n";
        $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " .$name. "<".$email.">". "\r\n";

        if(mail($toEmail, $subject, $body, $headers)){
          $msg = 'Your email has been sent';
          $msgClass = 'alert-success';
        }else {
          $msg = 'Your email was not sent';
          $msgClass = 'alert-danger';
        }
      }

    }else{
      $msg= 'Please fill in all fields';
      $msgClass = 'alert-danger';
    }
  };
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <?php if($msg !=''): ?>
      <div class="alert <?php echo $msgClass; ?>">
        <?php echo $msg; ?>
      </div>
    <?php endif; ?>
    <form method="post" action ="<?php echo $_SERVER['PHP_SELF']; ?>"
    >
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="email" name ="name" class="form-control" id="username" value="<?php echo isset($_POST['name']) ?$name:''; ?>">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" name = "email" class="form-control" value="<?php echo isset($_POST['email']) ?$email:''; ?>">
      </div>
      <div class="form-group">
        <label for="">Message</label>
        <textarea name ="message">
          <?php echo isset($_POST['message']) ?$message:''; ?>
        </textarea>
      </div>
    
      <button type="submit" name ="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>

</body>
</html>