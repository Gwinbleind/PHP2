<?php
/** @var \app\models\User $user
 * @var string $pass
 */?>
<div class="container">
	<div class="container_horizontal div_flex">
		<?if (!$user->validation()):?>
			<div class="div_colwrap div_flex">
		   <div class="div_flex">
		       <div :class="loginButtonClass(!logOrRegStatus)" @click="loginOrRegisterClickHandler(0)"><span>Log In</span></div>
		       <div :class="loginButtonClass(logOrRegStatus)" @click="loginOrRegisterClickHandler(1)"><span>Register</span></div>
		   </div>
		   <label class="div_flex my_account__label">Username:<input class="choose__box" type="text" v-model="loginForm.Name" required></label>
		   <label class="div_flex my_account__label">Password:<input class="choose__box" type="password" v-model="loginForm.Password" required></label>
		   <template v-if="logOrRegStatus">
		       <label class="div_flex my_account__label">E-mail:<input class="choose__box" type="email" v-model="registerForm.Mail" required></label>
		       <label class="div_flex my_account__label">Age:<input class="choose__box" type="number" v-model="registerForm.Age" required></label>
		   </template>
		   <div class="button button_login div_flex" @click="logOrRegHandler">{{logOrReg}}</div>
		</div>
		<?else:?>
			<div>
            <p class="footer__link">Username: <?=$user->login?></p>
            <p class="footer__link">Password hash: <?=$user->password_hash?></p>
            <p class="footer__link">Password: <?=$user->pass?></p>
            <div class="button button_login div_flex" @click="logoutClickHandler">Logout</div>
        </div>
		<?endif;?>
	</div>
</div>