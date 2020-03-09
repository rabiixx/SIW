/* BASE DE DATOS PAGINA WEB */


/*CREATE DATABASE proyecto;*/

CREATE TABLE Usuarios (
    idUsuario int AUTO_INCREMENT NOT NULL,
    Nombre varchar(255) NOT NULL,
    Apellido varchar(255) NOT NULL,
    Username varchar(255) NOT NULL,
    Email varchar(255) NOT NULL,
    Password varchar(255) NOT NULL,
    PRIMARY KEY (idUsuario)
);

CREATE TABLE Restaurantes (
	idRestaurante int AUTO_INCREMENT NOT NULL,
	Nombre varchar(255) NOT NULL,
	Ubicacion varchar(255) NOT NULL,
	Categoria varchar(255) NOT NULL,
	Precio int NOT NULL,
	Puntuacion int NOT NULL,
	Imagen varchar(255) NOT NULL, 
	Mapa text NOT NULL,							/* HTML Google Maps */
	idUsuario int NOT NULL,
	Aforo int NOT NULL,
	PRIMARY KEY (idRestaurante),
	FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario) ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE Opiniones (
	idOpinion int AUTO_INCREMENT NOT NULL,
	Titulo varchar(255),
	Descripcion text,
	Puntuacion int,
	PRIMARY KEY (idOpinion),
	CHECK (Puntuacion BETWEEN 0 AND 5)
);



CREATE TABLE Opinar(
	idUsuario int NOT NULL,
	idRestaurante int NOT NULL,
	idOpinion int NOT NULL,
	Fecha DATE NOT NULL,
	PRIMARY KEY (idUsuario, idRestaurante, idOpinion),
	FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idRestaurante) REFERENCES Restaurantes(idRestaurante) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idOpinion) REFERENCES Opiniones(idOpinion) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE Imagenes (
	idImg int AUTO_INCREMENT NOT NULL,
	imgName varchar(255) NOT NULL,
	idOpinion int NOT NULL,
	PRIMARY KEY (idImg),
	FOREIGN KEY (idOpinion) REFERENCES Opinar(idOpinion) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE Anade (
	idImg int NOT NULL,
	idRestaurante int NOT NULL,
	idUsuario int NOT NULL,
	Fecha DATE NOT NULL,
	PRIMARY KEY (idImg),
	FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idRestaurante) REFERENCES Restaurantes(idRestaurante) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idImg) REFERENCES Imagenes(idImg) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE Reserva (
	idReserva int AUTO_INCREMENT NOT NULL,
	Fecha DATETIME NOT NULL,				/* Fecha en la que se realizo la reserva */
	Turno varchar(255),						/* Desayuno, Comida, Cena */
	idRestaurante int NOT NULL,
	idUsuario int NOT NULL,					
	FechaReserva DATETIME,					/* YYYY-MM-DD hh:mm:ss */
	PRIMARY KEY (idReserva, idUsuario, idRestaurante),
	CHECK (Turno IN ('Comida', 'Cena')),
	FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idRestaurante) REFERENCES Restaurantes(idRestaurante) ON DELETE CASCADE ON UPDATE CASCADE
);
