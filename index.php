<html lang="es">
<head>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <style>
    body {
  margin: 0;
  padding: 0;
/*  Background fallback in case of IE8 & down, or in case video doens't load, such as with slower connections  */
  background: #333;
  background-attachment: fixed;
  background-size: cover;
}

/* The only rule that matters */
#video-background {
/*  making the video fullscreen  */
  position: fixed;
  right: 0; 
  bottom: 0;
  min-width: 100%; 
  min-height: 100%;
  width: auto; 
  height: auto;
  z-index: -100;
}

/* These just style the content */
article {
/*  just a fancy border  */
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
 /* border: 10px solid rgba(255, 255, 255, 0.5);*/
  margin: 10px;
}

h1 {
  position: absolute;
  top: 60%;
  width: 100%;
  font-size: 36px;
  letter-spacing: 3px;
  color: #fff;
  font-family: Oswald, sans-serif;
  text-align: center;
    z-index: 200;
}

h1 span {
  font-family: sans-serif;
  letter-spacing: 0;
  font-weight: 300;
  font-size: 16px;
  line-height: 24px;
  z-index: 200;
}

h1 span a {
  color: #fff;
}
img{
    z-index: 200;
    position: absolute;
}
article span a{
    margin-right: 10%;
}
.text-left{
    float: left;
    margin-left: 30%;
}
.text-right{
    float: right;
    margin-right: 30%;
}
    </style>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script  src="web/js/jquery.vimelar.min.js"></script>
    <script>
$('document').ready(function() {
    var options = {
        videoId: '40728037',
        parameters: {
            autopause: 1,
            autoplay: 1,
            badge: 1,
            byline: 1,
            color: '000',
            loop: 1,
            player_id: 'demo',
            portrait: 1,
            title: 1
        }
    };
    $('#wrapper').vimelar(options);
});
</script>
</head>
<body>
<div id="wrapper"></div>
    <article>
        <img src="web/images/logo.png">
  <h1><span><a class="text-left" href="web/index.php" >Spanish </a><a class="text-right" href="web/index.php"> English</a></span></h1>
</article>
</body>
</html>