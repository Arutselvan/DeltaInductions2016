function timetrigger() {
   document.getElementById("inputform").style.display = "none";
   document.getElementById("clockBlock").style.display = "block";
   flag = 1;
   var ihours = document.getElementById("ihours").value;
   var iminutes = document.getElementById("iminutes").value;
   var iseconds = document.getElementById("iseconds").value;
   remainingTime = (ihours * 3600) + (60 * iminutes) + (1 * iseconds); //converts the given time into seconds
   originaltime = remainingTime;
   var minutes = parseInt((remainingTime / (60)) % 60);
   var hours = parseInt(remainingTime / (60 * 60));
   var seconds = parseInt(remainingTime % 60);

   function timer() {
      if (flag == 1) {
         --remainingTime;
      }
      var minutes = parseInt((remainingTime / (60)) % 60);
      var hours = parseInt(remainingTime / (60 * 60));
      var seconds = parseInt(remainingTime % 60);
      document.getElementById("hours").innerHTML = hours;
      document.getElementById("minutes").innerHTML = minutes;
      document.getElementById("seconds").innerHTML = seconds;


      if (remainingTime <= 0) {
         clearInterval(timeinterval);
         document.getElementById("timerblock").style.display = "none";
         document.getElementById("successText").style.display = "block";
      }
   }

   timer();
   var timeinterval = setInterval(timer, 1000); //sets a refresh rate of 1 second for the fucntion timer()
}

function stopstart() {
   if (flag == 0) {
      flag = 1;
      document.getElementById("startstop").innerHTML = "STOP"; //stops the time

   } else {
      flag = 0;
      document.getElementById("startstop").innerHTML = "START"; //resumes the time
   }
}

function resettime() {
   flag = 0;
   document.getElementById("startstop").innerHTML = "START"; 
   remainingTime = originaltime;                            //stops and resets the time
}