<?php /** @var \app\models\User $user */?>
<header class="header">
    <div class="header_flex">
        <!-- Левая часть -->
        <div class="container__left div_flex">
            <a href="/" class="logo div_flex">
                <img alt="logo" class="logo__img" src="img\logo.png"><span class="logo_1">BRAN</span><span class="logo_2"><b>D</b></span>
            </a>
            <form action="#" class="header__form">
                <div class="search__browse div_flex">
                    <span>Browse</span> <!-- Выпадающее меню на Browse -->
                    <span class="browse__fa_caret"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                    <div class="drop search__drop">
                        <div class="dropflex">
                            <div class="drop__h3">Women</div>
                            <ul class="drop__list">
                                <li><a class="drop__link" href="">Dresses</a></li>
                                <li><a class="drop__link" href="">Tops</a></li>
                                <li><a class="drop__link" href="">Sweaters/Knits</a></li>
                                <li><a class="drop__link" href="">Jackets/Coats</a></li>
                                <li><a class="drop__link" href="">Blazers</a></li>
                                <li><a class="drop__link" href="">Denim</a></li>
                                <li><a class="drop__link" href="">Leggings/Pants</a></li>
                                <li><a class="drop__link" href="">Skirts/Shorts</a></li>
                                <li><a class="drop__link" href="">Accessories</a></li>
                            </ul>
                        </div>
                        <div class="dropflex">
                            <div class="drop__h3">Men</div>
                            <ul class="drop__list">
                                <li><a class="drop__link" href="">Tees/Tank tops</a></li>
                                <li><a class="drop__link" href="">Shirts/Polos</a></li>
                                <li><a class="drop__link" href="">Sweaters</a></li>
                                <li><a class="drop__link" href="">Sweatshirts/Hoodies</a></li>
                                <li><a class="drop__link" href="">Blazers</a></li>
                                <li><a class="drop__link" href="">Jackets/vests</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <input class="search__text" placeholder="Search for Item..." type="text">
                <button type="submit" class="search__button"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <!-- Правая часть -->
        <div class="container__right div_flex">
            <div class="cart__container">
                <a href="#">
                    <img src="img\Cart.svg" alt="cart" class="cart__img">
                </a>
                <div class="drop drop__cart">
                    <cart-list-component :items="cart.items" @delete="cartXClickHandler"></cart-list-component>
                    <div class="cart__total"><span>TOTAL</span><span>${{totalCostCart}}.00</span></div>
                    <a href="#" class="cart__check div_flex"><span>Checkout</span></a>
                    <a href="#" class="button_goto div_flex"><span>Go to cart</span></a>
                </div>
            </div>
            <div class="my_account div_flex">
                <span>My Account</span>
                <span class="my_account__fa_caret"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                <!--Выпадающее меню аккаунт-->
                <div id="dropUser" class="drop drop__account">
	                 <? if (!empty($user->login)):?>
                    <div>
                        <a class="story__name" href="http://php2/?c=user">Account</a>
                        <p class="drop__link">Username: <?=$user->login?></p>
                        <p class="drop__link">E-mail: <?=$user->mail?></p>
                        <p class="drop__link">Age: <?=$user->age?></p>
                        <!--							<button @click="logoutClickHandler">Logout</button>-->
                        <div class="button button_login div_flex" @click="logoutClickHandler">Logout</div>
                    </div>
	                 <?else:?>
                        <a href="http://php2/?c=user">Login</a>
	                 <?endif;?>
                </div>
            </div>
        </div>
    </div>
