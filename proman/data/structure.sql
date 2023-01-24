DROP TABLE IF EXISTS tasks, projects, task_comments;

CREATE TABLE projects 
(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL UNIQUE,
    category VARCHAR(100) NOT NULL
);

CREATE TABLE task_comments
(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL UNIQUE,
    comment_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    comments LONGTEXT NOT NULL
);

CREATE TABLE tasks
(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL UNIQUE,
    date_task DATE NOT NULL,
    time_task INT(3) NOT NULL,
    project_id INT(11) NOT NULL,
    comment_id INT(11),
    CONSTRAINT fk_tas_pro
        FOREIGN KEY (project_id)
        REFERENCES projects(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_tas_com
        FOREIGN KEY (comment_id)
        REFERENCES task_comments(id)
        ON DELETE CASCADE
        
)