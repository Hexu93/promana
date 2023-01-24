INSERT INTO projects
VALUES
    (1, 'Learn SQL', 'School'),
    (2, 'Learn Javascript', 'School'),
    (3, 'Project X', 'Personal');

INSERT INTO task_comments
VALUES
    (1, 'testi', NOW() , 'Moi'),
    (2, 'testi2', NOW(), 'Pöö'),
    (3, ' Joo o', NOW(), 'Nääh');

INSERT INTO tasks
VALUES
    (1, 'Task 1', '2022-11-01', 25, 1, 1),
    (2, 'Task 2', '2022-11-15', 45, 2, 2),
    (3, 'Task 3', '2022-12-09', 25, 3, 3);