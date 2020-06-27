create table users
(
    id            int auto_increment
        primary key,
    login         text not null,
    password_hash text not null,
    session_hash  text not null
);

INSERT INTO gb_php.users (id, login, password_hash, session_hash) VALUES (1, 'admin', '$2y$10$xsxfs4GncefRLvYDdptqjOHutqR/cSRIEj76BZ01GnwpxmaYd1sXe', '5ef756be945305.58285617');
INSERT INTO gb_php.users (id, login, password_hash, session_hash) VALUES (2, 'user', '$2y$10$xsxfs4GncefRLvYDdptqjOHutqR/cSRIEj76BZ01GnwpxmaYd1sXe', '5ed3fb1d58cff1.35861664');
INSERT INTO gb_php.users (id, login, password_hash, session_hash) VALUES (3, 'geek', '$2y$10$CWfaM13na2p2hQXsVu6Pkew/pnkUAlqZXm8pp6HDeM8eIekmwk2JK', '');