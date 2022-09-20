<?php
	  function welcome(){
 
       if(date("H") < 12){
 
       return "Good Morning";
 
      }elseif(date("H") > 11 && date("H") < 18){
 
     return "Good Afternoon";
 
      }elseif(date("H") > 17 && date("H") < 20){
 
     return "Good Evening";
 
     }
     elseif(date("H") > 20){
 
     return "How is Your Night?";
 
   }
 
 }
 ?>