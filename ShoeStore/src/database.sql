GRANT ALL ON shoestore.* to 'root'@'localhost'; 

-- Create database
CREATE database shoestore;

-- Switch to database
USE shoestore;

CREATE TABLE customers (
    cusername VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    level VARCHAR(10) NOT NULL,
    fname VARCHAR(15) NOT NULL,
    lname VARCHAR(20) NOT NULL,
    phone CHAR(10),
    addr VARCHAR(60),
    PRIMARY KEY (cusername)
);

CREATE TABLE warehouses (
    wcity VARCHAR(20),
    wstate VARCHAR(15),
    wcountry VARCHAR(20),
    wid int NOT NULL,
    PRIMARY KEY (wid)
);

CREATE TABLE orders (
    oid int NOT NULL AUTO_INCREMENT,
    odate DATE NOT NULL, 
    oday VARCHAR(9) NOT NULL, 
    otime TIME NOT NULL,
    totalcost DECIMAL(10,2) NOT NULL,
    wid int NOT NULL,
    PRIMARY KEY (oid),
    FOREIGN KEY (wid) REFERENCES warehouses(wid)
);

CREATE TABLE employees (
    fname VARCHAR(15) NOT NULL,
    lname VARCHAR(20) NOT NULL,
    cusername VARCHAR(30),
    eid int NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL, 
    addr VARCHAR(60),
    phone CHAR(10),
    wid int NOT NULL,
    PRIMARY KEY (eid),
    FOREIGN KEY (cusername) REFERENCES customers(cusername),
    FOREIGN KEY (wid) REFERENCES warehouses(wid)
);

CREATE TABLE shoes (
    name VARCHAR(40) NOT NULL,
    sid int NOT NULL,
    cost DECIMAL(8,2) NOT NULL,
    classification VARCHAR(15),
    brand_name VARCHAR(15) NOT NULL,
    PRIMARY KEY (sid)
);

CREATE TABLE places_order (
    oid int NOT NULL,
    cusername VARCHAR(30) NOT NULL,
    PRIMARY KEY(oid, cusername),
    FOREIGN KEY (oid) REFERENCES orders(oid),
    FOREIGN KEY (cusername) REFERENCES customers(cusername)
);

CREATE TABLE order_of (
    sid int NOT NULL,
    oid int NOT NULL,
    qty int NOT NULL,
    PRIMARY KEY (sid, oid),
    FOREIGN KEY (sid) REFERENCES shoes(sid),
    FOREIGN KEY (oid) REFERENCES orders(oid)
);

CREATE TABLE colorways (
    name VARCHAR(25),
    description VARCHAR(100),
    sid int NOT NULL,
    PRIMARY KEY (name, sid),
    FOREIGN KEY (sid) REFERENCES shoes(sid)
);

CREATE TABLE sizes (
    size DECIMAL(3, 1) NOT NULL,
    sid int NOT NULL,
    PRIMARY KEY (size, sid),
    FOREIGN KEY (sid) REFERENCES shoes(sid)
);

INSERT INTO customers VALUES 
    ('jd123', 'heartwea41', 'Gold', 'John', 'Doe', '1234567890', '123 Main St, Cityville, TX'),
    ('izzym112', 'fewfkw4iocw', 'Silver', 'Isabel', 'Manning', '9876543210', '456 Oak St, Townsville, CT'),
    ('robjohn4', 'welmon76!j', 'Bronze', 'Robert', 'Johnson', '5551112233', '789 Pine St, Villageton, CT'),
    ('ebrown11', 'aasiqc2212', 'Platinum', 'Emily', 'Brown', '2223334444', '456 Elm St, Hamletown, NJ'),
    ('mw112', 'jcjoq8815', 'Silver', 'Michael', 'Williams', '7778889999', '789 Birch St, Countryside, UT'),
    ('OliviaM2', '87sweet71', 'Gold', 'Olivia', 'Miller', '3334445555', '123 Cedar St, Suburbia, MA'),
    ('DAnd1333', 'hceowe8ww', 'Bronze', 'Daniel', 'Anderson', '6667778888', '789 Oak St, Villageton, ME'),
    ('SMoore01', 'wwppcua710', 'Platinum', 'Sophia', 'Moore', '1112223333', NULL),
    ('MJones1', 'veiovcew923', 'Silver', 'Matthew', 'Jones', NULL, '123 Maple St, Countryside, RI'),
    ('EBrown1', 'cvweoiqw02', 'Gold', 'Emma', 'Brown', NULL, NULL);

