create database if not exists bus;
use bus;

#1. driver table
create table driver (
    driver_id int,
    d_first_name varchar(20) not null,
    d_middle_name varchar(20) not null,
    d_last_name varchar(20) not null,
    d_drno varchar(20) not null,
    d_location varchar(20) not null,
    d_city varchar(20) not null,
    d_state varchar(20) not null,
    d_gender varchar(20) not null,
    constraint driver_pk1 primary key(driver_id)
);

#2. drivercontact table
create table drivercontact (
    driver_id int not null,
    d_phoneno int not null,
    constraint drivercontact_fk1 foreign key(driver_id) references driver(driver_id)
);

#4. admin table
create table admin (
    admin_id int,
    a_first_name varchar(20) not null,
    a_middle_name varchar(20) not null,
    a_last_name varchar(20) not null,
    a_drno varchar(20) not null,
    a_location varchar(20) not null,
    a_city varchar(20) not null,
    a_state varchar(20) not null,
    a_gender varchar(20) not null,
    a_designation varchar(20) not null,
    constraint admin_pk1 primary key(admin_id)
);

#5. billing table
create table billing (
    billing_id int,
    admin_id int not null,
    billing_type varchar(20) not null,
    billing_date date not null,
    billing_description varchar(20) not null,
    constraint billing_pk1 primary key(billing_id),
    constraint billing_fk1 foreign key(admin_id) references admin(admin_id)
);

#6. admincontact table
create table admincontact (
    admin_id int not null,
    a_contact int not null,
    constraint admincontact_fk1 foreign key(admin_id) references admin(admin_id)
);

#3. bus table
create table bus (
    bus_id int,
    admin_id int not null,
    driver_id int not null,
    b_route varchar(20) not null,
    b_arrival_time time not null,
    b_departure_time time not null,
    constraint bus_pk1 primary key(bus_id)
);

#7. schedule table
create table schedule (
    schedule_id int,
    admin_id int not null,
    student_id int not null,
    s_start_date date not null,
    s_end_date date not null,
    constraint schedule_pk1 primary key(schedule_id),
    constraint schedule_fk1 foreign key(admin_id) references admin(admin_id)
);

#8. student table
create table student (
    student_id int,
    s_first_name varchar(20) not null,
    s_middle_name varchar(20) not null,
    s_last_name varchar(20) not null,
    s_drno varchar(20) not null,
    s_location varchar(20) not null,
    s_city varchar(20) not null,
    s_state varchar(20) not null,
    s_gender varchar(20) not null,
    s_status varchar(20) not null,
    constraint student_pk1 primary key(student_id)
);

#9. student_email table
create table student_email (
    student_id int not null,
    email_id varchar(20) not null,
    constraint student_email_fk1 foreign key(student_id) references student(student_id)
);

#10. student_contact table
create table student_contact (
    student_id int not null,
    contact int not null,
    constraint student_contact_fk1 foreign key(student_id) references student(student_id)
);

#11. payment table
create table payment (
    payment_id int not null,
    student_id int not null,
    p_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    p_type varchar(20) not null,
    amount int not null,
    p_description varchar(20),
    constraint payment_pk1 primary key(payment_id),
    constraint payment_fk1 foreign key(student_id) references student(student_id)
);
-- INSERT statements

#1. driver table
INSERT INTO driver VALUES
(1,"naveed","ahmed","s","14-11","pedakakani","guntur","andhra pradesh","male"),
(2,"tarun","teja","p","15-12","mangalagiri","guntur","andhra pradesh","male"),
(3,"nikil","kumar","b","16-13","rao nagar","vijayawada","andhra pradesh","male"),
(4,"praveen","reddy","k","17-14","hanuman junction","vijayawada","andhra pradesh","male");

#2. driver_contact table
INSERT INTO drivercontact VALUES
(1,977911717),
(2,802662760),
(3,967045073),
(4,941805530);

#3. bus table
INSERT INTO bus VALUES
(6,58,1,"guntur","08:35","17:50"),
(7,59,2,"guntur","08:40","18:00"),
(8,60,3,"guntur","09:00","17:45"),
(9,61,4,"vijayawada","08:55","17:30");

#4. admin table
INSERT INTO admin VALUES
(58,"Thanmai","chowdary","b","21-11","brindhavan gardens","guntur","andhra pradesh","female","btech"),
(59,"darvini"," ","k","24-79","kothapeta","guntur","andhra pradesh","female","btech"),
(60,"Ratna","kumari","K","32-36","benz circle","vijayawada","andhra pradesh","female","phd"),
(61,"Mary","swaroopa","j","41-59","JKC college","guntur","andhra pradesh","female","phd");

#5. billing table
INSERT INTO billing VALUES
(40012,58,"upi","2022-11-10","paid"),
(40013,59,"neft","2022-11-03","50% paid"),
(40014,60,"cash","2022-11-16","75% paid"),
(40015,61,"upi","2022-11-19","paid");

#6. admin_contact table
INSERT INTO admincontact VALUES
(58,849880000),
(59,984868488),
(60,703424567),
(61,628130037);

#7. schedule table 
INSERT INTO schedule VALUES
(703,58,358,"2022-10-06","2022-12-14"),
(704,59,359,"2022-08-15","2022-12-14"),
(705,60,360,"2022-08-02","2022-12-26"),
(706,61,361,"2022-08-02","2022-12-14");

#8. student table
INSERT INTO student VALUES
(358,"shanvitha"," ","G","11-12","Current Office","guntur","andhra pradesh","female","registered"),
(359,"dhanushya","sri","T","11-13","Starbucks","guntur","andhra pradesh","female","not registered"),
(360,"hansika","bose","K","11-14","RTO office","guntur","andhra pradesh","female","registered"),
(361,"kyathi"," ","L","11-15","Autonagar","vijayawada","andhra pradesh","female","not registered");

#9. student_email table
INSERT INTO student_email VALUES
(358,"shanuu_srmap.edu.in"),
(359,"dhanu_srmap.edu.in"),
(360,"hansika_srmap.edu.in"),
(361,"kyathi_srmap.edu.in");

#10. student_contact table
INSERT INTO student_contact VALUES
(358,907306512),
(359,918462496),
(360,845623999),
(361,893456780);

#11. payment_table
INSERT INTO payment VALUES
(7123,358,"2022-11-05","upi",60000,"100% paid"),
(7124,359,"2022-11-01","neft",50000,"50% paid"),
(7125,360,"2022-11-10","cash",65000,"40% paid"),
(7126,361,"2022-11-15","upi",70000,"75% paid");
