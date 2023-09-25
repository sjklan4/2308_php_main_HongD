---고객 테이블
CREATE TABLE customers (
custom_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
,nameid VARCHAR(20) NOT NULL
,address VARCHAR(100) NOT NULL
,zipcode VARCHAR(10)
);

---주문테이블
CREATE TABLE orders (
order_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
,custom_id INT UNSIGNED NOT NULL REFERENCES customers(custom_id)
,amount INT UNSIGNED 
,amount_datd DATE NOT NULL
,order_status VARCHAR(10)
,ship_name VARCHAR(50) NOT NULL
,ship_address VARCHAR(100) NOT NULL
,ship_zipcode VARCHAR(10)
);

---상품 테이블
CREATE TABLE books(
isbn VARCHAR(10) NOT NULL PRIMARY KEY
,author VARCHAR(50)
,title VARCHAR(100)
,catid INT UNSIGNED 
,price INT UNSIGNED NOT NULL
,detail VARCHAR(255)
);

--카테고리 테이블
CREATE TABLE categories (
catid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
,cat_name VARCHAR(50) NOT NULL
);


-- 주문 항목  테이블
CREATE TABLE order_items(
order_id INT UNSIGNED NOT NULL REFERENCES	orders(order_id)
,isbn VARCHAR(10) NOT NULL REFERENCES books(isbn)
,item_price INT UNSIGNED NOT NULL
,quantity TINYINT UNSIGNED NOT NULL
,PRIMARY KEY (order_id,isbn)
);

--관리자 테이블 

CREATE TABLE admins(
username VARCHAR(20) NOT NULL PRIMARY KEY
,PASSWORD VARCHAR(40) NOT NULL
);












