<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Informatin</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="container">
        <form class="form" method="post" action="index.php">
            <h1 class="form__title">contact information</h1>
            <div class="form_input-group">
                <input type="text" class="form__input" placeholder="name" name="name" required>
            </div>
            <div class="form__input-group-m">
                <input type="email" class="form__input" placeholder="Email" name="email" required>
            </div>
            <div class="form__input-group">
                <input type="tel" class="form__input" placeholder="phone number" pattern="[+0-9]{8,}" name="phone" required oninvalid="this.setCustomValidity('يرجى ادخال رقم صحيح')" oninput="setCustomValidity('')">
            </div>
            <div>
                <h5 style="color:red" id="error"></h5>
            </div>
            <input type="submit" value="save" class="form__submit">
            <button class="form__button">
            <a href="veiw.php" >contacts</a>
            </button>
        </form>
    </div>
</body>
</html>
<?php 
 function  sanitizeInput($data) {
    $data=trim($data);
    $data=stripcslashes($data);
    $data=htmlspecialchars($data);
    return $data;}
    
    $name=$email=$phone="";
    $nameErr ="";
    $path="contactt.txt";
    try{
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["phone"])) {
            throw new Exception('<script>document.getElementById("error").innerHTML="fill all the fields";</script>');
        }else{
            
            $name = sanitizeInput($_POST["name"]);
            if(!preg_match("/^[a-zA-Z ]*$/", $name)) {
                throw new Exception('<script>document.getElementById("error").innerHTML="Only letters and white space allowed!";</script>');
            }
            $email = sanitizeInput($_POST['email']);
            $phone = sanitizeInput($_POST["phone"]);    
    }
     $contant=file_get_contents($path);
        if(str_contains($contant,$email) & !empty($email) ) {
            throw new Exception('<script>document.getElementById("error").innerHTML="this email is already existed!";</script>');
        }else{
            $data=$name."\t".$email."\t".$phone;
            file_put_contents($path,$data.PHP_EOL,FILE_APPEND);
    }}}
    catch(Exception $e) {
        echo $e->getMessage();
        exit;
    }

        
    
   
        

    
    