<html>
   <!DOCTYPE html>
   <html >
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>information</title>
    <style>
        .title{
            background-color:#2f94d2;
            height: 3rem;
            
            
            
        }
        .table{
            font-size: 18;
            width: 90%;
            margin: 0 auto;
            text-align: center;
            border-color:#2f94d2 ;
        }
        th{
            font-size: 24;
        }
        .input{
           position: relative;
           bottom: 2.5rem;
           left: 35%;
           font-size: 18;
           
        }
        .box{
            border-radius: 15px;
            width: 35%;
            height: 2rem;
            
            
        }
        h2{
            font-size: 24;
            position: relative;
            top: 0.5rem;
            
        }
        .button{
           position: relative;
           left: 90%;
           bottom: 5.5rem;
           border-radius: 15px;
           background-color:#92d6f8 ;
           height: 2rem;
           transition: background 0.1s, border-color 0.1s;
        }
        .button:focus {
        border-color: var(--color-primary);
    
        }
        h3{
            font-size: 24;
            position: relative;
            bottom: 3rem;
            left:  40%;
        }
        
        
    </style>
   </head>
   <body style="background: url(m.jpg);background-size: cover"> 
    <div class="title"  >
        <h2 >Contact informations</h2>
    </div>
        <form action="veiw.php" method="post" class="input" >
            <label for="search" >search</label>
            <input type="search" id="search" name="search" display="inline" class="box" placeholder=" entr your name or email">
            
        </form>
        
        <form action="veiw.php" method="Get" >
            <input type="submit" value="veiw all information " name="v" class="button">
        </form>
        <h3 style="color:red" id="exciption"></h3>
    <table border="2" class="table" >
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
        
        
<?php 
//this function for filtering information
    function  sanitizeInput($data) {
        $data=trim($data);
        $data=stripcslashes($data);
        $data=htmlspecialchars($data);
        return $data;} 

    require "contact.php";
    $text=[];
    //this part to view all information
    $lines=file("contactt.txt",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
       
    if($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET['v']))
    {
        veiw();
    }
    function veiw(){ 
        global $lines;
        global $text;
        foreach($lines as $line){
        $text=explode("\t",$line);
        if(count($text)===3){
            $contact=new Contact($text[0],$text[1],$text[2]);
            $contacts[]=$contact;
        }
        }
        foreach($contacts as $contact){
        echo"<tr>";
        echo "<td>{$contact->getName()}</td>";
        echo "<td>{$contact->getEmail()}</td>";
        echo "<td>{$contact->getPhone()}</td>";
        echo"</tr>";
    }   }
    
    

try{
    //this part for searching information
    $contacts[]=new Contact(null,null,null);
    $word=null;
    $isfinded=false;
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $word = sanitizeInput($_POST["search"]);
    }
   
   foreach($lines as $line){
    $text=explode("\t",$line);
    
    if($text[0]==$word||$text[1]==$word &&!empty($word) ) {
            $contact=new Contact($text[0],$text[1],$text[2]);
            $contacts[]=$contact;
            $isfinded=true;
        }
    }  
    if($isfinded==false && !empty($word)) {
        throw new Exception('<script>document.getElementById("exciption").innerHTML="this name or email is not existed!";</script>');
    }
    foreach($contacts as $contact){
        echo"<tr>";
        echo "<td>{$contact->getName()}</td>";
        echo "<td>{$contact->getEmail()}</td>";
        echo "<td>{$contact->getPhone()}</td>";
        echo"</tr>";
    }}
    catch(Exception $e){
        echo $e->getMessage();
        exit;

    }
    
   





    ?>
 </table>
 

 </body>
</html>


