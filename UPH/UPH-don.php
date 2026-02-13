<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Union Post Humaniste</title>
<link rel="stylesheet" href="./uph.css">
<link rel="icon" href="./uph-images/UPH-favicon-reversed.png" type="image/png">
</head>
<body>

<!-- Nav Here -->

<main>
		<div class="donation-wrapper">
			<nav>
				<div class="logo-zone">
					<a id="logo-link" href="./UPH-home.html"><img id="logo" src="./uph-images/UPH-favicon.gif"><img id="gif-cover" src="./uph-images/gif-cover.png"></a>
					<a href="./UPH-home.html">L'Union Post Humaniste</a>
				</div>
				<ul id="nav_links">
					<li><a href="./UPH-home.html">Accueil</a></li>
					<li><a href="./UPH-program.html">Notre Mouvement</a></li>
					<li><a href="./UPH-team.html">Notre Equipe</a></li>
					<li><a href="./UPH-don.php"id="selected">Nous soutenir</a></li>
					<li><a href="./UPH-join.php">Nous rejoindre</a></li>
					<li><a href="./UPH-actus.html">Actualités</a></li>
				</ul>
				<hr>
			
				<div class="media">
					<a href="https://instagram.com" target="_blank"><img src="./uph-images/insta.png"></a>
					<a href="https://facebook.com" target="_blank"><img src="./uph-images/facebook.png"></a>
				</div>
				<div class="dropdown">
				<img src="./uph-images/hamburger.png" id="burger" onclick="toggleNav()" data-image="burger">
				<ul id="sub_nav">
					<li><a href="./UPH-home.html">Accueil</a></li>
					<li><a href="./UPH-program.html">Notre Mouvement</a></li>
					<li><a href="./UPH-team.html">Notre Equipe</a></li>
					<li><a href="./UPH-don.php">Nous soutenir</a></li>
					<li><a href="./UPH-join.php">Nous rejoindre</a></li>
					<li><a href="./UPH-actus.html">Actualités</a></li>
				</ul>
				</div>

			</nav>		

			<form  id="donation-form" action="process-form.php" method="POST" style="box-shadow: 0 0 10px <?= isset($_SESSION['errorShadow']) ? "10px #ff5151":"3px #00fff0"; unset($_SESSION['errorShadow']);?>">
				<?= isset($_SESSION['confirmation']) ? "<p style='color: #086c08; background: radial-gradient(#8efa9a82, rgb(0, 255, 102));backdrop-filter: blur(5px);
	border: 1px solid rgb(3,67,11); box-shadow: 0 0 10px rgb(54,223,74); font-size: 20px; font-weight: 600; top: 10px; left: 15%; border-radius: 10px; width: max(45vw, 250px); padding: 5px 10px; position:absolute';> {$_SESSION['confirmation']} </p>":"";
	unset($_SESSION['confirmation']);?>
				<h1 class="title"> Je fais un don </h1>

				<input type="radio" id="once" name="donation_type" value="once" >
				<label for="once" id="once_label">Une fois</label>
				<input type="radio" id="monthly" name="donation_type" value="monthly" checked>
				<label for="monthly" id="monthly_label"> Mensuel </label>

				<input type="radio" class="radio-amount" id="twenty" name="amount" value="20" checked >
				<label for="twenty" class="option"> 20$</label>
				<input type="radio" class="radio-amount" id="fifty" name="amount" value="50">
				<label for="fifty" class="option"> 50$</label>
				<input type="radio" class="radio-amount" id="hundred" name="amount" value="100">
				<label for="hundred" class="option"> 100$</label>
				<input type="radio" class="radio-amount" id="two-hundred" name="amount" value="200">
				<label for="two-hundred" class="option"> 200$</label>
				
				<div class="libre">
					<label for="libre">Montant libre:</label> <input type="number" id="libre" name="libre" >
					<?php 
						if (isset($_SESSION['amountError'])){
							echo "<p style='color:red; background: radial-gradient(#ff000082, rgba(255, 0, 0, 0.126));backdrop-filter: blur(5px);
	border: 1px solid rgb(216,118,118);color: #ff8d79; box-shadow: 0 0 10px rgb(216,118,118); font-size: 20px; margin-top:10px; width: max-content; padding: 5px 10px; margin: 10px auto;'>" . $_SESSION['amountError'] . "</p>";
							unset($_SESSION['amountError']);
					} ?>
				</div>
				<div class="email">
					<label for="email"><span style="color: rgba(255,0,166)">*</span>Adresse mail:</label> <input type="email" id="email" name="email" required>
					<?php 
						if (isset($_SESSION['emailError'])){
							echo "<p style='color:red; background: radial-gradient(#ff000082, rgba(255, 0, 0, 0.126));backdrop-filter: blur(5px);
	border: 1px solid rgb(216,118,118);color: #ff8d79; box-shadow: 0 0 10px rgb(216,118,118); font-size: 20px; margin-top:10px; width: max-content;padding: 5px 10px; margin: 10px auto;'>" . $_SESSION['emailError'] . "</p>";
							unset($_SESSION['emailError']);
					} ?>
				</div>
				<input type="submit" id="finish" value="Valider mon don">
				
				
			</form><hr id="white_hr">
				<h3 id="donation-text"> 
					Nous soutenir, ce n'est pas seulement nous aider à financer le parti, c'est participer à
					vous offrir un avenir meilleur. Contrairement à de nombreux politiques, l'union post humaniste s'engage
					à investir l'ensemble de ses ressources pour le bien du peuple français. Ainsi, votre don nous est utile, 
					et même nécessaire pour changer le monde. Lorsque vous soutenez l'union, ce n'est pas pour nous que vous le faites,
					mais pour vous et les futures générations de français.

				</h3>
		</div>
		<section class="newsletter">
			<h2>Restez informé.es</h2><h4>Recevez notre newsletter quotidienne par mail afin d'être tenu au courant de nos dernières actions</h4>
			<form>
				<img src="./uph-images/mail.png">
				<input type="email" placeholder="...@..." name="email" required>
				<input type="submit" value="Envoyer">
			</form>
		</section>
