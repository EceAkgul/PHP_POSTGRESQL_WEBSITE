<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <title>404 Not Found</title>

	<style>

	#bg{


		animation-name:test;
		animation-duration: 1s;
		animation-delay:0s;
		animation-iteration-count:infinite;
		animation-direction:alternate;
		background-size: cover;

	}
	@keyframes test{
		from{background-image:url("https://i.imgur.com/CzPDH9z.jpg");}
		to{background-image:url("https://i.imgur.com/o09HIOw.jpg");}

	}
	#text{
	    margin-top:-100px;
		margin-left:-350px;
		font-size:80px;
		font-family:"Pricedown";
		color:white;
	}

	#rocket{
		animation-name:rocket;
		animation-duration:3s;
		animation-delay:0s;
		animation-iteration-count:1;
		animation-fill-mode:forwards;				
		width:1390px;
		height:632px;
		background-repeat:no-repeat;
		margin-left:650px;
		margin-top:200px;
		background-size:550px;
		position:absolute;

		
	}

	@keyframes rocket{

		from{background-image:url("https://i.imgur.com	/rLCDvfp.png");}
		to{background-image:url("https://i.imgur.com/cbhO5Fw.png");}
		from{margin-left:-600px;}
		to{margin-left:500px;}
		from{margin-top:400px;}
		to{margin-top:300;}

	}


	</style>




</head>

<body id="bg">
		<div id="rocket">
			<div id="text">
				Sanırım Kayboldun!
			</div>
		</div>
	</div>
</body>

</html>