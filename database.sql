CREATE DATABASE IF NOT EXISTS blog_managment_system;
USE blog_managment_system;

CREATE TABLE user (
    id INT(10) NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL, -- Changed from TEXT to VARCHAR(100) for better length control
    password VARCHAR(100) NOT NULL,
    PRIMARY KEY (id) -- Correct syntax for PRIMARY KEY
);


CREATE TABLE main_blog(
    id INT(10) NOT NULL AUTO_INCREMENT,
    element_name VARCHAR(255) NOT NULL,
    element_id VARCHAR(255) NOT NULL,
    h VARCHAR(255) NOT NULL,
    color VARCHAR(255) NOT NULL,
    sr_no VARCHAR(255) NOT NULL,
    tag VARCHAR(255) NOT NULL,
    text_alignment VARCHAR(255) NOT NULL,
    value VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);
CREATE TABLE blog_token(
    id INT(10) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    token INT(10) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE borrowing_records(
    id INT(10) NOT NULL AUTO_INCREMENT,
    book_id INT(10) NOT NULL,
    borrower_name VARCHAR(255) NOT NULL,
    borrow_date VARCHAR(255) NOT NULL,
    return_date VARCHAR(255) NOT NULL,
    author_id INT(10) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE users(
    id INT(10) NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);
ALTER TABLE book_author
ADD FOREIGN KEY (book_id) REFERENCES books(book_id);





















ALTER TABLE authors RENAME COLUMN id TO author_id;☻








