<?php
$db_name="train_inf";
$mysql_username="root";
$mysql_password="";
$server_name="localhost";
$conn=mysqli_connect($server_name,$mysql_username,$mysql_password,$db_name);
if($conn)
{
	echo "connection sucess";
}
else
{
	echo "connection not established";
}                                                                                        /* till now all was about connection */
echo "<br>";

$source = strtolower($_GET["source"]);                                               
$destination = strtolower($_GET["destination"]);                                    /* getting source and destination */
$arr=array();                                                    /* arr contains all the unique station names */                       
$gr=array();                                                    /* gr is 2d array ----adjacency matrix of graph */   

for($i=1;$i<=14;$i++)                                             
{
    for($j=1;$j<=14;$j++)
    {
        $gr[$i][$j]=0;                                    /* initialising all values to 0 in gr matrix meaning no path */
    }
}

$c=0;
for($i=1;$i<=14;$i++)
{$flag=0;$flag2=0;
 $res1=mysqli_query($conn,"SELECT station1 FROM inf WHERE id=$i");
 $res2=mysqli_query($conn,"SELECT station2 FROM inf WHERE id=$i");
 $sta1=$res1->fetch_assoc();
 $sta2=$res2->fetch_assoc();
 $st1=$sta1["station1"];
 $st2=$sta2["station2"];
 echo $st1,$st2;                                                             /* two satation got at particular id*/
 $res3=mysqli_query($conn,"select time from inf where id=$i");
 $ti=$res3->fetch_assoc();
 $time=$ti["time"];
 echo $time;
 echo "<br>";
    for($j=1;$j<=$c;$j++)
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
    if($flag==0&&$flag2==0)
    {
     $arr[++$c]=$st1;
     $arr[++$c]=$st2;
     $gr[$c-1][$c-1]=0;
     $gr[$c][$c]=0;
     $gr[$c][$c-1]=$time;
     $gr[$c-1][$c]=$time;
    }
    else if($flag==0&&$flag2==1)
    {
        $arr[++$c]=$st1;
        $gr[$c][$c]=0;
        $gr[$c][$pos2]=$time;
        $gr[$pos2][$c]=$time;
    }
    else if($flag==1&&$flag2==0)
    {
        $arr[++$c]=$st2;
        $gr[$c][$c]=0;
        $gr[$c][$pos]=$time;
        $gr[$pos][$c]=$time;
    }
   else
    {
       $gr[$pos][$pos2]=$time;
       $gr[$pos2][$pos]=$time;
    }
    
}
for($i=1;$i<=$c;$i++)
{  for($j=1;$j<=$c;$j++)
        echo $gr[$i][$j];
echo "<br>";
}
for($i=1;$i<=$c;$i++)
    echo $arr[$i],"@";
echo "<br>";
$tim=array();
$status=array();
$path=array();
for($i=1;$i<=$c;$i++)
{
    $tim[$i]=99999;
    $status[$i]=0;
}
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
for($i=1;$i<=$c;$i++)
        echo $tim[$i],"@";
echo "<br>";
for($i=1;$i<=$c;$i++)
        echo $path[$i],"@";
for($i=1;$i<=$c;$i++)
{
    if($arr[$i]==$destination)
    {
        $pos=$i;
    }
}
echo "<br>";
echo $destination;
while(true)
{
    if($arr[$pos]==$source)
        break;
    else
    {
        echo "<-",$path[$pos];
        for($i=1;$i<=$c;$i++)
            if($arr[$i]==$path[$pos])
            {
                $pos=$i;
                break;
            }
    }
}
?>