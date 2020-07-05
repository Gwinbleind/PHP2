create table cart
(
    id        int auto_increment
        primary key,
    userId    int null,
    productId int null,
    amount    int null
);

INSERT INTO gb_php.cart (id, userId, productId, amount) VALUES (1, 1, 1, 2);
INSERT INTO gb_php.cart (id, userId, productId, amount) VALUES (2, 1, 3, 1);
INSERT INTO gb_php.cart (id, userId, productId, amount) VALUES (3, 2, 4, 4);