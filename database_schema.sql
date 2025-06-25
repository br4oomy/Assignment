CREATE DATABASE IF NOT EXISTS project_management_db;
USE project_management_db;

CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    task_description TEXT NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'To Do',
    due_date DATE NOT NULL,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);

INSERT INTO projects (project_name, start_date, end_date) VALUES
('Website Redesign', '2025-01-15', '2025-03-31'),
('Mobile App Development', '2025-04-01', '2025-07-31'),
('Marketing Campaign', '2025-02-01', '2025-04-30');

INSERT INTO tasks (project_id, task_description, status, due_date) VALUES
(1, 'Design mockups', 'Done', '2025-01-30'),
(1, 'Develop frontend', 'In Progress', '2025-03-15'),
(1, 'Develop backend API', 'To Do', '2025-03-25'),
(2, 'Plan features', 'Done', '2025-04-15'),
(2, 'Develop iOS app', 'In Progress', '2025-06-30'),
(2, 'Develop Android app', 'To Do', '2025-07-15'),
(3, 'Create ad copy', 'Done', '2025-02-15'),
(3, 'Launch social media ads', 'In Progress', '2025-03-01');