</main>
<style>

.donation-wrapper {
	background: url('./uph-images/don_background2.jpg');
	background-position: center;
	filter:grayscale;
	padding-bottom: 20px;
	position: relative;

}
.donation-wrapper::before {
	content:'';
	position: absolute;
	width: 100%;
	height: 100%;
	inset: 0;
	background-color: #3d032e76;
}
#donation-form  {
	max-width: min(750px, 80%);
	margin: 50px auto 30px auto;
	padding: 50px 30px;
	background: url('./uph-images/join-bg.jpg');
	background-size: cover;
	position: relative;
	text-align: center;
	background-color: rgba(0,0,0,0.1);
	backdrop-filter: blur(10px);
	border:1px solid rgba(255,255,255,0.6);
	border-radius:30px;
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	grid-template-rows: repeat(6, 1fr);
	align-items: center;
	gap:20px;
	font-size: max(2.3vw, 22px);
	position: relative;
}
#donation-form::after {
	border-radius: 30px;
}
.title {
	grid-column: 1 / 3;
	text-align: center;
	padding-bottom:10px;
	border-bottom: 2px solid white;
	font-weight:600;
	font-size:44px;
	animation: soft-neon-text 20s linear infinite;
	color: #00fff0;
	background-color: rgba(0, 0, 0, 0.2);
}
.libre, .email {
	grid-column: 1 / span 2;
}

#finish {
	grid-column: 1/ span 2;
	font-size: 20px;
	padding: 10px 5px;
	border-radius: 40px;
	margin: 0 auto;
	min-width: 50%;
	color: white;
	background-color:rgba(0, 0, 0, 0.5);
	border: 1px solid #00fff0;
	box-shadow: 0 0 10px #00fff0;
	animation: soft-neon-text 6s linear infinite;
}
#finish:hover {
	background:radial-gradient(#00ffeeab, #00ffee23);
}
 #once_label, #monthly_label {
	background: radial-gradient(#ba0baf, #f45eff46) ;
	border: 1px solid rgba(185, 60, 189,0.5);
	transition: background-color 0.2s;
	border-radius: 5px;
	width: 90%;
	padding: 10px 0;
	margin: 0 auto;
	cursor:pointer;
}
#once_label:hover, #monthly_label:hover {
	background-color: rgba(185, 60, 189,0.2);
}
#donation-form input[type=radio] {
	display:none;
}

