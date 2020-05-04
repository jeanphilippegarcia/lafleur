<form action="cible.php" method="post" id="form" class="w100">
	<div class="form-title center padtop padbottom">
		<h1 class="medium uppercase-font">envoyez-nous un message</h1>		
	</div>
	<div class="form-content">
		<div class="label-first">
			<label for="name">
				Veuillez taper votre nom&nbsp;:
			</label>
		</div>
			<input type="text"
			name="name"
			id="name"
			class="w100"
			placeholder="ex : Bud"/>

		<div class="labels">
			<label for="email" class="padtop">
				Veuillez taper votre adresse email&nbsp;:
			</label>
		</div>
			<input type="email"
			name="email"
			id="email"
			class="w100"
			placeholder="ex : bud@oil.com" required />

		<div class="labels">
			<label for="message">
				Veuillez taper votre message&nbsp;:
			</label>
		</div>

		<textarea name="message" rows="8" cols="45" id="message"
		class="w100"
		placeholder="Votre message ici.">
		</textarea>

		<p class="center">
			<button type="submit"
			name="submit"
			id="submit"
			class="form-button medium center">envoyer</button>
		</p>
	</div>
</form>
