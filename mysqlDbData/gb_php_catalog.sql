create table catalog
(
    id          int auto_increment
        primary key,
    name        varchar(30)            null,
    price       decimal                not null,
    amount      int         default 1  not null,
    category    int                    not null,
    imgSmall    varchar(60) default '' not null,
    imgMedium   varchar(60) default '' not null,
    imgLarge    varchar(60) default '' not null,
    description text                   null
);

INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (1, 'MANGO White T-Shirt', 52, 1, 1, 'img/imgSmall/Product_1.png', 'img/imgMedium/Product_1.png', 'img/imgMedium/Product_1.png', 'MANGO White T-ShirtMANGO White T-ShirtMANGO White T-ShirtMANGO White T-Shirt');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (2, 'MANGO Red Blouse', 52, 1, 2, 'img/imgSmall/Product_2.png', 'img/imgMedium/Product_2.png', 'img/imgMedium/Product_2.png', 'MANGO Red BlouseMANGO Red BlouseMANGO Red BlouseMANGO Red Blouse');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (3, 'MANGO Blue Skirt', 52, 1, 1, 'img/imgSmall/Product_3.png', 'img/imgMedium/Product_3.png', 'img/imgMedium/Product_3.png', 'MANGO Blue SkirtMANGO Blue SkirtMANGO Blue SkirtMANGO Blue Skirt');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (4, 'MANGO Flower Blouse', 52, 1, 2, 'img/imgSmall/Product_4.png', 'img/imgMedium/Product_4.png', 'img/imgMedium/Product_4.png', 'MANGO Flower BlouseMANGO Flower BlouseMANGO Flower BlouseMANGO Flower Blouse');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (5, 'MANGO B/W Blouse', 52, 1, 2, 'img/imgSmall/Product_5.png', 'img/imgMedium/Product_5.png', 'img/imgMedium/Product_5.png', 'MANGO B/W BlouseMANGO B/W BlouseMANGO B/W BlouseMANGO B/W Blouse');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (6, 'MANGO Grey Star', 52, 1, 1, 'img/imgSmall/Product_6.png', 'img/imgMedium/Product_6.png', 'img/imgMedium/Product_6.png', 'MANGO Grey Star');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (7, 'MANGO Strange Pants', 52, 1, 1, 'img/imgSmall/Product_7.png', 'img/imgMedium/Product_7.png', 'img/imgMedium/Product_7.png', 'MANGO Strange Pants');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (8, 'MANGO LOL Hat', 52, 1, 1, 'img/imgSmall/Product_8.png', 'img/imgMedium/Product_8.png', 'img/imgMedium/Product_8.png', 'MANGO LOL Hat');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (9, 'MANGO Strange T-SHIRT', 52, 1, 1, 'img/imgSmall/Product_12.jpg', 'img/imgMedium/Product_12.jpg', 'img/imgMedium/Product_12.jpg', 'MANGO Strange T-SHIRT');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (10, 'MANGO Black Long Smth', 52, 1, 1, 'img/imgSmall/Product_13.jpg', 'img/imgMedium/Product_13.jpg', 'img/imgMedium/Product_13.jpg', 'MANGO Black Long Smth');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (11, 'MANGO Black Coat', 52, 1, 1, 'img/imgSmall/Product_14.jpg', 'img/imgMedium/Product_14.jpg', 'img/imgMedium/Product_14.jpg', 'MANGO Black Coat');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (12, 'MANGO Cool Beard', 52, 1, 1, 'img/imgSmall/Product_15.jpg', 'img/imgMedium/Product_15.jpg', 'img/imgMedium/Product_15.jpg', 'MANGO Cool Beard');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (13, 'MANGO Black Romb Coat', 52, 1, 1, 'img/imgSmall/Product_16.jpg', 'img/imgMedium/Product_16.jpg', 'img/imgMedium/Product_16.jpg', 'MANGO Black Romb Coat');
INSERT INTO gb_php.catalog (id, name, price, amount, category, imgSmall, imgMedium, imgLarge, description) VALUES (14, 'MANGO Cool Cardigan', 52, 1, 1, 'img/imgSmall/Product_17.jpg', 'img/imgMedium/Product_17.jpg', 'img/imgMedium/Product_17.jpg', 'MANGO Cool Cardigan');