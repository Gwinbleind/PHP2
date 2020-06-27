<?php /** @var \app\models\User $user */?>
<div class="container">
	<div class="container_horizontal div_flex">
		<div>
		    <p class="footer__link">Username: <?=$user->login?></p>
		    <p class="footer__link">Password hash: <?=$user->password_hash?></p>
		    <p class="footer__link">Password: <?=$user->pass?></p>
		    <div class="button button_login div_flex" @click="logoutClickHandler">Logout</div>
		</div>
	</div>
</div>