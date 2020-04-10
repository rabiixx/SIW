
INSERT INTO usuarios(Nombre, Apellido, Username, Email, Password) 
VALUES ('Ruben', 'Cherif', 'rabiixx', 'rabiixx@gmail.com', 'Rabiixx12');

INSERT INTO `restaurantes` 
(`nombre`, `ubicacion`, `Categoria`, `precio`, `puntuacion`, `imagen`, `idUsuario`) VALUES

('Doner Kebab', 'Barañain', 'Kebab', 5, 5, 'res29.jpg', 1);

('Aintzane', 'Pamplona - Mendebaldea', 'Hambirguesas, Bocatas', 10, 4, 'res1.png', 1),
('Common Good', 'Baranain', 'De todo ', 7, 4, 'res2.jpg', 1),
('Burguer King', 'Pamplona', 'Hamburgueseria', 5, 3, 'res3.jpg', 1),
('Garcia', 'Pamplona', 'Bocatas', 5, 5, 'res4.jpg', 1),
('k12', 'Pamplona', 'Kebab', 5, 4, 'res5.jpg', 1),
('Eat and Bucket', 'Arrosadia', 'Hamburgueseria', 8, 3, 'res6.jpg', 1),
('Trova', 'Baranain', 'Patatas Lokas', 6, 5, 'res7.jpg', 1),
('McDonalds', 'Pamplona', 'Hamburgueseria', 5, 3, 'res8.jpg', 1),
('Sibemol', 'Barañain', 'Española', 5, 4, 'res9.jpg', 1),
('Rodero', 'Pamplona', 'Española', 20, 4, 'res10.jpg', 1),
('La Tagliatella', 'Pamplona', 'Pizza', 16, 3, 'res11.jpg', 1),
('El Artesano', 'Pamplona', 'Pizza', 12, 4, 'res12.jpg', 1),
('La Tablita', 'Iturrama', 'Pizza', 15, 4, 'res13.jpg', 1),
('More Than Burguers', 'Zizur', 'Mexicana', 22, 5, 'res14.jpg', 1),
('Ovaja Negra', 'Mendebaldea', 'Mediterranea', 25, 2, 'res15.jpg', 1),
('Asador Olaverri', 'Pamplona', 'Sidreria', 30, 5, 'res16.jpg', 1),
('Bar Goroabe', 'Arrosadia', 'China', 10, 3, 'res17.jpg', 1),
('Mei Mei', 'San Juan', 'China', 8, 1, 'res18.jpg', 1),
('Imperial', 'Iturrama', 'China', 11, 3, 'res19.jpg', 1),
('Mattina', 'Buztintxuri', 'China', 16, 5, 'res20.jpg', 1),
('Bidezkairu', 'Lezkairu', 'Española', 25, 2, 'res21.jpg', 1),
('Katakrak', 'Pamplona', 'Cafe', 8, 5, 'res22.jpg', 1),
('El Churrero de Lerin', 'Pamplona', 'Cafe', 6, 5, 'res23.jpg', 1),
('Toskana', 'Burlada', 'Cafe', 3, 3, 'res24.jpg', 1),
('Horno Artesano', 'San Juan', 'Cafe', 5, 1, 'res25.jpg', 1),
('La Picachilla', 'San Juan', 'Cafe', 12, 4, 'res26.jpg', 1),
('La Piemontesa', 'Pamplona', 'Itialiana', 18, 2, 'res27.jpg', 1),
('La Mafia', 'Pamplona', 'Italiana', 17, 3, 'res28.jpg', 1),
('La Piedra', 'Iturrama', 'Italiana', 12, 4, 'res29.jpg', 1);





INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion1", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",3);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion2", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",1);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion3", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",3);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion4", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",2);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion5", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",5);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion6", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",5);
INSERT INTO opiniones(Titulo, Descripcion, Puntuacion) VALUES ("Opinion7", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, excepturi.",4);


INSERT INTO opinar(idUsuario, idRestaurante, idOpinion,Fecha) VALUES (1, 1, 1, "2020-04-01");
INSERT INTO opinar(idUsuario, idRestaurante, idOpinion, Fecha) VALUES (1, 1, 2, "2020-04-02");
INSERT INTO opinar(idUsuario, idRestaurante, idOpinion, Fecha) VALUES (1, 1, 3, "2020-04-03");
INSERT INTO opinar(idUsuario, idRestaurante, idOpinion, Fecha) VALUES (1, 1, 4, "2020-04-04");
INSERT INTO opinar(idUsuario, idRestaurante, idOpinion, Fecha) VALUES (1, 1, 5, "2020-04-05");

INSERT INTO imagenes(imgName, idOpinion) VALUES ("res1.png", 1);
INSERT INTO imagenes(imgName, idOpinion) VALUES ("res2.jpg", 1);
INSERT INTO imagenes(imgName, idOpinion) VALUES ("res3.jpg", 1);
INSERT INTO imagenes(imgName, idOpinion) VALUES ("res4.jpg", 2);
INSERT INTO imagenes(imgName, idOpinion) VALUES ("res5.jpg", 3);

/* OBTENER OPINIONES SOBRE UN RESTAURANTE */
SELECT o.Titulo, o.Descripcion, o.Puntuacion, op.idUsuario, op.idImg, op.Fecha, o.idOpinion, op.idRestaurante
FROM opiniones o, opinar op
WHERE (1 = op.idRestaurante) AND (op.idOpinion = o.idOpinion)



