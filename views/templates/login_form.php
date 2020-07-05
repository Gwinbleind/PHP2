<div class="container">
	<div class="container_horizontal div_flex">
		<form @submit="logOrRegHandler" method="post">
			<div class="div_colwrap div_flex">
				<div class="div_flex">
					<div :class="loginButtonClass(!logOrRegStatus)" @click="loginOrRegisterClickHandler(0)"><span>Log In</span></div>
					<div :class="loginButtonClass(logOrRegStatus)" @click="loginOrRegisterClickHandler(1)"><span>Register</span></div>
				</div>
				<label class="div_flex my_account__label">Username:<input class="choose__box" type="text" v-model="loginForm.Name" name="login" required></label>
				<label class="div_flex my_account__label">Password:<input class="choose__box" type="password" v-model="loginForm.Password" name="pass" required></label>
				<template v-if="logOrRegStatus">
					<label class="div_flex my_account__label">E-mail:<input class="choose__box" type="email" v-model="registerForm.Mail" name="mail" required></label>
					<label class="div_flex my_account__label">Age:<input class="choose__box" type="number" v-model="registerForm.Age" name="age" required></label>
				</template>
				<div v-else>
					<label class="div_flex my_account__label">Save<input type="checkbox" name="save"></label>
				</div>
				<input class="button button_login div_flex" type="submit" :value="logOrReg">
			</div>
		</form>
	</div>
</div>