<!DOCTYPE html>
<!-- saved from url=(0049)file:///C:/xampp/htdocs/myphpfile/RoutFinder.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
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
        <input type="text" id="s" name="source" list="station">
        <label for="d"><b>Destination</b></label>
        <input type="text" id="d" name="destination" list="station"> 
        <input type="Submit" name="Submit" value="Get Route">
        <datalist id="station">
          <option value="Allahabad"></option>
          <option value="Delhi"></option>
          <option value="Varansi"></option>
          <option value="Lucknow"></option>
          <option value="Patna"></option>
        <option value="Mumbai"></option>
          <option value="Agra"></option>
          <option value="Pune"></option>
          <option value="Guwahati"></option>
          <option value="Dehradun"></option>
          <option value="New York"></option>
          <option value="Kanpur"></option>
          <option value="Jaipur"></option>
          <option value="Kota"></option>
          <option value="Bangalore"></option>
          <option value="Chandigarh"></option>
          <option value="Guwahati"></option>
          <option value="Bhopal"></option>
          <option value="London"></option>
          <option value="Kolkata"></option>
        
        </datalist>
       </form></div>
      <footer>

      </footer>     




</body></html>