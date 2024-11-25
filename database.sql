CREATE DATABASE IF NOT EXISTS blog_managment_system;
USE blog_managment_system;

CREATE TABLE books_management (
    id INT(10) NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL, -- Changed from TEXT to VARCHAR(100) for better length control
    author_id INT(10) NOT NULL,
    category VARCHAR(100) NOT NULL, -- Changed from TEXT to VARCHAR(100)
    published_year VARCHAR(4) NOT NULL, -- Reduced length to 4 (e.g., "2024")
    PRIMARY KEY (id) -- Correct syntax for PRIMARY KEY
);


CREATE TABLE authors_management(
    id INT(10) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    bio VARCHAR(1000) NOT NULL,
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








