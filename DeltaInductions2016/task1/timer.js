function timer() {
   var DeadlineDate = new Date("May 28, 2017 03:29:20"); //Preset date                   
   var currentDate = new Date(); //Gets current date
   var remainingTime = Date.parse(DeadlineDate) - Date.parse(currentDate); //converts the time difference into milliseconds
   var seconds = parseInt((remainingTime / 1000) % 60);
   var minutes = parseInt((remainingTime / (1000 * 60)) % 60);
   var hours = parseInt((remainingTime / (1000 * 60 * 60)) % 24); //conversion of milliseconds to days, hours, minutes and seconds
   var days = parseInt(remainingTime / (1000 * 60 * 60 * 24));
   document.getElementById('days').innerHTML = days;
   document.getElementById('hours').innerHTML = hours;
   document.getElementById('minutes').innerHTML = minutes;
   document.getElementById('seconds').innerHTML = seconds;

   if (remainingTime <= 0) {
      clearInterval(timeinterval); //Stops the interval when time reaches zero adn produces a success text 
      document.getElementById('timerblock').style.visibility = "hidden";
      document.getElementById('successText').innerHTML = "THE ROCKET HAS BEEN LAUNCHED";
   }
}
timer();
var timeinterval = setInterval(timer, 1000);