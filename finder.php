<!DOCTYPE html>
<!-- saved from url=(0049)file:///C:/xampp/htdocs/myphpfile/RoutFinder.html -->
<html><?php
$db_name="train_inf";
$mysql_username="root";
$mysql_password="";
$server_name="localhost";
$conn=mysqli_connect($server_name,$mysql_username,$mysql_password,$db_name);
/*if($conn)
{
	echo "connection sucess";
}
else
{
	echo "connection not established";
}                                                                                       
echo "<br>";*/                                                                            /* till now all was about connection */                                    /* getting source and destination */
$arr=array();                                                    /* arr contains all the unique station names */                       
$gr=array();                                                     /* gr is 2d array ----adjacency matrix of graph */   
$mode=array();
$medium=array();
$res0=mysqli_query($conn,"SELECT count(id) FROM inf");
$i0=$res0->fetch_assoc();
$id=$i0["count(id)"];  //count is more better than max()

for($i=1;$i<=$id;$i++)                                             
{
    for($j=1;$j<=$id;$j++)
    {
        $gr[$i][$j]=0;                                    /* initialising all values to 0 in gr matrix meaning no path */
    }
}

$c=0;
for($i=1;$i<=$id;$i++)
{$flag=0;$flag2=0;
 $res1=mysqli_query($conn,"SELECT station1 FROM inf WHERE id=$i");
 $res2=mysqli_query($conn,"SELECT station2 FROM inf WHERE id=$i");
 $sta1=$res1->fetch_assoc();
 $sta2=$res2->fetch_assoc();
 $st1=$sta1["station1"];
 $st2=$sta2["station2"];
 //echo "<pre>".$st1."<br><p>next</p>".$st2."</pre";                                                          /* two satation got at particular id*/
 $res3=mysqli_query($conn,"select time from inf where id=$i");
 $ti=$res3->fetch_assoc();
 $time=$ti["time"];
 $res4=mysqli_query($conn,"select selector from inf where id=$i");
 $sel=$res4->fetch_assoc();
 $selector=$sel["selector"];
 $res5=mysqli_query($conn,"SELECT train_no FROM inf WHERE id=$i");
 $res6=mysqli_query($conn,"SELECT air_no FROM inf WHERE id=$i");
 $med1=$res5->fetch_assoc();
 $med2=$res6->fetch_assoc();
 $media1=$med1["train_no"];
 $media2=$med2["air_no"];
 $res7=mysqli_query($conn,"SELECT selector FROM inf WHERE id=$i");
 $sel=$res7->fetch_assoc();
 $select=$sel["selector"];
 /*echo $time."-".$selector;
 echo "<br>";*/
    for($j=1;$j<=$c;$j++)         /* line(45-86) now we are checking if the station is present in arr , if not then isert into arr */  
    {                                                                         
        if($arr[$j]==$st1)
        {
            $flag=1;
            $pos=$j;
        }
        if($arr[$j]==$st2)
        {
            $flag2=1;
            $pos2=$j;
        }
    }
    if($flag==0&&$flag2==0)              /* here we are also updating adjacency matrix gr with the time b/w the two station */
    {
     $arr[++$c]=$st1;
     $arr[++$c]=$st2;
     $gr[$c-1][$c-1]=0;
     $gr[$c][$c]=0;
     $gr[$c][$c-1]=$time;
     $gr[$c-1][$c]=$time;
     $mode[$c][$c-1]=$selector;
     $mode[$c-1][$c]=$selector;
        if($select==1)
        {
        $medium[$c][$c-1]=$media1;
        $medium[$c-1][$c]=$media1;
        }
        else
        {$medium[$c-1][$c]=$media2;
            $medium[$c][$c-1]=$media2;
        }
    }
    else if($flag==0&&$flag2==1)
    {
        $arr[++$c]=$st1;
        $gr[$c][$c]=0;
        $gr[$c][$pos2]=$time;
        $gr[$pos2][$c]=$time;
        $mode[$c][$pos2]=$selector;
        $mode[$pos2][$c]=$selector;
        if($select==1)
        {
        $medium[$c][$pos2]=$media1;
        $medium[$pos2][$c]=$media1;
        }
        else
        {$medium[$pos2][$c]=$media2;
            $medium[$c][$pos2]=$media2;
        }
        
    }
    else if($flag==1&&$flag2==0)
    {
        $arr[++$c]=$st2;
        $gr[$c][$c]=0;
        $gr[$c][$pos]=$time;
        $gr[$pos][$c]=$time;
        $mode[$c][$pos]=$selector;
        $mode[$pos][$c]=$selector;
        if($select==1)
        {
        $medium[$c][$pos]=$media1;
        $medium[$pos][$c]=$media1;
        }
        else
        {$medium[$pos][$c]=$media2;
            $medium[$c][$pos]=$media2;
        }
    }
   else
    {  
       if($gr[$pos][$pos2]<$time)
       {
       $gr[$pos][$pos2]=$time;
       $gr[$pos2][$pos]=$time;
       $mode[$pos][$pos2]=$selector;
       $mode[$pos2][$pos]=$selector;
           if($select==1)
        {
        $medium[$pos][$pos2]=$media1;
        $medium[$pos2][$pos]=$media1;
        }
        else
        {$medium[$pos][$pos2]=$media2;
            $medium[$pos2][$pos]=$media2;
        }
       }
    }
    
}?>
    
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
  <title>Route Finder</title>
<style type="text/css">
    h1{
    font-size: 30 px ;
    text-align: center;
  }
    p{
      font-size: 10 px;
      text-align: center;
    } 
  
    input[type=Submit]{
     width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 50px
   
}
 
  .footer{
    margin-top: 500px;
    
  }
  
  .header{
     margin-top: 0px;
     padding: 20 px 20 px  ;
     font-family: "Trebuchet MS", Helvetica, sans-serif;
     
  }
  .form{
    width: 40%;
    height:40%;
     background: #000000;
    padding: 30px;
    opacity: 0.8;
    display: flex;
   position: fixed;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%); 
    box-shadow: 5px 5px 2.5px #000000 ;
    z-index: -1;
    
  }
 input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
  label{
      margin-top: 10px;
      margin-bottom: 10px;
      color: #ffffff;
      font-family: "Trebuchet MS", Helvetica, sans-serif;
  }
body{
  background: linear-gradient( rgba(0, 0, 5, 0.5), rgba(0, 0, 0, 0.5) ), url(airplane-1024x640.jpg) no-repeat center center fixed; 
   -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
   background-size: cover;
    z-index: -1;
 
}
 
 #background{
  background: url(airplane-1024x640.jpg) no-repeat center center fixed; 
  -webkit-filter: blur(10px);     
    filter: blur(10px);
      -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
   background-size: cover;
    z-index: -1;
 }
</style></head>



<body>
        <header>
          <div class="header">

            <h1><i>Route Finder</i></h1> 
          </div>  
     
        </header>
        <div class="form">
        <form action="http://127.0.0.1/Route-Finder/graph.php" method="get">
        <label for="s"><b>Source</b></label>
        <select id="s" name="source" >
            <?php
for ($i=1;$i<=$c;$i++){
?>
<option value="<?=$arr[$i];?>"><?=$arr[$i];?></option>
<?php
}
            ?></select>
        <label for="d"><b>Destination</b></label>
        <select id="d" name="destination" > 
               <?php
for ($i=1;$i<=$c;$i++){
?>
<option value="<?=$arr[$i];?>"><?=$arr[$i];?></option>
<?php
                      }?></select>
        <input type="Submit" name="Submit" value="Get Route">
        
       </form></div>
      <footer>

      </footer>     




</body></html>