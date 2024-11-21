

CREATE TABLE `administradores` (
  `idadmin` int(11) NOT NULL AUTO_INCREMENT,
  `fechaAlta` date NOT NULL,
  `estatus` varchar(45) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idadmin`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `administradores` VALUES ('2', '0000-00-00', 'activo', 'nada', '1');


CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `creditoC` float NOT NULL,
  `estatusC` varchar(45) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idcliente`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `clientes` VALUES ('1', '1000', 'activo', '0000-00-00', '2');


CREATE TABLE `descuentos` (
  `idDecuentos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `porcentaje` float NOT NULL,
  `FechaCreacion` date NOT NULL,
  PRIMARY KEY (`idDecuentos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `detallepedido` (
  `iddetallePedido` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `precioUnitario` float NOT NULL,
  `idpedido` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetallePedido`),
  KEY `idpedido` (`idpedido`),
  KEY `id` (`id`),
  CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`id`) REFERENCES `producto` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `empleados` (
  `idempleado` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) NOT NULL,
  `fechaContratacion` date NOT NULL,
  `sueldo` float NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idempleado`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `facturacion` (
  `idfacturacion` int(11) NOT NULL AUTO_INCREMENT,
  `fechaFactura` date NOT NULL,
  `totalF` float NOT NULL,
  `impuestos` float NOT NULL,
  `estatusPago` varchar(45) NOT NULL,
  `idpedido` int(11) DEFAULT NULL,
  PRIMARY KEY (`idfacturacion`),
  KEY `idpedido` (`idpedido`),
  CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `inventario` (
  `idinventario` int(11) NOT NULL AUTO_INCREMENT,
  `cantidadInicial` int(11) NOT NULL,
  `cantidadActual` int(11) NOT NULL,
  `movimiento` varchar(60) NOT NULL,
  `fechaMovimiento` date NOT NULL,
  `id` int(11) DEFAULT NULL,
  `idproveedores` int(11) DEFAULT NULL,
  PRIMARY KEY (`idinventario`),
  KEY `id` (`id`),
  KEY `idproveedores` (`idproveedores`),
  CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id`) REFERENCES `producto` (`id`),
  CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`idproveedores`) REFERENCES `proveedores` (`idproveedores`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `fechaPedido` date NOT NULL,
  `estado` varchar(45) NOT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `idempleado` int(11) DEFAULT NULL,
  `idDecuentos` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpedido`),
  KEY `idcliente` (`idcliente`),
  KEY `idempleado` (`idempleado`),
  KEY `idDecuentos` (`idDecuentos`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`idempleado`) REFERENCES `empleados` (`idempleado`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`idDecuentos`) REFERENCES `descuentos` (`idDecuentos`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(45) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `existencias` int(11) NOT NULL,
  `precioUnitario` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `producto` VALUES ('1', '1243', 'pruebaaa', '10', '10');
INSERT INTO `producto` VALUES ('2', '10', '10', '11', '10');
INSERT INTO `producto` VALUES ('3', '1', '1', '0', '1');
INSERT INTO `producto` VALUES ('4', 'P001', 'Paracetamol 500mg', '150', '12.5');
INSERT INTO `producto` VALUES ('5', 'P002', 'Ibuprofeno 200mg', '100', '15');
INSERT INTO `producto` VALUES ('6', 'P003', 'Amoxicilina 500mg', '200', '23');
INSERT INTO `producto` VALUES ('7', 'P004', 'Omeprazol 20mg', '50', '18.75');
INSERT INTO `producto` VALUES ('8', 'P005', 'Lorazepam 2mg', '80', '35');
INSERT INTO `producto` VALUES ('9', 'P006', 'Vitamina C 1000mg', '250', '10.5');
INSERT INTO `producto` VALUES ('10', 'P007', 'Ciprofloxacino 500mg', '60', '28');
INSERT INTO `producto` VALUES ('11', 'P008', 'Metformina 850mg', '300', '20');
INSERT INTO `producto` VALUES ('12', 'P009', 'Losartan 50mg', '150', '25.5');
INSERT INTO `producto` VALUES ('13', 'P010', 'Atorvastatina 20mg', '180', '22.5');
INSERT INTO `producto` VALUES ('14', 'P011', 'Diclofenaco 50mg', '130', '14');
INSERT INTO `producto` VALUES ('15', 'P012', 'Clonazepam 2mg', '90', '38');
INSERT INTO `producto` VALUES ('16', 'P013', 'Enalapril 10mg', '220', '19.5');
INSERT INTO `producto` VALUES ('17', 'P014', 'Salbutamol inhalador', '120', '45');
INSERT INTO `producto` VALUES ('18', 'P015', 'Ranitidina 150mg', '300', '12');
INSERT INTO `producto` VALUES ('19', 'P016', 'Insulina 100UI', '70', '120');
INSERT INTO `producto` VALUES ('20', 'P017', 'Acetaminofén 500mg', '200', '11.5');
INSERT INTO `producto` VALUES ('21', 'P018', 'Furosemida 40mg', '160', '17');
INSERT INTO `producto` VALUES ('22', 'P019', 'Aspirina 100mg', '400', '9');
INSERT INTO `producto` VALUES ('23', 'P020', 'Ketorolaco 10mg', '210', '18.5');
INSERT INTO `producto` VALUES ('24', 'P021', 'Levofloxacino 500mg', '70', '34');
INSERT INTO `producto` VALUES ('25', 'P022', 'Gabapentina 300mg', '90', '28.75');
INSERT INTO `producto` VALUES ('26', 'P023', 'Azitromicina 500mg', '80', '45.5');
INSERT INTO `producto` VALUES ('27', 'P024', 'Carbamazepina 200mg', '130', '23.5');
INSERT INTO `producto` VALUES ('28', 'P025', 'Dexametasona 4mg', '140', '15');
INSERT INTO `producto` VALUES ('29', 'P026', 'Claritromicina 500mg', '100', '30.5');
INSERT INTO `producto` VALUES ('30', 'P027', 'Prednisona 5mg', '170', '14.25');
INSERT INTO `producto` VALUES ('31', 'P028', 'Esomeprazol 40mg', '150', '27');
INSERT INTO `producto` VALUES ('32', 'P029', 'Alprazolam 1mg', '60', '40');
INSERT INTO `producto` VALUES ('33', 'P030', 'Rosuvastatina 10mg', '200', '26');
INSERT INTO `producto` VALUES ('34', 'P031', 'Cetirizina 10mg', '250', '13');
INSERT INTO `producto` VALUES ('35', 'P032', 'Captopril 25mg', '300', '11.5');
INSERT INTO `producto` VALUES ('36', 'P033', 'Levotiroxina 50mcg', '190', '20');
INSERT INTO `producto` VALUES ('37', 'P034', 'Bromuro de ipratropio', '70', '50');
INSERT INTO `producto` VALUES ('38', 'P035', 'Tramadol 50mg', '120', '32');
INSERT INTO `producto` VALUES ('39', 'P036', 'Mebendazol 100mg', '240', '10');
INSERT INTO `producto` VALUES ('40', 'P037', 'Carvedilol 25mg', '130', '21.5');
INSERT INTO `producto` VALUES ('41', 'P038', 'Loratadina 10mg', '400', '9.5');
INSERT INTO `producto` VALUES ('42', 'P039', 'Metronidazol 500mg', '300', '14');
INSERT INTO `producto` VALUES ('43', 'P040', 'Hidrocortisona 100mg', '90', '55');
INSERT INTO `producto` VALUES ('44', 'P041', 'Sertralina 50mg', '110', '30.5');
INSERT INTO `producto` VALUES ('45', 'P042', 'Venlafaxina 75mg', '80', '42');
INSERT INTO `producto` VALUES ('46', 'P043', 'Fluoxetina 20mg', '150', '25');
INSERT INTO `producto` VALUES ('47', 'P044', 'Meloxicam 15mg', '200', '18');
INSERT INTO `producto` VALUES ('48', 'P045', 'Risperidona 2mg', '60', '37');
INSERT INTO `producto` VALUES ('49', 'P046', 'Quetiapina 25mg', '100', '34.5');
INSERT INTO `producto` VALUES ('50', 'P047', 'Valproato de sodio 500mg', '220', '28');
INSERT INTO `producto` VALUES ('51', 'P048', 'Propranolol 40mg', '30', '13');
INSERT INTO `producto` VALUES ('52', 'P049', 'Clindamicina 300mg', '100', '33');
INSERT INTO `producto` VALUES ('53', 'P050', 'Clobazam 10mg', '50', '40');


CREATE TABLE `proveedores` (
  `idproveedores` int(11) NOT NULL AUTO_INCREMENT,
  `nombreP` varchar(45) NOT NULL,
  `contactoP` varchar(45) NOT NULL,
  `telefonoP` varchar(45) NOT NULL,
  `correoP` varchar(70) NOT NULL,
  `direccionP` varchar(100) NOT NULL,
  PRIMARY KEY (`idproveedores`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `tipoUsuario` varchar(45) NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` VALUES ('1', 'Jesus', 'Torres Flores', 'jesusatf', '1234', 'jesusantoniotorflor@gmail.com', '7771414733', 'PIRU Y ROBLE', 'admin');
INSERT INTO `usuarios` VALUES ('2', 'Juan', 'Perez', 'juancito', '1234', 'juangamer@gmail.com', '7771414733', 'priadfa', 'cliente');
