

CREATE TABLE `administradores` (
  `idadmin` int(11) NOT NULL AUTO_INCREMENT,
  `fechaAlta` date NOT NULL,
  `estatus` varchar(45) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idadmin`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `administradores` VALUES ('11', '0000-00-00', '', 'a', '34');
INSERT INTO `administradores` VALUES ('12', '2024-11-21', 'baja', 'Usuario para jorge Luis ', '35');
INSERT INTO `administradores` VALUES ('14', '2024-11-21', 'activo', 'w', '42');


CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `creditoC` float NOT NULL,
  `estatusC` varchar(45) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idcliente`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `clientes` VALUES ('10', '12', 'baja', '0000-00-00', '29');
INSERT INTO `clientes` VALUES ('12', '12', 'activo', '2024-11-22', '34');
INSERT INTO `clientes` VALUES ('15', '12', 'activo', '0000-00-00', '49');


CREATE TABLE `descuentos` (
  `idDecuentos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `porcentaje` float NOT NULL,
  `FechaCreacion` date NOT NULL,
  PRIMARY KEY (`idDecuentos`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `descuentos` VALUES ('16', 'Buen fin 2024', '23', '2024-11-21');
INSERT INTO `descuentos` VALUES ('18', 'promocion fin de mes', '12', '2024-11-23');
INSERT INTO `descuentos` VALUES ('19', 'Promocion de navidad', '15', '2024-11-24');


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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `detallepedido` VALUES ('1', '7', '120', '1', '6');
INSERT INTO `detallepedido` VALUES ('2', '11', '50', '2', '4');
INSERT INTO `detallepedido` VALUES ('3', '5', '50', '3', '4');
INSERT INTO `detallepedido` VALUES ('4', '2', '50', '4', '4');
INSERT INTO `detallepedido` VALUES ('5', '4', '123', '5', '1');
INSERT INTO `detallepedido` VALUES ('6', '1', '123', '6', '1');
INSERT INTO `detallepedido` VALUES ('8', '1', '70', '7', '5');
INSERT INTO `detallepedido` VALUES ('9', '3', '123', '7', '1');
INSERT INTO `detallepedido` VALUES ('10', '1', '50', '7', '4');
INSERT INTO `detallepedido` VALUES ('11', '1', '60', '7', '10');
INSERT INTO `detallepedido` VALUES ('12', '1', '123', '7', '1');
INSERT INTO `detallepedido` VALUES ('13', '2', '100', '7', '12');
INSERT INTO `detallepedido` VALUES ('14', '1', '50', '7', '4');
INSERT INTO `detallepedido` VALUES ('15', '1', '70', '7', '5');
INSERT INTO `detallepedido` VALUES ('16', '1', '50', '7', '4');
INSERT INTO `detallepedido` VALUES ('17', '5', '70', '7', '5');


CREATE TABLE `empleados` (
  `idempleado` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) NOT NULL,
  `fechaContratacion` date NOT NULL,
  `sueldo` float NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idempleado`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `empleados` VALUES ('5', 'Cajera', '2024-11-23', '1', '46');
INSERT INTO `empleados` VALUES ('6', 'repartidor', '2024-11-23', '1', '47');


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pedido` VALUES ('1', '2024-11-21', 'activo', '0', '0', '0');
INSERT INTO `pedido` VALUES ('2', '2024-11-21', 'activo', '0', '0', '0');
INSERT INTO `pedido` VALUES ('3', '2024-11-21', 'activo', '0', '0', '0');
INSERT INTO `pedido` VALUES ('4', '2024-11-21', 'activo', '0', '0', '0');
INSERT INTO `pedido` VALUES ('5', '2024-11-21', 'activo', '0', '0', '0');
INSERT INTO `pedido` VALUES ('6', '2024-11-21', 'activo', '0', '0', '0');
INSERT INTO `pedido` VALUES ('7', '2024-11-21', 'activo', '', '0', '0');


CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(45) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `existencias` int(11) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `precioUnitario` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `producto` VALUES ('1', 'olitas', 'medicamento de prueba', '19', '', '123');
INSERT INTO `producto` VALUES ('4', 'MED002', 'Paracetamol 500mg', '185', 'Analgesico', '50');
INSERT INTO `producto` VALUES ('5', 'MED002', 'Ibuprofeno 200mg', '148', 'Anti-inflamatorio', '70');
INSERT INTO `producto` VALUES ('6', 'MED003', 'Amoxicilina 500mg', '93', 'Antibiotico', '120');
INSERT INTO `producto` VALUES ('7', 'MED004', 'Aspirina 100mg', '250', 'Antiinflamatorio', '30');
INSERT INTO `producto` VALUES ('8', 'MED005', 'Clorfenamina 4mg', '180', 'Antihistaminico', '40');
INSERT INTO `producto` VALUES ('9', 'MED006', 'Omeprazol 20mg', '130', 'Antiacido', '85');
INSERT INTO `producto` VALUES ('10', 'MED007', 'Loratadina 10mg', '203', 'Antihistaminico', '60');
INSERT INTO `producto` VALUES ('11', 'MED008', 'Diclofenaco 75mg', '90', 'Antiinflamatorio', '110');
INSERT INTO `producto` VALUES ('12', 'MED009', 'Metformina 500mg', '210', 'Antidiabetico', '100');
INSERT INTO `producto` VALUES ('13', 'MED010', 'Enalapril 10mg', '140', 'Antihipertensivo', '95');
INSERT INTO `producto` VALUES ('16', 'MED011', 'clamoxil ', '80', '', '55');


CREATE TABLE `proveedores` (
  `idproveedores` int(11) NOT NULL AUTO_INCREMENT,
  `nombreP` varchar(45) NOT NULL,
  `contactoP` varchar(45) NOT NULL,
  `telefonoP` varchar(45) NOT NULL,
  `correoP` varchar(70) NOT NULL,
  `direccionP` varchar(100) NOT NULL,
  PRIMARY KEY (`idproveedores`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `proveedores` VALUES ('23', 'asdfgh', 'asdfghj', '1123456789', 's@hhh.com', 'qqqqq');
INSERT INTO `proveedores` VALUES ('25', 'c', 'c', '3333333333', 'w@gamil.com', 'q');
INSERT INTO `proveedores` VALUES ('26', 'Bimbo', 'Karla', '7771115161', 'karla@gmail.com', 'calle');
INSERT INTO `proveedores` VALUES ('27', 'FUD', 'aaaa', '5555555555', 'pedritoS@gmail.com', 'q');
INSERT INTO `proveedores` VALUES ('29', 'Pharma Plus S.A. de C.V.', 'a', '1234567890', 'a@g.com', 'FELIPE');
INSERT INTO `proveedores` VALUES ('32', 'Farmacéuticos Maypo', 'Mayo Zambada', '7778745625', 'Maypo@gmail.com', 'Chamapa');


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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` VALUES ('29', 'Vyda Alejandra', 'Calderon Rios', 'vyda2', '1234', 'calderon@gamil.com', '77789654123', 'Ruben Jaramillo', 'cliente');
INSERT INTO `usuarios` VALUES ('34', 'Luis Jorge', 'Garcia', 'ale12345', '1234', 'agjo220210@upemor.edu.mx', '2222222222', 'q', '');
INSERT INTO `usuarios` VALUES ('35', 'Cristhian', 'Ale', 'CR1', '123', 'q@s.com', '5987632472', 'Ruben Jaramillo', '');
INSERT INTO `usuarios` VALUES ('42', 'Jorge Alejandro', 'ale', 'ale17', '123', '123', 'jorge@gmail.com', '11111111232', 'asas');
INSERT INTO `usuarios` VALUES ('46', 'Nancy ', 'Sotelo', 'sotelo', '123', 'nana@gmial.com', '7775108888', 'l', 'empleado');
INSERT INTO `usuarios` VALUES ('47', 'Lupe', 'Rios', 'rio2', '22', 'rio@gmail.com', '11111111112', 'w', 'empleado');
INSERT INTO `usuarios` VALUES ('48', 'Luis', 'alejandro', 'jorgeAle', 'jorge16', 'jorge16', 'jorge@gmail.com', '7771670101', 'Tejalpa');
INSERT INTO `usuarios` VALUES ('49', 'Daniel', 'Travieso', 'danielT', '147', 'danielT@gmail.com', '7778958423', 'Civac', 'cliente');
INSERT INTO `usuarios` VALUES ('53', 'jorge', 'alejandro', 'ale', 'jorge16', 'jorge@gmail.com', '7771670101', 'Tejalpa', 'admin');
