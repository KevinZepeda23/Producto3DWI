/********* CREACION DE BASE*******/
drop database automarket;

create database automarket;

use automarket;          

/********* CREACION DE TABLAS*******/
CREATE TABLE Usuario(
    RFC VARCHAR(13) NOT NULL PRIMARY KEY,
    Foto VARCHAR(900),
    Nombre VARCHAR(35) NOT NULL,
    Apellidos VARCHAR(70),
    Email VARCHAR(50) NOT NULL,
    Password VARCHAR(15) NOT NULL,
    Tel VARCHAR(10),
    Id_Direccion INT,
    Id_status INT
);
CREATE TABLE Direccion(
    Id_Direccion INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Pais VARCHAR(70) NOT NULL,
    Estado VARCHAR(70) NOT NULL,
    Ciudad VARCHAR(70) NOT NULL,
    Calle VARCHAR(70) NOT NULL,
    C_P INT NOT NULL,
    N_I INT,
    N_E INT NOT NULL
);
CREATE TABLE Estado(
    Id_status INT PRIMARY KEY AUTO_INCREMENT,
    Status CHAR(20)
);
CREATE TABLE R_U_V(
    RFC VARCHAR(13) NOT NULL,
    Id_Vehiculo INT NOT NULL
);
CREATE TABLE Vehiculo(
    Id_Vehiculo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Id_Marca INT NOT NULL, 
    Id_Modelo INT NOT NULL
);

CREATE TABLE Marca(
    Id_Marca INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Marca VARCHAR(35) NOT NULL
);

CREATE TABLE Modelo(
    Id_Modelo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Id_Marca INT NOT NULL,
    Modelo VARCHAR(35) NOT NULL,
    Años VARCHAR(10) NOT NULL,
    CIL INT NOT NULL,
    TLS FLOAT NOT NULL,
    Motor VARCHAR(50)
);

CREATE TABLE Categoria(
    Id_Cat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Nom_Cat VARCHAR(70) NOT NULL,
    Id_status INT
);

CREATE TABLE Productos(
    Id_Producto INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Id_Vehiculo INT,
    Id_Cat INT NOT NULL,
    Nombre VARCHAR(500) NOT NULL,
    Descripcion VARCHAR(1000) NOT NULL,
    URL_Foto VARCHAR(900) NOT NULL,
    Unidades INT NOT NULL,
    Precio FLOAT NOT NULL,
    Id_status INT
);

CREATE TABLE Reacciones(
    Id_Producto INT NOT NULL,
    Likes INT,
    Comentarios VARCHAR(100)
);

CREATE TABLE Carrito(
    Id_Car INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Total FLOAT NOT NULL
);

CREATE TABLE Facturacion(
    Folio INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Id_car INT NOT NULL,
    RFC VARCHAR(13) NOT NULL,
    Id_Producto INT NOT NULL,
    Cantidad INT NOT NULL,
    Precio FLOAT NOT NULL,
    Fecha DATETIME NOT NULL
);

/********* RELACIONES DE TABLAS*******/

alter table Usuario add foreign key (Id_status) references Estado (Id_status);
alter table Usuario add foreign key (Id_Direccion) references Direccion (Id_Direccion);
alter table Productos add foreign key (Id_status) references Estado (Id_status);
alter table Productos add foreign key (Id_Cat) references Categoria (Id_Cat);
alter table Productos add foreign key (Id_Vehiculo) references Vehiculo (Id_Vehiculo);
alter table Categoria add foreign key (Id_status) references Estado (Id_status);
alter table R_U_V add foreign key (RFC) references Usuario (RFC);
alter table R_U_V add foreign key (Id_Vehiculo) references Vehiculo (Id_Vehiculo);
alter table Vehiculo add foreign key (Id_Marca) references Marca (Id_Marca);
alter table Vehiculo add foreign key (Id_Modelo) references Modelo (Id_Modelo);
alter table Modelo add foreign key (Id_Marca) references Marca (Id_Marca);
alter table Reacciones add foreign key (Id_Producto) references Productos (Id_Producto);
alter table Facturacion add foreign key (Id_Car) references Carrito (Id_Car);
alter table Facturacion add foreign key (Id_Producto) references Productos (Id_Producto);
alter table Facturacion add foreign key (RFC) references Usuario (RFC);


