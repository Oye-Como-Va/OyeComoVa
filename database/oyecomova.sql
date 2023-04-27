INSERT INTO users (name, surname, profile_image, email, phone, `admin`, completed_tasks, pending_tasks, respected_tasks, unrespected_tasks, email_verified_at, `password`) 
VALUES 
('Juan', 'Pérez', NULL, 'juan@example.com', '555-1234', 0, '15', '5', '10', '3', NULL, 'hashed_password'),
('María', 'Rodríguez', NULL, 'maria@example.com', '555-5678', 0, '20', '8', '15', '6', NULL, 'hashed_password'),
('Pedro', 'González', NULL, 'pedro@example.com', '555-9876', 1, '30', '3', '25', '1', NULL, 'hashed_password'),
('Laura', 'Fernández', NULL, 'laura@example.com', '555-6543', 0, '10', '2', '8', '0', NULL, 'hashed_password'),
('Carlos', 'Martínez', NULL, 'carlos@example.com', '555-7890', 0, '5', '0', '3', '1', NULL, 'hashed_password'),
('Ana', 'López', NULL, 'ana@example.com', '555-4321', 1, '50', '10', '45', '2', NULL, 'hashed_password'),
('Jorge', 'Ramírez', NULL, 'jorge@example.com', '555-5678', 0, '25', '5', '20', '1', NULL, 'hashed_password');


INSERT INTO courses (name, description, isdefault) VALUES
('Curso 1', 'Descripción del curso 1', 1),
('Curso 2', 'Descripción del curso 2',0),
('Curso 3', 'Descripción del curso 3',0),
('Curso 4', 'Descripción del curso 4',0),
('Curso 5', 'Descripción del curso 5', 1),
('Curso 6', 'Descripción del curso 6',1),
('Curso 7', 'Descripción del curso 7',1);


INSERT INTO subjects (name, color, description, qualification, course_id) VALUES
('Materia 1', 'Rojo', 'Descripción de la materia 1', 9.5, 1),
('Materia 2', 'Azul', 'Descripción de la materia 2', 8.0, 1),
('Materia 3', 'Verde', 'Descripción de la materia 3', 7.5, 2),
('Materia 4', 'Amarillo', 'Descripción de la materia 4', 6.0, 2),
('Materia 5', 'Naranja', 'Descripción de la materia 5', 8.5, 3),
('Materia 6', 'Rosa', 'Descripción de la materia 6', 7.0, 3),
('Materia 7', 'Morado', 'Descripción de la materia 7', 9.0, 4),
('Materia 6', 'Morado', 'Descripción de la materia 7', 9.0, 6);


INSERT INTO tasks (name, description, subject_id) VALUES
('Tarea 1', 'Descripción de la tarea 1', 1),
('Tarea 2', 'Descripción de la tarea 2', 1),
('Tarea 3', 'Descripción de la tarea 3', 2),
('Tarea 4', 'Descripción de la tarea 4', 2),
('Tarea 5', 'Descripción de la tarea 5', 3),
('Tarea 6', 'Descripción de la tarea 6', 3),
('Tarea 7', 'Descripción de la tarea 7', 4);


INSERT INTO calendars (user_id) VALUES
(1),
(2),
(3),
(1),
(4),
(2),
(3);


INSERT INTO task_user (date, start_time, end_time, task_id, user_id) VALUES
('2023-05-01', '10:00:00', '11:30:00', 1, 1),
('2023-05-01', '11:30:00', '12:30:00', 2, 1),
('2023-05-02', '14:00:00', '16:00:00', 3, 2),
('2023-05-02', '16:30:00', '18:00:00', 4, 2),
('2023-05-03', '09:00:00', '10:30:00', 5, 3),
('2023-05-04', '13:00:00', '14:30:00', 6, 4),
('2023-05-04', '14:30:00', '16:00:00', 7, 4);


INSERT INTO working_areas (date, date_real, start_time, start_time_real, end_time, end_time_real, user_id, task_id) VALUES 
('2023-04-25', '2023-04-25', '08:00:00', '08:10:00', '14:00:00', '14:10:00', 1, 1),
('2023-04-25', '2023-04-25', '09:00:00', '09:15:00', '13:00:00', '13:15:00', 2, 2),
('2023-04-26', '2023-04-26', '10:00:00', '10:30:00', '17:00:00', '17:30:00', 3, 1),
('2023-04-26', '2023-04-26', '11:00:00', '11:20:00', '16:00:00', '16:20:00', 4, 3),
('2023-04-27', '2023-04-27', '07:00:00', '07:10:00', '12:00:00', '12:10:00', 5, 2),
('2023-04-27', '2023-04-27', '08:00:00', '08:30:00', '13:00:00', '13:30:00', 6, 4),
('2023-04-28', '2023-04-28', '09:00:00', '09:25:00', '15:00:00', '15:25:00', 7, 3);


INSERT INTO notes (note, color, date, time, working_area_id) VALUES
('Nota 1', 'amarillo', '2023-04-27', '08:30:00', 1),
('Nota 2', 'azul', '2023-04-27', '10:15:00', 2),
('Nota 3', 'verde', '2023-04-28', '14:00:00', 3),
('Nota 4', 'rosado', '2023-04-28', '16:45:00', 2),
('Nota 5', 'naranja', '2023-04-29', '11:30:00', 1),
('Nota 6', 'rojo', '2023-04-30', '09:00:00', 3),
('Nota 7', 'morado', '2023-04-30', '15:20:00', 2);

INSERT INTO `analytics` (`date`, `date_real`, `start_time`, `start_time_real`, `end_time`, `end_time_real`, `working_area_id`)
VALUES
    ('2022-01-01', '2022-01-01', '08:00:00', '08:02:34', '12:00:00', '11:59:45', 1),
    ('2022-01-01', '2022-01-01', '08:00:00', '08:05:21', '12:00:00', '11:58:59', 1),
    ('2022-01-02', '2022-01-02', '07:30:00', '07:35:12', '11:30:00', '11:25:46', 2),
    ('2022-01-02', '2022-01-02', '07:30:00', '07:28:59', '11:30:00', '11:29:12', 2),
    ('2022-01-03', '2022-01-03', '09:00:00', '09:01:33', '13:00:00', '13:01:56', 3),
    ('2022-01-03', '2022-01-03', '09:00:00', '08:58:43', '13:00:00', '13:02:00', 3),
    ('2022-01-04', '2022-01-04', '10:00:00', '09:58:22', '14:00:00', '13:58:33', 4);

INSERT INTO achievements (name, date, image, description, analytic_id) VALUES 
('Achievement 1', '2022-01-01', 'image1.jpg', 'Description for achievement 1', 1),
('Achievement 2', '2022-01-02', 'image2.jpg', 'Description for achievement 2', 2),
('Achievement 3', '2022-01-03', 'image3.jpg', 'Description for achievement 3', 3),
('Achievement 4', '2022-01-04', 'image4.jpg', 'Description for achievement 4', 4),
('Achievement 5', '2022-01-05', 'image5.jpg', 'Description for achievement 5', 5),
('Achievement 6', '2022-01-06', 'image6.jpg', 'Description for achievement 6', 6),
('Achievement 7', '2022-01-07', 'image7.jpg', 'Description for achievement 7', 7);


INSERT INTO user_achievement (user_id, achievement_id) VALUES
(1, 2),
(2, 4),
(3, 1),
(4, 3),
(2, 5),
(1, 6),
(3, 4);

INSERT INTO course_user (user_id, course_id) VALUES
(1, 4),
(1, 6),
(2, 3),
(3, 2),
(4, 1),
(5, 4),
(6, 3),
(7, 2);

