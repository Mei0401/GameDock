drop table appuser cascade;
drop table appstat cascade;

create table appuser (
	userid varchar(50) primary key,
	password varchar(50),
	email varchar(50)
);


create table appstat (
	id serial primary key,
	userid varchar(50) references appuser(userid) on update cascade on delete cascade,
	game varchar(50),
	starttime timestamp without time zone,
	endtime timestamp without time zone,
	result integer,
	ans varchar(50)
);


