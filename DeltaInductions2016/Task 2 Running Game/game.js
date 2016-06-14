var x = [];
x[0] = 860;
var y = 223;
var speed = 8;
var myGamePiece;
var obstacle = [];
var jumptrigger;
var u = 0;
var stop = 0;
var cac = new Image();
cac.src = "cactus.png";
var boy = new Image();
boy.src = "boy.png";
var audio = new Audio("jump.wav");
var bgaudio = new Audio("dub.mp3");
var frameindex = 0;
var clouds = [];
var v = [];
v[0] = 450;
var t = 0;
var cloud = new Image();
cloud.src = "cloud.png";
var flag = 0;
document.body.onkeydown = function(e) {
   if (e.keyCode == 32) {
      if (flag != 1) {
         bgaudio.addEventListener('ended', function() {
            this.currentTime = 0;
            this.play();
         }, false);
         bgaudio.play();
         animate();
         flag = 1;
      }
   }
   if (flag == 1) {
      if (e.keyCode == 32) {
         jumptrigger = 1;
         audio.play();
      }
   }
}
if (score > 100) {
   speed = 10;
}

function startGame() {
   myGameArea.start();
   myGamePiece = new component(boy, frameindex * 58, 0, 58, 87, 10, y, 58, 87);
   obstacle[0] = new comp(cac, x[0], 270, 20, 40);
   for (i = 1; i < obstacle.length; i++) {
      obstacle[i] = new comp(cac, x[i], 270, 20, 40);
   }
   clouds[0] = new comp1(cloud, v[0], 40, 60, 33);
   for (i = 1; i < obstacle.length; i++) {
      clouds[0] = new comp1(cloud, v[i], 40, 60, 33);
   }
}
var myGameArea = {
   canvas: document.getElementById("gamewin"),
   start: function() {
      //this.canvas.width = 860;
      //this.canvas.height = 350;
      this.context = this.canvas.getContext("2d");
      this.context.fillStyle = "sandybrown";
      this.context.fillRect(0, 310, 860, 40);
      this.context.fillStyle = "deepskyblue";
      this.context.fillRect(0, 0, 860, 310);
      this.context.font = "30px Courier New";
      this.context.fillStyle = "black";
      this.context.fillText("SCORE" + "=" + score, 50, 50);
      // document.body.insertBefore(this.canvas, document.body.childNodes[0]);
   }
}

function component(image, sx, sy, sw, sh, x, y, dw, dh) {
   this.width = dw;
   this.height = dh;
   this.x = x;
   this.y = y;
   ctx = myGameArea.context;
   ctx.drawImage(image, sx, sy, sw, sh, x, y, dw, dh);
   this.crashWith = function(otherobj) {
      var myleft = this.x;
      var myright = this.x + (this.width);
      var mytop = this.y;
      var mybottom = this.y + (this.height);
      var otherleft = otherobj.x + 15;
      var otherright = otherobj.x + (otherobj.width) - 15;
      var othertop = 15 + otherobj.y;
      var otherbottom = otherobj.y + (otherobj.height);
      var crash = true;
      if ((mybottom < othertop) ||
         (mytop > otherbottom) ||
         (myright < otherleft) ||
         (myleft > otherright)) {
         crash = false;
      }
      return crash;
   }
}

function comp(img, x, y, width, height) {
   this.width = width;
   this.height = height;
   this.x = x;
   this.y = y;
   ctx = myGameArea.context;
   ctx.drawImage(img, x, y, width, height);

}

function comp1(img, x, y, width, height) {
   this.width = width;
   this.height = height;
   this.x = x;
   this.y = y;
   ctx = myGameArea.context;
   ctx.drawImage(img, x, y, width, height);

}
var frame = 0;
var count = 0;
var score = 0;;

function animate() {

   reqAnimFrame = window.mozRequestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.msRequestAnimationFrame ||
      window.oRequestAnimationFrame;
   reqAnimFrame(animate);
   for (i = 0; i < obstacle.length; i++) {
      if (myGamePiece.crashWith(obstacle[i]) == true) {
         stop = 1;
         bgaudio.pause();
         myGameArea.context.font = "30px Courier New";
         myGameArea.context.fillStyle = "black";
         myGameArea.context.fillText("GAME OVER", 345, 130);
         document.getElementById("btn").style.display = "block";
      }
   }
   if (stop == 0) {
      for (i = 0; i < obstacle.length; i++) {
         x[i] -= speed;
      }
      for (i = 0; i < clouds.length; i++) {
         v[i] -= 3;
      }
      if (jumptrigger == 1) {
         if (count < 8) {
            y -= 20;
            ++count;
         } else {
            arut = 0;
            y += 5;
            if (y == 223) {
               jumptrigger = 0;
               count = 0;
            }
         }
      }
      frame++;
      if (frame % 5 == 0) {

         ++frameindex;
         if (frameindex >= 8) {
            frameindex = 0;
         }
      }
      score = Math.floor(frame / 5);
      //console.log(score);
      var randframe = [153, 187, 83, 101, 79, 47, 53];
      var randind = Math.floor(Math.random() * 8);
      if ((frame % randframe[randind]) == 0) {
         ++u;
         x[u] = 860;
         obstacle.push(new comp(cac, x[u], 270, 20, 40));
         v[u] = 860;
         clouds.push(new comp1(cloud, v[u], 40, 60, 33));
      }


      startGame();

   }
}
document.addEventListener("click", function() {
   if (flag != 1) {
      bgaudio.addEventListener('ended', function() {
         this.currentTime = 0;
         this.play();
      }, false);
      bgaudio.play();
      animate();
      flag = 1;
   }
   flag = 1;
   if (flag == 1) {
      jumptrigger = 1;
      audio.play();
   }
});