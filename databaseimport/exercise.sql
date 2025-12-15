-- exercise 1:
-- voor 1 user wil je weten welke taken aan hem zij toegewezen en daarvarn wil je het id de titel, 
-- descripten en status
SELECT tasks.taskid, tasks.title, tasks.description, tasks.status
FROM tasks
LEFT JOIN usertasks ON tasks.taskid = usertasks.taskid
WHERE usertasks.userid = 1;

-- exercise 2:
-- ik heb een takenlijst en ik wil zien welke users als bewerkers van alle tasks in deze lijst zijn 
-- toegewezen en ik wil alle bewerkers maak 1x zien met naam en mail
SELECT DISTINCT users.name, users.email
FROM `tasks` 
LEFT JOIN users ON tasks.creator = users.userid
WHERE tasks.tasklistid = 1;

--exercise 3:
--ik heb een user id en ik wil weten in welke takenlijsten hij werkt
SELECT users.userid, users.name, tasklist.title 
FROM `tasks`
LEFT JOIN `tasklist` ON tasks.tasklistid = tasklist.tasklistid
LEFT JOIN `users` ON tasks.creator = users.userid
WHERE users.userid = 1
GROUP BY tasklist.title;

-- exercise 4:
-- ik wil een lijst van alle users met een count hoeveel tasks ieder is toegewezen
SELECT users.userid, COUNT(*) AS taskcount
FROM `users`
INNER JOIN `tasks` ON users.userid = tasks.creator
GROUP BY users.userid;


