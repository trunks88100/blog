<?php session_start();?>
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

	<main style="background-color:#0b1020; overflow:hidden"> 
			<nav>
				<div class="logo-zone">
					<a id="logo-link" href="./UPH-home.html"><img id="logo" src="./uph-images/UPH-favicon.gif"><img id="gif-cover" src="./uph-images/gif-cover.png"></a>
					<a href="./UPH-home.html">L'Union Post Humaniste</a>
				</div>
				<ul id="nav_links">
					<li><a href="./UPH-home.html">Accueil</a></li>
					<li><a href="./UPH-program.html">Notre Mouvement</a></li>
					<li><a href="./UPH-team.html">Notre Equipe</a></li>
					<li><a href="./UPH-don.php">Nous soutenir</a></li>
					<li><a href="./UPH-join.html"id="selected">Nous rejoindre</a></li>
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
					<li><a href="./UPH-join.html">Nous rejoindre</a></li>
					<li><a href="./UPH-actus.html">Actualités</a></li>
				</ul>
				</div>

			</nav>	

			<div class="join-text"><h1>Adhérer au mouvement</h1><p><b>À une époque où l’humanité hésite encore, vous avez choisi d’avancer.<br>
Ce questionnaire n’est pas une formalité : il est un premier pas vers une société plus forte, plus efficace et libérée des limites biologiques.</b> </p></div>

			<form id="questionnaire" method="POST" action="join-form.php" onkeydown="return event.key != 'Enter'">
				<div class="question-box">
					<progress max="100" value="100"></progress><hr>
					<h2>Q6: Choisissez la teinte qui représente le mieux votre vision de l’humanité augmentée</h2>
					<div class="answers-box">
						<input type="color" name="color">
					</div>
					<div class="switch-slide"> 
						<p>previous</p><input type="submit" value="Envoyer" id="question-submit">
					</div>
				</div>

				<div class="question-box">
					<progress max="100" value="80"></progress><hr>
					<h2>Q5: Comment vous joindre ?</h2>
					<div class="answers-box">
						
						<label for="tel" id="tel-label"><input type="checkbox" id="tel" name="contacts[]" value="tel" checked> Téléphone: <input id="tel-input" type="tel" name="tel" placeholder="xx.xx.xx.xx.xx"> </label>
						
						<label for="email"><input type="checkbox" id="email" name="contacts[]" value="email" checked> Email: <input id="email-input" type="email" name="email" placeholder="email"> </label>
						
						<label for="contact-no"><input type="checkbox" id="contact-no" name="contact-no" value="no"> Je ne souhaite pas recevoir la newsletter</label>
					</div>
					<div class="switch-slide"> 
						<p>previous</p><p>next</p>
					</div>
				</div>
				
				<div class="question-box">
					<progress max="100" value="60"></progress><hr>
					<h2><span>*</span>Q4: Pensez-vous participer à nos évènements ?</h2>
					<div class="answers-box">
						<label for="events-yes"><input type="radio" id="events-yes" name="events" value="yes" checked> Oui</label>
						
						<label for="events-no"><input type="radio" id="events-no" name="events" value="no"> Non</label>
						
						<label for="events-maybe"><input type="radio" id="events-maybe" name="events" value="maybe"> Peut-être</label>
						<label for="events-ideas" id="events-ideas-label">Quels évènements aimeriez-vous ?<br><textarea id="events-ideas" name="events-ideas"></textarea></label>
						
					</div>
					<div class="switch-slide"> 
						<p>previous</p><p>next</p>
					</div>
				</div>

				<div class="question-box">
					<progress max="100" value="40"></progress><hr>
					<h2><span>*</span>Q3: Avez-vous déjà fait usage d'augmentations/implants?</h2>
					<div class="answers-box">
						
						<label for="no-no"><input type="radio" id="no-no" name="implants" value="no-no" checked> Non et je n'en veux pas</label>
						<label for="maybe"><input type="radio" id="maybe" name="implants" value="maybe later"> Non mais j'y réfléchis</label>
						<label for="yes"><input type="radio" id="yes" name="implants" value="yes"> Oui</label>
						<label for="implant-details" id="implants-details-label">Si oui, lesquels?<br><textarea name="implants-details" id="implant-details"></textarea></label>
						
					</div>
					<div class="switch-slide"> 
						<p>previous</p><p>next</p>
					</div>
				</div>
				
				<div class="question-box">
					<progress max="100" value="20"></progress><hr>
					<h2><span>*</span>Q2 Quel modèle de société augmentée soutenez-vous ?</h2>
					<div class="answers-box" id="transparent-box">
						<div class="individual-box">
							<label for="augmentation" id="augmentation">Biologique <input type="range" name="augmentation" id="augmentation" step="1" min="0" max="10" value="5"> Augmentée</label>
						</div>
					
						<div class="individual-box">
						<label for="control" id="control">Autonomie <input type="range" name="control" id="control" step="1" min="0" max="10" value="5"> Surveillance totale</label>
						</div>

						<div class="individual-box">
						<label for="vitesse" id="vitesse">Prudence <input type="range"  name="vitesse" id="vitesse" step="1" min="0" max="10" value="5"> Accélération</label>
					    </div>
					</div>
					
					
					<div class="switch-slide"> 
						<p>previous</p><p>next</p>
					</div>
				</div>

				<div class="question-box">
					<?= isset($_SESSION['confirmation']) ? "<p style='color: #086c08; background: radial-gradient(#8efa9a82, rgb(0, 255, 102));backdrop-filter: blur(5px);
	border: 1px solid rgb(3,67,11); box-shadow: 0 0 10px rgb(54,223,74); font-size: 20px; font-weight: 600; border-radius: 10px; width: max(45vw, 250px); padding: 5px 10px; text-align: center'> Merci pour votre engagement</p>":"";
	unset($_SESSION['confirmation']);?>

					<?= isset($_SESSION['error']) ? "<p style='color:red; background: radial-gradient(#ff000082, rgba(255, 0, 0, 0.126));backdrop-filter: blur(5px);
	border: 1px solid rgb(216,118,118);color: #ff8d79; box-shadow: 0 0 10px rgb(216,118,118); font-size: 20px; margin-top:10px; width: max-content; padding: 5px 10px; margin: 10px auto;'> {$_SESSION['error']} </p>":"";
	unset($_SESSION['error']);?>
					<progress max="100" value="10"></progress><hr>
					<h2>Q1: Qui êtes vous ?</h2>
					<div class="answers-box">
						<label for="name"><span>*</span>Nom: <input type="text" id="name" name="name" placeholder="Nom" required></label>
						
						<label for="surname"><span>*</span>Prénom: <input type="text" id="surname" name="surname" placeholder="Prénom" required>