</header>
<nav>
    <!-- Список меню -->
    <ul class="menu">
        <li class="menu__list"><a href="/" class="menu__link">Home</a></li>
        <li class="menu__list"><a href="http://php2?c=product&a=card&id=1" class="menu__link">Man</a></li>
        <li class="menu__list">
            <a href="http://php2?c=product&a=card&id=1" class="menu__link">Women</a>
            <!-- Выпадающее меню, завязанное на "Women" menu link -->
            <div class="drop menu__drop">
                <div class="dropflex">
                    <div class="drop__h3">Women</div>
                    <ul class="drop__list">
                        <li><a class="drop__link" href="">Dresses</a></li>
                        <li><a class="drop__link" href="">Tops</a></li>
                        <li><a class="drop__link" href="">Sweaters/Knits</a></li>
                        <li><a class="drop__link" href="">Jackets/Coats</a></li>
                        <li><a class="drop__link" href="">Blazers</a></li>
                        <li><a class="drop__link" href="">Denim</a></li>
                        <li><a class="drop__link" href="">Leggings/Pants</a></li>
                        <li><a class="drop__link" href="">Skirts/Shorts</a></li>
                        <li><a class="drop__link" href="">Accessories</a></li>
                    </ul>
                </div>
                <div class="dropflex">
                    <div class="drop__h3">Women</div>
                    <ul class="drop__list">
                        <li><a class="drop__link" href="">Dresses</a></li>
                        <li><a class="drop__link" href="">Tops</a></li>
                        <li><a class="drop__link" href="">Sweaters/Knits</a></li>
                        <li><a class="drop__link" href="">Jackets/Coats</a></li>
                    </ul>
                </div>
                <div class="dropflex">
                    <div class="drop__h3">Women</div>
                    <ul class="drop__list">
                        <li><a class="drop__link" href="">Dresses</a></li>
                        <li><a class="drop__link" href="">Tops</a></li>
                        <li><a class="drop__link" href="">Sweaters/Knits</a></li>
                    </ul>
                </div>
                <div class="dropflex">
                    <div class="drop__h3">Women</div>
                    <ul class="drop__list">
                        <li><a class="drop__link" href="">Dresses</a></li>
                        <li><a class="drop__link" href="">Tops</a></li>
                        <li><a class="drop__link" href="">Sweaters/Knits</a></li>
                        <li><a class="drop__link" href="">Jackets/Coats</a></li>
                    </ul>
                </div>
                <img src="img/Drop_img_1.jpg" alt="" class="drop__img">
                <span class="drop__img_text">Super<br>sale!</span>
            </div>
        </li>
        <li class="menu__list"><a href="http://php2?c=product&a=card&id=1" class="menu__link">Kids</a></li>
        <li class="menu__list"><a href="http://php2?c=product&a=card&id=1" class="menu__link">Accoseriese</a></li>
        <li class="menu__list"><a href="http://php2?c=product&a=card&id=1" class="menu__link">Featured</a></li>
        <li class="menu__list">
            <a href="http://php2?c=product&a=card&id=1" class="menu__link">Hot Deals</a>
            <div class="drop menu__drop menu__drop_last">
                <div class="dropflex">
                    <div class="drop__h3">Women</div>
                    <ul class="drop__list">
                        <li><a class="drop__link" href="">Dresses</a></li>
                        <li><a class="drop__link" href="">Tops</a></li>
                        <li><a class="drop__link" href="">Sweaters/Knits</a></li>
                        <li><a class="drop__link" href="">Jackets/Coats</a></li>
                        <li><a class="drop__link" href="">Blazers</a></li>
                        <li><a class="drop__link" href="">Denim</a></li>
                        <li><a class="drop__link" href="">Leggings/Pants</a></li>
                        <li><a class="drop__link" href="">Skirts/Shorts</a></li>
                        <li><a class="drop__link" href="">Accessories</a></li>
                    </ul>
                </div>
                <div class="dropflex">
                    <div class="drop__h3">Women</div>
                    <ul class="drop__list">
                        <li><a class="drop__link" href="">Dresses</a></li>
                        <li><a class="drop__link" href="">Tops</a></li>
                        <li><a class="drop__link" href="">Sweaters/Knits</a></li>
                        <li><a class="drop__link" href="">Jackets/Coats</a></li>
                    </ul>
                </div>
                <div class="dropflex">
                    <div class="drop__h3">Women</div>
                    <ul class="drop__list">
                        <li><a class="drop__link" href="">Dresses</a></li>
                        <li><a class="drop__link" href="">Tops</a></li>
                        <li><a class="drop__link" href="">Sweaters/Knits</a></li>
                    </ul>
                </div>
                <div class="dropflex">
                    <div class="drop__h3">Women</div>
                    <ul class="drop__list">
                        <li><a class="drop__link" href="">Dresses</a></li>
                        <li><a class="drop__link" href="">Tops</a></li>
                        <li><a class="drop__link" href="">Sweaters/Knits</a></li>
                        <li><a class="drop__link" href="">Jackets/Coats</a></li>
                    </ul>
                </div>
                <img src="img/Drop_img_1.jpg" alt="" class="drop__img">
                <span class="drop__img_text">Super<br>sale!</span>
            </div>
        </li>
    </ul>
</nav>