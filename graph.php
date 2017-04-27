<!DOCTYPE html>
<html>
<link type="text/css" rel="stylesheet" href="style2.css"/>
<body>
    <h1>Following best path is found</h1>
<?php
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
echo "<br>";*/                                                                            /* till now all was about connection */
$source = strtolower($_GET["source"]);                                               
$destination = strtolower($_GET["destination"]);                                    /* getting source and destination */
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
    
}
                                                 /* printing the adjacency matrix */
/*for($i=1;$i<=$c;$i++)                            
{  for($j=1;$j<=$c;$j++)
        echo $gr[$i][$j];
echo "<br>";
}*/
                                                 /*printing array arr which contains all the station */
/*for($i=1;$i<=$c;$i++)                   
    echo $arr[$i],"@";
echo "<br>";*/


$tim=array();                      /* from here dijkstra is implemented */                             
$status=array();
$path=array();
for($i=1;$i<=$c;$i++)
{
    $tim[$i]=99999;
    $status[$i]=0;
}
$src=0;
for($i=1;$i<=$c;$i++)
{
    if($arr[$i]==$source)
    {
        $src=$i;
    }
}
    
$tim[$src]=0;
$path[$src]='source';
for($i=1;$i<$c;$i++)
{
    $min=99999;
    for($j=1;$j<=$c;$j++)
    {
        if($tim[$j]<$min&&$status[$j]!=1)
        {
            $pos=$j;
            $min=$tim[$j];
        }
    }
    $status[$pos]=1;
    for($j=1;$j<=$c;$j++)
    {
        if($j!=$pos&&$gr[$pos][$j]!=0&&$status[$j]!=1&&$tim[$j]>$gr[$pos][$j]+$tim[$pos])
        {
            $tim[$j]=$gr[$pos][$j]+$tim[$pos];
            $path[$j]=$arr[$pos];
        }
    }
}
                                                     /* printing the least time taken to go to stations from source */
/*for($i=1;$i<=$c;$i++)                                
        echo $tim[$i],"@";                                
echo "<br>";*/
                                                     /* printing the path before station of given station in least time path */
/*for($i=1;$i<=$c;$i++)                              
        echo $path[$i],"@";*/                            

for($i=1;$i<=$c;$i++)                               /* finding the destination station pos */
{
    if($arr[$i]==$destination)
    {
        $pos=$i;
    }
}
echo "<br>";                                       /* printing the least time consuming path from source and destination */
  
    $real=array();
    $count=0;
    $real[$count]=$destination;
while(true)
{
    if($arr[$pos]==$source)
        break;
    else
    {
        $real[++$count]=$path[$pos];
        for($i=1;$i<=$c;$i++)
            if($arr[$i]==$path[$pos])
            {
                $pos=$i;
                break;
            }
    }
}
    
    for($i=$count;$i>=0;$i--)
    {
        echo "<font size=6>".($count-$i+1).".".$real[$i];
        for($j=1;$j<=$c;$j++)
        {
            if($arr[$j]==$real[$i])
            {if($i==$count)
            {
                $prev=$j;
            }
             else
             {
                 
                 $next=$j;
                     if($mode[$next][$prev]==1)
                     {
                         echo "<pre>    By Train(".$medium[$next][$prev].")</pre>";
                     }
                     else
                     {
                         echo "<pre>    By Aeroplane(".$medium[$next][$prev].")</pre>";
                     }
                 $prev=$j;
             }
                echo "<pre>    Time consumed till now in the journey:$tim[$j]hr(Waiting Time not Included)</pre>";
                break;
            }
        }
        echo "<br>";
    }
?>
<body\>
<html\>