</label>
						<label for="age"><span>*</span>Date de naissance: <input id="age" name="age" type="date" min="1920-01-01" max="2042-01-01" required>
</label>
					</div>
					<div class="switch-slide"> 
						<span></span><p>next</p>
					</div>
				</div>

			</form>
	</main>
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
				<li><a href="./UPH-join.html">Adhérer</a></li>
				<li><a href="./UPH-don.php">Faire un don</a></li>
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

const totalSlides = document.querySelectorAll('.question-box').length
        let num = totalSlides-1;
		let name = document.getElementById('name');
		let surname = document.getElementById('surname');
		let age = document.getElementById('age');
		const minDate = new Date('1920-01-01');
		const maxDate = new Date('2042-01-01');
		let list = [name, surname, age];

	
        document.querySelectorAll('.switch-slide').forEach(slide => {

            //next slide
            slide.children[1].addEventListener('click', function() {
	
                if (num > 0){
					if (num == totalSlides-1) {
						birthDate = new Date(age.value);
						if (name.value == '' || surname.value == '' || (birthDate < minDate || birthDate > maxDate || age.value == '')) {
							document.getElementsByClassName('question-box')[num].style.setProperty('--before-opacity', '1');
							document.getElementsByClassName('question-box')[num].style.setProperty('--before-scale', '1.2');
							setTimeout(() => {
								document.getElementsByClassName('question-box')[num].style.setProperty('--before-opacity', '0');
							}, 2500);
							setTimeout(() => {
								document.getElementsByClassName('question-box')[num].style.setProperty('--before-scale', '0');
							}, 2800);
							return;
						}
					} else if (num=== 1){
						let regexTel = /^([0-9]{2}([\-\.\_\s])*){5}$/;
						let regexEmail = /^[\w.+-]+@[a-zA-Z0-9-]+(\.[a-zA-Z]{2,})+$/;
						if(document.getElementById('tel').checked && !regexTel.test(document.getElementById('tel-input').value)){
							document.getElementById('tel-input').style="background-color: #ff5d5d82";
							setTimeout(() => {document.getElementById('tel-input').style="background:''"}, 1500);
							return;
						} else if (document.getElementById('email').checked && !regexEmail.test(document.getElementById('email-input').value)){
							document.getElementById('email-input').style="background-color: #ff5d5d82";
							setTimeout(() => {document.getElementById('email-input').style="background:''"}, 1500);
							return;
						} 
					}
                    document.getElementsByClassName('question-box')[num].classList.add('slideAway');
                    document.getElementsByClassName('question-box')[num].classList.remove('slideBack');
                    num -= 1
                    };
                })

        

            //previous slide
            slide.children[0].addEventListener('click', function() {
                if (num < totalSlides-1){
                    num += 1;
                    document.getElementsByClassName('question-box')[num].classList.add('slideBack');
                    document.getElementsByClassName('question-box')[num].classList.remove('slideAway');
                }
            })
        })
		
		document.getElementById('tel').addEventListener('click', function(){
			$telInput = document.getElementById('tel-input');
			$telInput.value ="";
			$telInput.toggleAttribute('disabled');
		})
		document.getElementById('email').addEventListener('click', function() {
  		document.getElementById('email-input').value = '';
		document.getElementById('email-input').toggleAttribute('disabled');
});

</script>

</body>
</html>
