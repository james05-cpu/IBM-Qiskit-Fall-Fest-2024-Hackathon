<?php
//include_once("util.php");
include_once("conn.php");
session_start();
function getPricing($conn)
{
        $stm = $conn->prepare("SELECT* FROM 'Pricing'");
        $res = $stm->execute();
        $pricing = array();
        while ($row = $res->fetchArray()) {

                array_push($pricing, $row);
        }
        return $pricing;
      }
//$empty_slots=count(getEmptySlots($conn));
$plans=getPricing($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Profile</title>
      <link rel="stylesheet" href="profile.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <nav>
         <div class="menu-icon">
            <span class="fas fa-bars"></span>
         </div>
         <div class="logo">
           Quantum Agric
         </div>
         <div class="nav-items">
            <li><a href="#">Home</a></li>
            <li><a href="products.html">Kits & Sensors</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="contactus.html">Contact</a></li>
         </div>
         <div class="cancel-icon">
            <span class="fas fa-times"></span>
         </div>
      </nav>
      <div class="content">
        
         <div class="container">
         <div class="card-holder">
            <div class="card">
              <div class="card-title">Available Kits</div>
              <div style="font-size: 30px;" class="card-text" id="number_slots">13</div>
            </div>
            <div class="card">
              <div class="card-title">Our Experts</div>
              <div style="font-size: 30px;" class="card-text" id="number_slots">13</div>
            </div>
              <div class="card">
              <div class="card-title">Satisfied Clients</div>
              <div style="font-size: 30px;" class="card-text" id="number_slots">700</div>
            </div>
            <!--<div class="card">
              <div class="card-title">Your Slot</div>
              <div class="card-text1">
                <span class="key">No:</span>
                <span class="val" id="slot"></span>
                <span class="key">Code:</span>
                <span class="val" id="code"></span>
              </div>
              <div class="card-text">
                <span class="key">Duration:</span>
                <span class="val" id="dur"></span><span></span>
              </div>
            </div>-->
      
          </div>
           
       
            <div class="wrapper">
             
              <h1 class="title">Our Pricing</h1>
            
              <div class="pricing-main">
                <div class="pricing-box">
                  <p class="box-title">Basic</p>
                  <p class="price-annually">$<span class="price" id="hr"><?php echo($plans[0]['cost'])?></span></p>

                  <ul>
                         <li><strong>Suitable for small scale farmers</strong></li>
                      <li>You will get 5  soil Monitoring Robots</li>
                      <li>You will get 1 crop monitoring drones </li>
                      <li>Ai based soil health, nutrients
                       composition analytics and insights</li>
                       <li>Real time soil conditions- moisture, temp, PH</li>
                      <li>Real time Crop pest identification</li>
                      <li>Ai driven crop health analytics and insights</li>
                      <li>Daily Report on overrall farm</li>
                    </ul>
                  <a href="pay.php?plan=basic">Book Now</a>
                </div>
                <div class="pricing-box featured">
                  <p class="box-title">Advanced</p>
                  <p class="price-annually"> $ <span class="price" id="ml"><?php echo($plans[1]['cost'])?></span></p>
                  <ul>
                      <li><strong>Suitable for large scale farmers</strong></li>
                      <li>You will get 10 soil Monitoring Robots</li>
                      <li>You will get 5 crop monitoring drones </li>
                      <li>Ai based soil health, nutrients
                                 composition analytics and insights</li>
                      <li>Real time soil conditions- moisture, temp, PH</li>
                      <li>Real time Crop pest identification</li>
                      <li>Ai driven crop health analytics and insights</li>
                      <li>Daily Report on overrall farm</li>
                  </ul>
                  <a href="pay.php?plan=advanced" id="pm">Book Now</a>
                </div>
                <div class="pricing-box">
                  <p class="box-title">Pro-mode</p>
                  <p class="price-annually">$ <span class="price" id="cl"><?php echo($plans[2]['cost'])?></span></p>
                     <ul>
                      <li><strong>Suitable for Multiple-fields farmers</strong></li>
                      <li>You will get a sensor network kit</li>
                      <li>You will get 15 crop monitoring robots </li>
                      <li>You will get 10 crop monitoring drones </li>
                      <li>Ai based soil health, nutrients
                       composition analytics and insights</li>
                      <li>Real time soil conditions- moisture, temp, PH</li>

                      <li>Ai based Crop pest identification</li>
                      <li>Ai driven crop health analytics and insights</li>
                      <li>Daily Report on overrall farms</li>
                      </ul>
                                        <a href="pay.php?plan=pro">Book Now</a>
                </div>
              </div>
            </div>
          </div>
 
      </div>
      <footer>
          <span>All Rights Reserved: Copyright Muthiani JMC</span>       
      </footer>
      <script>

         const menuBtn = document.querySelector(".menu-icon span");
         const cancelBtn = document.querySelector(".cancel-icon");
         const items = document.querySelector(".nav-items");
         const form = document.querySelector("form");
         const pm=document.getElementById("pm").addEventListener("click",checkAvailablity)
         function checkAvailablity(){
        var formData = new FormData();
        formData.append("plan", "monthly")
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "availability.php", true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var res = xhr.responseText;
                if (res.trim() == "success") {
                    window.location = "pay.php?plan=monthly";
                }
                if (res.trim() == "fail") {
                    alert("No space at the momment, try again later")
                }
            }
        }
        xhr.send(formData);
    }

         menuBtn.onclick = ()=>{
           items.classList.add("active");
           menuBtn.classList.add("hide");
           cancelBtn.classList.add("show");
         }
         cancelBtn.onclick = ()=>{
           items.classList.remove("active");
           menuBtn.classList.remove("hide");
           cancelBtn.classList.remove("show");
           form.classList.remove("active");
           cancelBtn.style.color = "#ff3d00";
         }
         function up1() {
      var formData = new FormData();
      formData.append("type", "user")
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "rtupdate.php", true);
      const a=document.getElementById("number_slots");
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              var res = xhr.responseText;
             a.innerText=res;
          }
      }
      xhr.send(formData);
  }
  function up2() {
      var formData = new FormData();
      formData.append("type", "mine")
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "ppdate.php", true);
      const a=document.getElementById("slot");
      const b=document.getElementById("code");
      const c=document.getElementById("dur");
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              var res = xhr.responseText;
              console.log(res)
              if(res.split(":").length==3){
                var text=res.split(":");
                a.innerText=text[0];
             b.innerText=text[1];
             c.innerText=text[2];
              }
             else if(res.split(":").length!=3){
              a.innerText="NONE";
             b.innerText="NONE";
             c.innerText="0";

             }
          }
      }
      xhr.send(formData);
  }
  function up3() {
      var formData = new FormData();
      formData.append("type", "us")
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "ppdate.php", true);
      const a=document.getElementById("hr");
      const b=document.getElementById("ml");
      const c=document.getElementById("cl");
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              var res = xhr.responseText;
              console.log(res)
              var text=res.split(":")
                a.innerText=text[0];
             b.innerText=text[1];
             c.innerText=text[2];
          }
      }
      xhr.send(formData);
  }
  //setInterval(up1,1000);
  //setInterval(up2,1500);
   //setInterval(up3,1200);

      </script>
   </body>
</html>