#donation-form input:checked + label  {
	background-color: rgb(15,214,167);
}
#donation-form input[type=email], input[type=number] {
	padding: 3px;
	font-size: 15px;
	transition: 0.3s;
	animation: soft-neon-text 6s linear infinite;
	background-color: rgba(0, 0, 0, 0.5);
	color: #00fff0;
	text-shadow: 0 0 5px #00fff0;
	border: 1px solid #00fff0;
	border-radius: 5px;
	-moz-appearance: textfield;
}
::-webkit-inner-spin-button, ::-webkit-outer-spin-button {
	-webkit-appearance: none;
	margin: 0;
}
.option {
	background: radial-gradient(#bc459e, #ff5ed746) ;
	border: 1px solid rgba(176, 115, 178,0.5);
	transition: background-color 0.2s;
	border-radius: 20px;
	width: 90%;
	padding: 10px 0;
	margin: 0 auto;
	cursor:pointer;
}
.option:hover {
	background-color: rgba(176,115,178,0.2);
}
#donation-text {
	max-width: 1000px;
	margin: 0px auto;
	padding-top: 20px;
	text-align:center;
	padding: 20px 40px;
	border-radius: 20px;
	background-color: rgba(0,0,0,0.5);
	backdrop-filter: blur(15px);
	border: 1px solid rgba(255,255,255,0.6);
	transition: 0.5s;
}
#donation-text:hover {
	background-color: black;
}
#white_hr {
	width:85%;
}

</style>

<script>
function toggleNav() {
	const x = document.getElementById("sub_nav");
	x.classList.toggle("show"); 
	let button = document.getElementById('burger');
	if (button.dataset.image === "burger") {
	button.src = "./uph-images/chevron-left.png";
	button.dataset.image = "chevron";
	} else {
	button.src = "./uph-images/hamburger.png";
	button.dataset.image = "burger";
	}
}
	let form = document.getElementById('donation-form');
	form.onsubmit = function() {
		alert('Merci pour votre don, nous allons revenir vers vous très prochainement');}
	

	document.getElementById('libre').addEventListener('click', () => {
		document.querySelectorAll('.radio-amount').forEach(radio => {
			radio.checked = false;
			document.getElementById('libre').style.background ='radial-gradient(rgba(0,255,238,0.5), #00ffee23)';
		});

	});

	document.querySelectorAll('.radio-amount').forEach(radio => {
		radio.addEventListener('click', () => {
			document.getElementById('libre').value = '';
			document.getElementById('libre').style.background ='rgba(0, 0, 0, 0.5)';
		});
	});
	

</script>
	<footer>
		<div class="footer1">
			<p>Qui sommes-nous</p>
			<ul>
				<li><a href="./UPH-program.html #banderolle1">Notre mouvement</a></li>
				<li><a href="./UPH-team.html">Notre equipe</a></li>
				<li><a href="./UPH-program.html #banderolle2">Notre programme</a></li>
			</ul>		
		</div>
		<hr>
		<div class="footer2">
			<p>Nous soutenir</p>
			<ul>
				<li><a href="./UPH-join.php">Adhérer</a></li>
				<li><a href="./UPH-don.pp">Faire un don</a></li>
			</ul>	
		</div>
		<hr>
		<div class="footer3">
			<p>Rester informé.e</p>
			<ul>
				<li><a href="./UPH-actus.html">Actualité</a></li>
				<li><a href="#Events">Evènements</a></li>
			</ul>	
		</div>
		<hr>
		<div class="footer4">
			<p>Contacts</p>
			<ul>
				<li>email: uph.contact@protonmail.com</li>
				<li><a href="https://instagram.com" target="_blank"><img src="./uph-images/insta.png"></a>
			<a href="https://facebook.com" target="_blank"><img src="./uph-images/facebook.png"></a></li>
			</ul>	
		</div>
	</footer>
<script>
function myFunction() {
	var x = document.getElementById("nav_links");
	x.classList.toggle("show");
}
</script>
</body>
</html>