/********* CREACION DE DATOS EN TABLAS*******/

insert into Estado(Status) Values('Administrador');
insert into Estado(Status) Values('Registrado');
insert into Estado(Status) Values('Bloqueado');
insert into Estado(Status) Values('Activo');
insert into Estado(Status) Values('Inactivo');



insert into Categoria(Nom_Cat) values('Bujias');
insert into Categoria(Nom_Cat) values('Aceites');
insert into Categoria(Nom_Cat) values('Baterias');
insert into Categoria(Nom_Cat) values('Amortiguadores');
insert into Categoria(Nom_Cat) values('Filtros');
insert into Categoria(Nom_Cat) values('Partes Externas Del Motor');
insert into Categoria(Nom_Cat) values('Balatas');
insert into Categoria(Nom_Cat) values('Suspenciones');








insert into Marca(Marca) values ('AUDI');
insert into Marca(Marca) values ('ACURA');
insert into Marca(Marca) values ('BMW');
insert into Marca(Marca) values ('CHEVROLET');
insert into Marca(Marca) values ('CHRYSLER');
insert into Marca(Marca) values ('FIAT');
insert into Marca(Marca) values ('FORD');
insert into Marca(Marca) values ('GMC');
insert into Marca(Marca) values ('HYUNDAI');
insert into Marca(Marca) values ('NISSAN');


###################################################################################
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A1', '2011-2015', '4', '1.4', 'CAVG,GHTG');
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A1', '2016-2018', '4', '1.4', 'CZCA');
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A1', '2016-2018', '4', '1.8', '---');
###################################################################################
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A3', '2014-2019', '4', '1.4', 'CZEA');
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A3', '2008-2013', '4', '1.4', 'CAXC');
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A3', '2002-2004', '4', '1.8', 'AUQ');
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A3', '2005-2013', '4', '2.0', 'AXX,CCZA');
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A3', '2004-2008', '6', '3.2', 'BMJ,BUB');
####################################################################################
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A4', '2009-2016', '4', '1.8', 'CDHB,CJEB');
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A4', '2002-2008', '4', '1.8', 'BEX,BFB');
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A4', '2013-2018', '4', '2.0', 'CNCD');
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A4', '1998-2001', '6', '2.8', 'AMX,APR,AQD');
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A4', '2005-2007', '6', '3.2', 'AUK');
INSERT INTO Modelo(Id_Marca,Modelo,Años,CIL,TLS,Motor) VALUES ('1', 'A4', '2004-2008', '8', '4.2', 'BBK');
####################################################################################










INSERT INTO Usuario(RFC,Nombre,Apellidos,Email,Password,Tel,Id_Direccion,Id_status) VALUES ('MFZA1321E1245', 'Francisco ', 'Merino Zavaleta', 'utp0139968@alumno.utpuebla.edu.mx', 'platanito12', '2224727586', NULL, '2');
INSERT INTO Direccion(Pais,Estado,Ciudad,Calle,C_P,N_I,N_E) VALUES ('Mexico', 'Puebla', 'Puebla', 'Priv.Hidalgo', '72498', NULL, '7');
UPDATE Usuario SET Id_Direccion = '1' WHERE Usuario.RFC = 'MFZA1321E1245';



INSERT INTO Vehiculo(Id_Marca,Id_Modelo) VALUES('1', '1'),('1', '2');

INSERT INTO R_U_V(RFC,Id_Vehiculo) VALUES ('MFZA1321E1245', '1');

INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '4', 'Amortiguador', 'Amortiguador delantero SYD', 'amortiguador.jpg','6', '899.50', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '4', 'Amortiguador GAS', 'Amortiguador delantero SYD', 'amortiguador_Gas.jpg','2', '1200.50', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '8', 'Buje delantero', 'Buje delantero SYD', 'bujes_del.jpg','8', '120.50', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '8', 'Bujes estabilizador', 'bujes o Gomas estabilizadorasdelantero SYD', 'Gomas_estabilizacion.jpg','9', '50.50', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '1', 'Bujias Platino', 'El Iridio es un metal noble que posee alta resistencia al desgaste, posibilitando la reducción del diámetro del electrodo y mejorando su encendido y durabilidad. Poseen un diámetro de electrodo central de 0,4 y 0,6mm.', 'bujiasplatino.jpeg','12', '299', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '1', 'Bujias Iridium', 'Las bujías NGK G-Power de platino son una opción de mejora económica de las bujías tradicionales. El electrodo central de alambre fino de platino provee excelente rendimiento y eficiencia en el consumo de combustible.', 'bujiasiridium.jpeg','15', '850', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '5', 'Filtro De Aceite Audi', 'KWX proporciona una amplia gama de aplicaciones en filtros para aceite, tanto para vehículos modernos como de años anteriores. Estos son ideales para lubricantes de alto rendimiento (sintéticos), y de base mineral. Cambie el filtro al menos cada 5000 kilómetros o cada 6 meses.', 'filtroaceite.jpeg','55', '144', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '5', 'Filtro de Aire sport', 'RR-2803 Se instala con parte de tubería original.', 'filtroaire.jpeg','3', '580', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '5', 'Filtro de aire Normal', 'Obtenga mejor protección para el motor y rendimiento mejorado cada 20 000 km con un filtro de aire nuevo. Un filtro de aire nuevo puede aumentar el flujo de aire, la potencia y el rendimiento del motor en general. Siga los intervalos de cambio recomendados según se indica en el manual del propietario de su vehículo.', 'filtroairenormal.jpeg','10', '250', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '5', 'Filtro de Gasolina', ' ofrece cobertura nacional y de importados excepcional en filtros de combustible - todo de una misma fuente. La línea de filtros de combustible FRAM incluye filtros de combustible enroscables convencionales y conductores de plástico para cumplir con las necesidades de prácticamente todas las configuraciones de motor.', 'filtrofram.webp','6', '650', '4');



INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '7', 'Balatas Delanteras Audi ', 'Semi - Metálica, Juego. Incluye herrajes. El material de la balata de OE es semimetálico. Sin sensor. El reemplazo de los herrajes es sumamente recomendable con cada cambio de balatas o zapatas.', 'balatasdel.webp','26', '745', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '7', 'Balatas Tracera', 'Semi - Metálica, Incluye herrajes. Con frenos Lucas. El reemplazo de los herrajes es sumamente recomendable con cada cambio de balatas o zapatas', 'balatastraseras.webp','15', '578', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '2', 'Castrol Sintetico 5W-30 Aceite', 'El aceite es sencillamente la  del motor, sin el sus componentes se deformarían a causa del calor, es por eso que siempre debe trabajar con lubricante en buen estado y de ahí la gran importancia de cambiarlo periódicamente.', 'aceite1lit.webp','25', '350', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '2', 'Garrafa Aceite Sintético 5w40 ', 'El aceite es sencillamente la  del motor, sin el sus componentes se deformarían a causa del calor, es por eso que siempre debe trabajar con lubricante en buen estado y de ahí la gran importancia de cambiarlo periódicamente.', 'aceite5lit.webp','3', '1250', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '6', 'Jgo Rotula Inferior Izquierda Y Derecha Audi', 'EL KIT INCLUYE:- 1 ROTULA INFERIOR IZQUIERDA- 1 ROTULA INFERIOR DERECHA APLICA PARA:KIT ROTULA INFERIOR IZQUIERDA Y DERECHA AUDI A1 2011 2012', 'rotulas.webp','5', '450', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '6', 'Resortes Ag Audi ', 'La Línea Ag Confort es una línea de resortes especializada en recuperar la altura original de tu vehículo, reduciendo las molestas vibraciones y ruidos de tu suspensión con los mismos valores de carga.', 'resortes.webp','8', '1350', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '6', 'Faro Delantero Derecho Original', 'El producto que observa en las fotografías es justo el que se enviará. Si el producto trae algún detalle lo podrá ver claramente en las imágenes. Debido a que es una pieza usada puede presentar detalles de uso normal o por el manejo de la pieza, pero nada que impida su buen funcionamiento.', 'faros.webp','15', '2580', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '6', 'Rines 18 5/100', 'Rines deportivos marca AM WHEELS, estos rines son fabricados con aluminio de alta calidad, NUEVOS', 'rinaudi.webp','4', '11500', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '3', 'Batería Audi A1 Cabr13/14', '///////LA UNICA BATERÍA DEL MERCADO CON GARANTÍA DIRECTA DE 18 MESES DE REEMPLAZO SIN COSTO Y 18 MAS CON AJUSTE /////////', 'bateriaaudi.webp','9', '2511', '4');
INSERT INTO Productos(Id_Vehiculo,Id_Cat,Nombre,Descripcion,URL_Foto,Unidades,Precio,Id_status) VALUES ('1', '3', 'Bateria Lth Agm Para Audi A1', 'LTH AGM es la mejor batería de placa plana en el mercado y cuenta con la tecnología más avanzada en baterías, lo cual se traduce en mayor poder, confianza y durabilidad. Está diseñada para durar más que las baterías convencionales y proporcionar energía a todos los accesorios eléctricos de los vehículos modernos. ', 'baterialth.webp','12', '5250', '4');













insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'A4',2014,"TSI 3.5 8CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'A4',2015,"TSI 3.0 8CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'A4',2016,"TSI 3.0 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'A4',2017,"TSI 3.2 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'A4',2018,"TSI 1.8 4CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'A4',2019,"TSI 1.8 4CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'A4',2020,"TSI 1.4 4CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'A4',2021,"TSI 1.4 4CIL");
####################################################################################

insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'Q3',2015,"TSI 3.5 8CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'Q3',2016,"TSI 3.8 8CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'Q3',2017,"TSI 3.5 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'Q3',2018,"TSI 2.5 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'Q3',2019,"TSI 2.0 5CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'Q3',2020,"TSI 1.8 4CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'Q3',2021,"TSI 1.8 4CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'Q3',2022,"TSI 1.8 4CIL");
####################################################################################

insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'R8',2017,"RSI 3.6 8CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'R8',2018,"RSI 3.5 8CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'R8',2019,"TFSI 3.5 8CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'R8',2020,"TFSI 3.0 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (1,'R8',2021,"TFSI 3.0 6CIL");
####################################################################################

insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'MDX',2016,"Turbo DOHC 3.7 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'MDX',2017,"Turbo DOHC 3.0 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'MDX',2018,"Turbo DOHC 3.5 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'MDX',2019,"Turbo DOHC 3.5 6CIL");
####################################################################################

insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'ILX',2014,"MF6 DC synchronous 2.5 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'ILX',2017,"MF6 DC synchronous 2.0 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'ILX',2018,"MF7 DC synchronous 2.3 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'ILX',2019,"MF8 DC synchronous 2.0 5CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'ILX',2021,"MF8 DC synchronous 1.5 4CIL");
####################################################################################

insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'NSX',2004,"doble (DOHC) 2.5 5CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'NSX',2005,"(DOHC) TYPE Y 2.5 5CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'NSX',2007,"doble (DOHC) 2.0 4CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'NSX',2009,"doble TYPE V 1.8 4CIL");
####################################################################################

insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'RLX',2015,"synchronous AC motors 2.6 6CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'RLX',2015,"synchronous AC motors 2.5 5CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'RLX',2015,"synchronous AC motors 1.8 5CIL");
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'RLX',2015,"synchronous AC motors 1.8 4CIL");
####################################################################################

insert into Modelo(Id_Marca,Modelo,Año,Motor) values (2,'TL');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (3,'M4');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (3,'230i');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (3,'540iA');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (3,'M140iA');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (3,'Z4');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (4,'Astra');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (4,'Aveo');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (4,'Camaro');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (4,'Chevy');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (4,'Matiz');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (5,'Cirrus');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (5,'Neon');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (5,'Grand Voyager');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (5,'Shadow');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (5,'Stratus');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (5,'Pacifica');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (6,'Adventure');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (6,'Bravo');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (6,'Palio');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (6,'Stilo');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (6,'Strada');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (7,'Eco Sport');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (7,'Explorer');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (7,'F-150');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (7,'Fiesta');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (7,'Focus');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (8,'Acadia');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (8,'Cayon');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (8,'Sierra');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (8,'Terrain');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (8,'Yukon');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (9,'Accet');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (9,'Creta');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (9,'Santa Fe');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (9,'Sonata');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (9,'Tucson');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (10,'March');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (10,'Altima');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (10,'Sentra');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (10,'Tida');
insert into Modelo(Id_Marca,Modelo,Año,Motor) values (10,'Tsuru');
