<?php
$db= new mysqli('127.0.0.1','root','','train_inf') or die("We have some problem right now try latter");
$selector=0;
$source = strtolower($_GET["source"]);                                               
$destination=strtolower($_GET["destination"]);
$time=$_GET["time"];
$way=$_GET["way"];
$name=$_GET["name"];


echo $selector;
echo $way;
echo $source;
echo $destination;
echo $time;
echo $name;

$res0=$db->query("SELECT count(id) FROM inf");
$i0=$res0->fetch_assoc();
$id=$i0["count(id)"]; 
$id=$id+1;
echo "id =".$id ;
if($way == "train")
  {
  	  $selector=1;
  }
 else{
 	$selector = 2;
 } 
if($selector == 1)
$query = "insert into inf values ('".$name."','".$source."','".$destination."','".$time."',null,'".$selector."','".$id."');";
else
{
	$query = "insert into inf values (null,'".$source."','".$destination."','".$time."','".$name."','".$selector."','".$id."');";
}

$res= $db->query($query);
echo $res;
echo "Data inserted" ;


?>