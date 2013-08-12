<?php snippet('header') ?>
<?php snippet('navigation') ?>

<div class="container">
	<div class="grid full">
		<div id="email">
			
			<form action="/subscribe.php" id="subscribe" method="POST" class="center">
				<span>Enter your email to sign up</span>
				<p><input type="text" placeholder="Firstname" name="fname" id="fname" /></p>
				<p><input type="text" placeholder="Lastname" name="lname" id="lname" /></p>
				<p><input type="text" placeholder="your@email.com*" name="email" id="address" /></p>
				<p><input type="submit" value="Signup" /></p>
				<p><span id="result"></span></p>
			</form>
			
		</div>
	</div>
	<div class="cf"></div>
</div>

<?php snippet('panel') ?>
<?php snippet('footer') ?>

