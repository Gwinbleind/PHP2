create table categories
(
    id   int auto_increment
        primary key,
    name text not null
);

INSERT INTO gb_php.categories (id, name) VALUES (1, 'Men');
INSERT INTO gb_php.categories (id, name) VALUES (2, 'Women');
INSERT INTO gb_php.categories (id, name) VALUES (3, 'Child');