INSERT INTO courses (name, description, isdefault) VALUES
('Curso 1', 'Descripción del curso 1', 1),
('Curso 2', 'Descripción del curso 2',0),
('Curso 3', 'Descripción del curso 3',0),
('Curso 4', 'Descripción del curso 4',0),
('Curso 5', 'Descripción del curso 5',1),
('Curso 6', 'Descripción del curso 6',0),
('Curso 7', 'Descripción del curso 7',0);


INSERT INTO subjects (name, color, description, qualification, course_id) VALUES
('Materia 1', 'red', 'Descripción de la materia 1', 9.5, 1),
('Materia 2', 'blue', 'Descripción de la materia 2', 8.0, 1),
('Materia 3', 'green', 'Descripción de la materia 3', 7.5, 2),
('Materia 4', 'yellow', 'Descripción de la materia 4', 6.0, 2),
('Materia 5', 'orange', 'Descripción de la materia 5', 8.5, 3),
('Materia 6', 'pink', 'Descripción de la materia 6', 7.0, 3),
('Materia 7', 'purple', 'Descripción de la materia 7', 9.0, 4),
('Materia 6', 'purple', 'Descripción de la materia 7', 9.0, 6);


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

INSERT INTO notes (note, color, date, time, working_area_id) VALUES
('Nota 1', 'amarillo', '2023-04-27', '08:30:00', 1),
('Nota 2', 'azul', '2023-04-27', '10:15:00', 2),
('Nota 3', 'verde', '2023-04-28', '14:00:00', 3),
('Nota 4', 'rosado', '2023-04-28', '16:45:00', 2),
('Nota 5', 'naranja', '2023-04-29', '11:30:00', 1),
('Nota 6', 'rojo', '2023-04-30', '09:00:00', 3),
('Nota 7', 'morado', '2023-04-30', '15:20:00', 2);

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

