use bookstore;
create table BookInventory (bookid int PRIMARY KEY AUTO_INCREMENT, bookname varchar(30), bookauthor varchar(20),bookquantity int, bookpublished int,bookprice int);
create table BookInventoryOrder(orderid int PRIMARY KEY AUTO_INCREMENT, orderBookid int,orderfirstname varchar(20),orderlastname varchar(20),orderpaymode varchar(10));