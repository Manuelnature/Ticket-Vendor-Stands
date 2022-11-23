CREATE TABLE tbl_users (
    id int not null PRIMARY KEY AUTO_INCREMENT,
    username varchar(100),
    password varchar(100),
    contact varchar(100),
    role varchar(100),
    organization_id int,
    vending_point_id int,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_UserOrg FOREIGN KEY (organization_id)
    REFERENCES tbl_organization(id),
    CONSTRAINT FK_UserVen FOREIGN KEY (vending_point_id)
    REFERENCES tbl_vending_point(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

ALTER TABLE `tbl_users` DROP FOREIGN KEY `FK_UserOrg`;
ALTER TABLE `tbl_users` ADD  CONSTRAINT `FK_UserOrg` FOREIGN KEY (`organization_id`) REFERENCES `tbl_organization`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE tbl_vending_point (
    id int not null PRIMARY KEY AUTO_INCREMENT,
    name varchar(100),
    location varchar(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tbl_organization(
    id int not null PRIMARY KEY AUTO_INCREMENT,
    name varchar(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tbl_events (
    id int not null PRIMARY KEY AUTO_INCREMENT,
    name varchar(100),
    tickets varchar(255),
    organization_id int,
    user_id int,
    event_date varchar(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_EventOrg FOREIGN KEY (organization_id)
    REFERENCES tbl_organization(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    CONSTRAINT FK_EventUser FOREIGN KEY (user_id)
    REFERENCES tbl_users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);


CREATE TABLE tbl_sales (
    id int not null PRIMARY KEY AUTO_INCREMENT,
    event_id int,
    tickets varchar(255),
    total_amount varchar(255),
    mobile_number varchar(50),
    email varchar(100),
    vending_point_id int,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_by varchar(100),
    CONSTRAINT FK_saleEvent FOREIGN KEY (event_id)
    REFERENCES tbl_events(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    CONSTRAINT FK_SalesVend FOREIGN KEY (vending_point_id)
    REFERENCES tbl_vending_point(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
