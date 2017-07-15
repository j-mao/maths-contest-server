CREATE DATABASE contest;
USE contest;

CREATE TABLE accounts (
	user_id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(32) NOT NULL,
	password VARBINARY(32) NOT NULL,
	nickname VARCHAR(32) NOT NULL,
	official TINYINT NOT NULL DEFAULT 1,
	PRIMARY KEY (user_id)
);

CREATE TABLE problems (
	problem_id INT NOT NULL AUTO_INCREMENT,
	directory VARCHAR(32) NOT NULL,
	PRIMARY KEY (problem_id)
);

CREATE TABLE tasks (
	task_id INT NOT NULL AUTO_INCREMENT,
	problem_id INT NOT NULL,
	value INT NOT NULL,
	decrement INT NOT NULL,
	minscore INT NOT NULL,
	PRIMARY KEY (task_id),
	FOREIGN KEY (problem_id) REFERENCES problems(problem_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE opens (
	open_id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	task_id INT NOT NULL,
	open_time DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (open_id),
	FOREIGN KEY (user_id) REFERENCES accounts(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (task_id) REFERENCES tasks(task_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE submissions (
	submission_id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	task_id INT NOT NULL,
	submit_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	answer VARCHAR(32),
	verdict TINYINT NOT NULL,
	PRIMARY KEY (submission_id),
	FOREIGN KEY (user_id) REFERENCES accounts(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (task_id) REFERENCES tasks(task_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE announcements (
	announcement_id INT NOT NULL AUTO_INCREMENT,
	send_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	subject VARCHAR(32),
	body VARCHAR(255),
	PRIMARY KEY (announcement_id)
);

CREATE TABLE questions (
	question_id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	receive_time DATETIME DEFAULT CURRENT_TIMESTAMP,
	q_subject VARCHAR(32),
	q_body VARCHAR(255),
	answer_time DATETIME DEFAULT NULL,
	a_subject VARCHAR(32),
	a_body VARCHAR(255),
	PRIMARY KEY (question_id),
	FOREIGN KEY (user_id) REFERENCES accounts(user_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE messages (
	message_id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	send_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	subject VARCHAR(32),
	body VARCHAR(255),
	PRIMARY KEY (message_id),
	FOREIGN KEY (user_id) REFERENCES accounts(user_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE contest (
	variable VARCHAR(32) NOT NULL UNIQUE,
	data_datetime DATETIME,
	data_varchar VARCHAR(32),
	data_varbinary VARBINARY(32)
);

INSERT INTO contest (variable, data_varchar) VALUES ("contest_name", "An unnamed contest");
INSERT INTO contest (variable, data_datetime) VALUES ("start_time", CURRENT_TIMESTAMP);
INSERT INTO contest (variable, data_datetime) VALUES ("end_time", CURRENT_TIMESTAMP);
INSERT INTO contest (variable, data_varchar) VALUES ("admin_username", "admin");
INSERT INTO contest (variable, data_varbinary) VALUES ("admin_password", "password");
