create database sapphire;
use sapphire



create table Producto(
IdProducto int primary key,
Nombre varchar (75),
Descripcion varchar(200),
Precio float);

create table Stock(
IdProducto  varchar(6),
foreign key (IdProducto) references Producto(IdProducto), 
Cantidad int,
Ruta varchar(5));

create table Cliente(
IdCliente varchar(50) primary key,
Nombre varchar(50),
Correo varchar(20),
Contrasena varchar(30),
Telefono int,
Direccion varchar(200));

create table Carrito(
IdCliente varchar(50),
foreign key (IdCliente) references Cliente(IdCliente),
IdProducto  varchar(6),
foreign key (IdProducto) references Producto(IdProducto),
Agregado int
);

create table Pedidos(
IdPedido int primary key,
IdCliente varchar(50),
foreign key (IdCliente) references Cliente(IdCliente),
MontoAPagar float,
IndicacionesDeEntrega varchar(200),
FechaPedido varchar(15),
FechaEntrega varchar(15));

create table Detalle(
IdPedido int,
foreign key (IdPedido) references Pedidos(IdPedido),
IdCliente varchar(50),
foreign key (IdCliente) references Cliente(IdCliente),
IdProducto  varchar(6),
foreign key (IdProducto)references Producto(IdProducto),
Comprado int);


INSERT INTO Producto (IdProducto, Nombre, Descripcion, Precio) VALUES 
('1', 'Crema Control Hidratante', 'Piel extremadamente seca 450ml', 400),
('2', 'Crema Renovadora Pies', 'Piel muy seca 320ml', 220),
('3', 'Perfume Blu Mediterraneo', 'Unisex - Acqua 150ml', 700),
('4', 'Perfume Pleasures', 'Mujer - Estee Lauder 100ml', 500),
('5', 'Perfume Modern Muse', 'Mujer - Estee Lauder 100ml', 680),
('6', 'Perfume Hallowen Magic', 'Mujer - Hallowen 100ml', 899),
('7', 'Paleta de Sombras', '35 tonos diferentes', 989),
('8', 'Beyonde Perfecting', 'Base de Maquillaje + Corrector', 899),
('9', 'Gradual Tanning', 'Bronceador Hidratante 217ml', 899),
('10', 'Crema para manos', 'Lavanda y Miel 28.3gr', 899);


INSERT INTO Stock (IdProducto, Cantidad, Ruta) VALUES
('1', 4, '001'),
('2', 3, '002'),
('3', 4, '003'),
('4', 3, '004'),
('5', 2, '005'),
('6', 0, '006'),
('7', 1, '007'),
('8', 3, '008'),
('9', 2, '009'),
('10', 4, '010');