INSERT INTO warehouses VALUES 
    ('New York City', 'New York', 'USA', 1),
    ('Los Angeles', 'California', 'USA', 2),
    ('Chicago', 'Illinois', 'USA', 3),
    ('Houston', 'Texas', 'USA', 4),
    ('Phoenix', 'Arizona', 'USA', 5),
    ('Philadelphia', 'Pennsylvania', 'USA', 6),
    ('San Antonio', 'Texas', 'USA', 7),
    ('San Diego', 'California', 'USA', 8),
    ('Dallas', 'Texas', 'USA', 9),
    ('San Jose', 'California', 'USA', 10);

INSERT INTO orders VALUES 
    (NULL, '2023-11-24', 'Wednesday', '12:00:00', 149.99, 1),
    (NULL, '2023-11-25', 'Thursday', '14:30:00', 179.98, 2),
    (NULL, '2023-11-26', 'Friday', '16:45:00', 309.98, 3),
    (NULL, '2023-11-27', 'Saturday', '18:15:00', 499.95, 1),
    (NULL, '2023-11-28', 'Sunday', '20:30:00', 900.50, 2),
    (NULL, '2023-11-29', 'Monday', '10:45:00', 89.99, 3),
    (NULL, '2023-11-30', 'Tuesday', '22:00:00', 579.95, 1),
    (NULL, '2023-12-01', 'Wednesday', '23:00:00', 59.99, 2),
    (NULL, '2023-12-02', 'Friday', '15:45:00', 319.98, 3),
    (NULL, '2023-12-03', 'Friday', '16:30:00', 89.99, 1),
    (NULL, '2023-12-03', 'Saturday', '16:00:00', 89.99, 1);

INSERT INTO employees VALUES 
    ('Alice', 'Johnson', NULL, 101, 'cvw1iqw02', '789 Maple St, Villageton, NJ', '1112223333', 1),
    ('Bob', 'Smith', NULL, 102, '23rfw02', '456 Cedar St, Townsville, NJ', '4445556666', 2),
    ('Charlie', 'Davis', NULL, 103, 'ceqio10cv', '123 Pine St, Providence, RI', '7778889999', 3),
    ('David', 'Williams', NULL, 104, 'swcwq25', '789 Birch St, Countryside, PA', '9990001111', 4),
    ('Emma', 'Brown', 'EBrown1', 105, 'aacwh5t3', '456 Elm St, Hamletown, CT', '2223334444', 5),
    ('Frank', 'Miller', NULL, 106, '0o0oru2', '123 Cedar St, Suburbia, CA', '6667778888', 6),
    ('Grace', 'Anderson', NULL, 107, '66yes1', '789 Oak St, Villageton, CA', NULL, 7),
    ('Henry', 'Moore', NULL, 108, 'pass12235', '456 Pine St, Cityville, WA', '8889990000', 8),
    ('Isaac', 'Jones', NULL, 109, 'prov', NULL, '5556667777', 9),
    ('Jessica', 'Davis', NULL, 110, 'qqpwivw', NULL, NULL, 10);

