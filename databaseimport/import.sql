DROP DATABASE IF EXISTS Todo;

CREATE DATABASE Todo;

use Todo;

CREATE TABLE `users` (
	userid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100)
);

INSERT INTO `users` (`name`, `email`) VALUES 
	('Shrek', 'shrek@gmail.com'),
    ('Fiona', 'fiona@gmail.com'),
    ('Donkey', 'donkey@gmail.com'),
    ('Farquaad', 'farquaad@gmail.com'),
    ('Puss in Boots', 'Boots@gmail.com');
    
CREATE TABLE `tasks` (
	taskid INT PRIMARY KEY AUTO_INCREMENT,
    tasklistid INT,
    title VARCHAR(100),
    description VARCHAR(500),
    status BOOLEAN,
    creator INT,
    employe INT NULL
);
    
INSERT INTO `tasks` (`tasklistid`, `title`, `description`, `status`, `creator`, `employe`) VALUES 
	(1, 'The Script', 'This tast if for writing the new script for the live action of sherk', 1, 1, 1),
    (2, 'Leave the castle', 'Leave the castle', 0, 2, 2),
    (1, 'get groceries', 'i need a lot of stuff from the grocery store', 1, 1, 1),
    (2, 'rule', 'rule the kingdom and find the princess', 1, 4, 4),
    (3, 'most wanted', 'stay out of reach of the police', 0, 5, 5),
    (1, 'swamp maintenece', 'Clean up your swamp for visitors', 0, 2, 1),
    (1, 'Donkey mission', 'Tell some one a story about something', 1, 3, 3),
    (2, 'Fionas transformation', 'Do something good for fiona', 0, 1, 1),
    (1, 'Challenge', 'For 15 minutes follow the rules you set for yourself', 0, 4, 1),
    (3, 'Dragon courage', 'Tackle a task you find scary', 1, 5, NULL);
    
CREATE TABLE `tasklist` (
	tasklistid INT PRIMARY KEY AUTO_INCREMENT,
    owner INT,
    title VARCHAR(100),
    FOREIGN KEY (owner) REFERENCES users(userid)
);

INSERT INTO `tasklist` (`owner`,`title`) VALUES
	(1, 'Tasklist 1'),
    (2, 'Tasklist 2'),
    (3, 'Tasklist 3');
    
CREATE TABLE usertasks (
	userid INT,
    taskid INT,
    FOREIGN KEY (userid) REFERENCES users(userid),
    FOREIGN KEY (taskid) REFERENCES tasks(taskid)
);

INSERT INTO `usertasks` (userid, taskid) VALUES 
	(1, 1),
    (1, 3),
    (1, 6),
    (1, 8),
    (1, 9),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5);
    
ALTER TABLE `tasks`
ADD FOREIGN KEY tasks(tasklistid) REFERENCES tasklist(tasklistid);

ALTER TABLE `tasks`
ADD FOREIGN KEY (creator) REFERENCES users(userid);

ALTER TABLE `tasks`
ADD FOREIGN KEY (employe) REFERENCES users(userid);