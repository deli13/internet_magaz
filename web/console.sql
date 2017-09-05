DROP TABLE IF EXISTS product;
drop TABLE IF EXISTS catalog;
DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS post;
CREATE TABLE catalog (
  id         INT PRIMARY KEY AUTO_INCREMENT,
  name       VARCHAR(2000) NOT NULL,
  parent     INT,
  created_at TIMESTAMP       DEFAULT current_timestamp,
  updated_at TIMESTAMP DEFAULT now() ON UPDATE now(),
  slug VARCHAR(2000)
) DEFAULT CHARSET utf8;
CREATE TABLE product (
  id   INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(2000) NOT NULL,
  article int NOT NULL ,
  price_roznica FLOAT DEFAULT 0,
  price_1 FLOAT DEFAULT 0,
  price_2 FLOAT DEFAULT 0,
  price_3 FLOAT DEFAULT 0,
  price_4 FLOAT DEFAULT 0,
  remain VARCHAR(20) DEFAULT 0,
  created_at TIMESTAMP DEFAULT current_timestamp,
  updated_at TIMESTAMP DEFAULT now() ON UPDATE now(),
  image VARCHAR (100),
  slug VARCHAR(2000),
  id_catalog INT NOT NULL,
  FOREIGN KEY (id_catalog) REFERENCES catalog(id)
)DEFAULT CHARSET utf8;
CREATE TABLE cart (
  id int PRIMARY KEY AUTO_INCREMENT,
  cart VARCHAR(2000),
  name VARCHAR(2000),
  email VARCHAR(2000),
  phone VARCHAR(100),
  created_at TIMESTAMP DEFAULT current_timestamp
) DEFAULT CHARSET utf8;
CREATE TABLE post(
  id int PRIMARY KEY AUTO_INCREMENT,
  title varchar(2000) NOT NULL ,
  text text,
  created_at TIMESTAMP DEFAULT current_timestamp,
  slug VARCHAR(2000)
) DEFAULT CHARSET utf8;