

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `producto` VALUES ('1', '1243', 'pruebaaa', '10', '10');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` VALUES ('1', 'Jesus', 'Torres Flores', 'jesusatf', '1234', 'jesusantoniotorflor@gmail.com', '7771414733', 'PIRU Y ROBLE', 'admin');
