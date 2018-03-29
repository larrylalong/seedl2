<!DOCTYPE html>
<html>
<head>
	<title>tchat</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript">
		
		$(document).ready(function () {
		   $("#msguser").focus();
		   $('<audio id="beepAudio"><source type="audio/mpeg" src="song/facebook.mp3">').appendTo('body');
		   $("#sendButton").click(function () {
		   		var msg = $("#msguser").val().trim();
		   		$("#msguser").val('');
		   		$("#msguser").focus();

		   		if (msg.length > 0) {
		   			$("<li></li>").html('<img src="img/moi.jpg"><span>'+msg+'</span>').appendTo("#tchatMsg");
		   			$("#tchatcontent").animate({"scroollTop":$("#tchatcontent").height()},"slow");
		   			$("#beepAudio")[0].play();
		   		}
		   		
		   });

		   $("#msguser").keypress(function (event) {
		   		if (event.which == 13) {
		   			if ($("#enter").prop("checked")) {
		   				event.preventDefault();
 					    $("#sendButton").click();
		   			}
		   		}
		   });
		})

	</script>
</head>
<body>
	<h1>Mon Amphi</h1>
	<div id="tchatbox">
		<div id="tchatcontent">
			<ul id="tchatMsg">
				<li><img src="img/moi.jpg"><span>salut les amis!!!</span></li>
				<li><img src="img/moi.jpg"><span>comment aller-vous???</span></li>
			</ul>
		</div>
		<input type="text" id="msguser" name="" placeholder="entrer votre msg">
		<input type="button" value="Envoyer" id="sendButton" name=""><br><span  id="checkbox">
		&nbsp;
		&nbsp;<input type="checkbox" id="enter" name="" checked>Tapper sur "entrée" pour envoyer le msg</span>
	</div>
</body>
</html>