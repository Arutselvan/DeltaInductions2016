function timer() {
   var DeadlineDate = new Date("May 25, 2016 02:05:40"); //Preset date                   
   var currentDate = new Date(); //Gets current date
   var remainingTime = Date.parse(DeadlineDate) - Date.parse(currentDate);
   var seconds = parseInt((remainingTime / 1000) % 60);
   var minutes = parseInt((remainingTime / (1000 * 60)) % 60);
   var hours = parseInt((remainingTime / (1000 * 60 * 60)) % 24); //conversion of milliseconds to days, hours, minutes and seconds
   var days = parseInt(remainingTime / (1000 * 60 * 60 * 24));
   document.getElementById("days").innerHTML = days;
   document.getElementById("hours").innerHTML = hours;
   document.getElementById("minutes").innerHTML = minutes;
   document.getElementById("seconds").innerHTML = seconds;


   if (remainingTime <= 0) {
      document.getElementById("days").innerHTML = -days;
      document.getElementById("hours").innerHTML = -hours;
      document.getElementById("minutes").innerHTML = -minutes; //conversion of negative number to positive                             
      document.getElementById("seconds").innerHTML = -seconds;
      document.getElementById("mainText").innerHTML = "THE LAUNCH IS DELAYED BY";
      var blocks = document.getElementsByClassName("block");
      for (i = 0; i < 4; i++) {
         blocks[i].style.backgroundColor = "red"; //changes the background to timer blocks to red
      }
   }
}
timer();
var timeinterval = setInterval(timer, 1000);