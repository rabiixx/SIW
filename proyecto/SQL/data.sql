
INSERT INTO usuarios(Nombre, Apellido, Username, Email, Password) 
VALUES ('Ruben', 'Cherif', 'rabiixx', 'rabiixx@gmail.com', 'Rabiixx12');

INSERT INTO `restaurantes` 
(`idRestaurante`, `nombre`, `ubicacion`, `Categoria`, `precio`, `puntuacion`, `imagen`, `idUsuario`) VALUES
(1, 'Aintzane', 'Pamplona - Mendebaldea', 'Hambirguesas, Bocatas', 10, 4, 'res1.png', 1),
(2, 'Common Good', 'Baranain', 'De todo ', 7, 4, 'res2.jpg', 1),
(3, 'Burguer King', 'Pamplona', 'Hamburgueseria', 5, 3, 'res3.jpg', 1),
(4, 'Garcia', 'Pamplona', 'Bocatas', 5, 5, 'res4.jpg', 1),
(5, 'k12', 'Pamplona', 'Kebab', 5, 4, 'res5.jpg', 1),
(6, 'Eat and Bucket', 'Arrosadia', 'Hamburgueseria', 8, 3, 'res6.jpg', 1),
(7, 'Trova', 'Baranain', 'Patatas Lokas', 6, 5, 'res7.jpg', 1),
(8, 'McDonalds', 'Pamplona', 'Hamburgueseria', 5, 3, 'res8.jpg', 1);


INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion1", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",3);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion2", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",1);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion3", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",3);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion4", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",2);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion5", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",5);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion6", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",5);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion7", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",4);

INSERT INTO imagenes(imgName) VALUES ("res1.png");
INSERT INTO imagenes(imgName) VALUES ("res2.jpg");
INSERT INTO imagenes(imgName) VALUES ("res3.jpg");
INSERT INTO imagenes(imgName) VALUES ("res4.jpg");
INSERT INTO imagenes(imgName) VALUES ("res5.jpg");


INSERT INTO opinar(idUsuario, idRestaurante, idOpinion, idImg, Fecha) VALUES (1, 1, 1, 1, "2020-04-01");
INSERT INTO opinar(idUsuario, idRestaurante, idOpinion, idImg, Fecha) VALUES (1, 1, 1, 2, "2020-04-02");
INSERT INTO opinar(idUsuario, idRestaurante, idOpinion, idImg, Fecha) VALUES (1, 1, 1, 3, "2020-04-03");
INSERT INTO opinar(idUsuario, idRestaurante, idOpinion, idImg, Fecha) VALUES (1, 1, 2, 4, "2020-04-04");
INSERT INTO opinar(idUsuario, idRestaurante, idOpinion, idImg, Fecha) VALUES (1, 1, 3, 5, "2020-04-05");
INSERT INTO opinar(idUsuario, idRestaurante, idOpinion, idImg, Fecha) VALUES (1, 1, 4, "NULL", "2019-04-06");
INSERT INTO opinar(idUsuario, idRestaurante, idOpinion, idImg, Fecha) VALUES (1, 1, 5, "NULL", "2020-04-07");


/* OBTENER OPINIONES SOBRE UN RESTAURANTE */
SELECT o.Titulo, o.Descripcion, o.Puntuacion, op.idUsuario, op.idImg, op.Fecha, o.idOpinion, op.idRestaurante
FROM opiniones o, opinar op
WHERE (1 = op.idRestaurante) AND (op.idOpinion = o.idOpinion)



