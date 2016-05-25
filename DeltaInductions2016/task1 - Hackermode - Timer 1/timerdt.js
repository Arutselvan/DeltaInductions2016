   function timetrigger() {
      var DeadlineDate = document.getElementById("deadline").value;
      if (isNaN(Date.parse(DeadlineDate))) {
         alert("ENTER A VALID DATE AND TIME"); //validates the input date and time
      } else {
         function timer() {
            document.getElementById("inputform").style.display = "none";
            document.getElementById("clockBlock").style.display = "block";
            document.getElementById("mainText").innerHTML = "THE EVENT STARTS IN";
            var currentDate = new Date();
            var remainingTime = Date.parse(DeadlineDate) - (Date.parse(currentDate) - ((currentDate.getTimezoneOffset()) * 60 * 1000)); //calculates remaining time with timezone correction for the local computer     
            var seconds = parseInt((remainingTime / 1000) % 60);
            var minutes = parseInt((remainingTime / (1000 * 60)) % 60);
            var hours = parseInt((remainingTime / (1000 * 60 * 60)) % 24);
            var days = parseInt(remainingTime / (1000 * 60 * 60 * 24));
            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;

            if (remainingTime <= 0) {
               clearInterval(timeinterval); //Stops the interval when time reaches zero adn produces a success text 
               document.getElementById("timerblock").style.visibility = "hidden";
               document.getElementById("successText").innerHTML = "THE EVENT HAS BEEN LAUNCHED";
            }
         }
      }
      timer();
      var timeinterval = setInterval(timer, 1000); //sets a interval of 1 second to run the function
   } 