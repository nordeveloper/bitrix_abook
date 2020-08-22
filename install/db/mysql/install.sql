CREATE TABLE b_kreativ_abook
(
	ID int not null auto_increment,
	ACTIVE char(1) not null DEFAULT 'Y',
	SORT int(11) not null DEFAULT 500,
	FIO varchar(255) not null,
	EMAIL varchar(255) not null,
	PHONE varchar(255) not null,
	SKYPE varchar(255) not null,
	COMPANY varchar(255) not null,
	POSITION varchar(255) not null,    
	SPECIALIZATION varchar(255) not null,
	COUNTRY varchar(255) not null,
	CITY varchar(255) not null,
	ADDRESS varchar(255) not null,
	primary key (ID)
);