INSERT INTO shoes VALUES 
    ('574 Core', 1, 89.99, 'Running', 'New Balance'),
    ('Retro 4', 2, 149.99, 'Basketball', 'Jordan'),
    ('Air Max 90', 3, 129.99, 'Casual', 'Nike'),
    ('Avignon Crystal Formal Loafers', 4, 179.99, 'Formal', 'Moretti'),
    ('Steel Toe Work Boot', 5, 99.99, 'Boots', 'Timberland'),
    ('Retro 5', 6, 109.99, 'Basketball', 'Jordan'),
    ('Dunk Low', 7, 109.99, 'Basketball', 'Nike'),
    ('MB1 Low', 8, 119.99, 'Basketball', 'Puma'),
    ('Rincon 3', 9, 89.99, 'Running', 'Hoka'),
    ('Ultraboost 1.0 DNA', 10, 129.99, 'Running', 'Adidas'),
    ('Tazz', 11, 59.99, 'Casual', 'Ugg'),
    ('Trevor Formal Loafers', 12, 159.99, 'Formal', 'Moretti'),
    ('Pharaoh Cap Toe Lace Up', 13, 209.99, 'Formal', 'Stacy Adams'),
    ('Authentic Shoe', 14, 55.99, NULL, 'Vans');

INSERT INTO places_order VALUES 
    (1, 'jd123'),
    (2, 'izzym112'),
    (3, 'robjohn4'),
    (4, 'ebrown11'),
    (5, 'mw112'),
    (6, 'OliviaM2'),
    (7, 'DAnd1333'),
    (8, 'SMoore01'),
    (9, 'MJones1'),
    (10, 'EBrown1'),
    (11, 'EBrown1');

INSERT INTO order_of VALUES 
    (2, 1, 1),
    (1, 2, 2),
    (3, 3, 1),
    (4, 3, 1),
    (5, 5, 2),
    (1, 5, 2),
    (8, 5, 1),
    (9, 6, 1),
    (10, 7, 4),
    (11, 7, 1),
    (11, 8, 1),
    (12, 9, 2),
    (1, 10, 1);

INSERT INTO colorways VALUES
    ('Black', 'Plain Black', 4),
    ('Black', 'Plain Black', 12),
    ('Black', 'Plain Black', 13),
    ('Black', 'Plain Black', 5),
    ('Black', 'Plain Black', 14),
    ('White', 'Plain White', 1),
    ('White', 'Plain White', 2),
    ('White', 'Plain White', 3),
    ('White', 'Plain White', 6),
    ('White', 'Plain White', 7),
    ('White', 'Plain White', 8),
    ('White', 'Plain White', 9),
    ('White', 'Plain White', 10),
    ('White', 'Plain White', 14),
    ('Tan', 'Plain Tan', 5),
    ('Tan', 'Plain Tan', 11),
    ('Carolina Blue', 'Light "Carolina" Blue and White', 6),
    ('Carolina Blue', 'Light "Carolina" Blue and White', 14),
    ('Forest', 'Dark Green and White', 1),
    ('Forest', 'Dark Green and White', 2),
    ('Forest', 'Dark Green and White', 6),
    ('Forest', 'Dark Green and White', 8),
    ('Forest', 'Dark Green and White', 14),
    ('Worker', 'Traditional workers colors with tan and black', 5);

INSERT INTO sizes VALUES
    (7.0, 1),
    (7.0, 2),
    (7.0, 3),
    (7.0, 6),
    (7.5, 1),
    (7.5, 6),
    (7.5, 8),
    (8.0, 9),
    (8.0, 11),
    (8.0, 2),
    (8.0, 3),
    (8.0, 7),
    (8.5, 7),
    (8.5, 8),
    (8.5, 9),
    (8.5, 3),
    (8.5, 12),
    (9.0, 12),
    (9.0, 13),
    (9.0, 14),
    (9.0, 7),
    (9.0, 8),
    (9.5, 1),
    (9.5, 2),
    (10.0, 1),
    (10.0, 2),
    (10.0, 3),
    (10.5, 4),
    (10.5, 5),
    (11.0, 5),
    (11.0, 9),
    (11.5, 2),
    (11.5, 10),
    (12.0, 10),
    (12.0, 12);