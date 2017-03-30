create table wp_domain_check_domains (
	domain_id bigint not null auto_increment,
	domain_url varchar(255) not null,
	user_id bigint default 0,
	status varchar(255),
	date_added bigint default 0,
	search_date bigint default 0,
	domain_watch int(11) default 0,
	domain_last_check bigint default 0,
	domain_next_check bigint default 0,
	domain_created bigint default 0,
	domain_expires bigint default 0,
	owner VARCHAR(255) DEFAULT NULL,
	domain_settings blob default null,
	cache blob default null,
	key(domain_id)
);

create table wp_domain_check_ssl (
ssl_domain_id bigint not null auto_increment,
domain_id bigint default 0,
domain_url varchar(255) not null,
user_id bigint default 0,
status varchar(255),
date_added bigint default 0,
search_date bigint default 0,
domain_watch int(11) default 0,
domain_last_check bigint default 0,
domain_next_check bigint default 0,
domain_created bigint default 0,
domain_expires bigint default 0,
owner VARCHAR(255) DEFAULT NULL,
domain_settings blob default null,
cache blob default null,
key(ssl_domain_id)
);