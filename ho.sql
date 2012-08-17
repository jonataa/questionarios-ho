/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50150
Source Host           : localhost:3306
Source Database       : ho

Target Server Type    : MYSQL
Target Server Version : 50150
File Encoding         : 65001

Date: 2012-08-17 14:38:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `grupo_item`
-- ----------------------------
DROP TABLE IF EXISTS `grupo_item`;
CREATE TABLE `grupo_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `descricao_plural` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of grupo_item
-- ----------------------------
INSERT INTO `grupo_item` VALUES ('1', 'Recepção Emergência', 'Recepção Emergência');
INSERT INTO `grupo_item` VALUES ('2', 'Serviços de Enfermagem', 'Serviços de Enfermagem');
INSERT INTO `grupo_item` VALUES ('3', 'Serviços Médicos', 'Serviços Médicos');
INSERT INTO `grupo_item` VALUES ('4', 'Serviço Social', 'Serviço Social');
INSERT INTO `grupo_item` VALUES ('5', 'Recepção Administrativa', 'Recepção Administrativa');
INSERT INTO `grupo_item` VALUES ('6', 'Serviço de Nutrição', 'Serviço de Nutrição');
INSERT INTO `grupo_item` VALUES ('7', 'Fisioterapia', 'Fisioterapia');
INSERT INTO `grupo_item` VALUES ('8', 'Ambulatório', 'Ambulatório');
INSERT INTO `grupo_item` VALUES ('9', 'Laboratório', 'Laboratório');
INSERT INTO `grupo_item` VALUES ('10', 'Bio Imagem', 'Bio Imagem');
INSERT INTO `grupo_item` VALUES ('11', 'Instalações Físicas', 'Instalações Físicas');
INSERT INTO `grupo_item` VALUES ('12', 'Opine apenas sobre os serviços que utilizou', 'Opine apenas sobre os serviços que utilizou');

-- ----------------------------
-- Table structure for `item`
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_item_id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_grupo_item1` (`grupo_item_id`) USING BTREE,
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`grupo_item_id`) REFERENCES `grupo_item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item
-- ----------------------------
INSERT INTO `item` VALUES ('1', '1', 'Rapidez na elaboração do Cadastro');
INSERT INTO `item` VALUES ('2', '1', 'Atendimento dos(as) recepcionistas');
INSERT INTO `item` VALUES ('3', '1', 'Orientações / Encaminhamentos');
INSERT INTO `item` VALUES ('4', '2', 'Informações / Orientações sobre os cuidados no atendimento');
INSERT INTO `item` VALUES ('5', '2', 'Cordialidade no atendimento');
INSERT INTO `item` VALUES ('6', '2', 'Rapidez no atendimento (Classif. Risco)');
INSERT INTO `item` VALUES ('7', '2', 'Interesse em resolver problemas');
INSERT INTO `item` VALUES ('8', '3', 'Informações / Orientações sobre o tratamento ou diagnóstico');
INSERT INTO `item` VALUES ('9', '3', 'Cordialidade no atendimento');
INSERT INTO `item` VALUES ('10', '3', 'Tempo de Atendimento Médico');
INSERT INTO `item` VALUES ('11', '4', 'Cordialidade no atendimento');
INSERT INTO `item` VALUES ('12', '4', 'Informações / Orientações');
INSERT INTO `item` VALUES ('13', '4', 'Interesse em resolver problemas');
INSERT INTO `item` VALUES ('14', '5', 'Orientações / Encaminhamentos');
INSERT INTO `item` VALUES ('15', '5', 'Cordialidade no atendimento');
INSERT INTO `item` VALUES ('17', '6', 'Informações / Orientações sobre dieta');
INSERT INTO `item` VALUES ('18', '6', 'Cordialidade no atendimento');
INSERT INTO `item` VALUES ('19', '6', 'Cumprimento de horário');
INSERT INTO `item` VALUES ('20', '7', 'Cordialidade no atendimento');
INSERT INTO `item` VALUES ('21', '7', 'Atendimento');
INSERT INTO `item` VALUES ('22', '7', 'Informações / Orientações');
INSERT INTO `item` VALUES ('27', '6', 'Qualidade das refeições servidas');
INSERT INTO `item` VALUES ('28', '8', 'Cordialidade no atendimento');
INSERT INTO `item` VALUES ('29', '8', 'Prazo para entrega de exame');
INSERT INTO `item` VALUES ('30', '8', 'Orientações / Encaminhamentos');
INSERT INTO `item` VALUES ('31', '8', 'Tempo de atendimento médico');
INSERT INTO `item` VALUES ('32', '8', 'Informações aos pacientes');
INSERT INTO `item` VALUES ('33', '9', 'Cordialidade no atendimento');
INSERT INTO `item` VALUES ('34', '9', 'Prazo para entrega de exame');
INSERT INTO `item` VALUES ('35', '9', 'Informações / Orientações');
INSERT INTO `item` VALUES ('36', '10', 'Cordialidade no atendimento');
INSERT INTO `item` VALUES ('37', '10', 'Prazo para entrega de exame');
INSERT INTO `item` VALUES ('38', '10', 'Disponibilidade nas Solicitações');
INSERT INTO `item` VALUES ('39', '10', 'Informação');
INSERT INTO `item` VALUES ('40', '11', 'Conservação das instalações');
INSERT INTO `item` VALUES ('41', '11', 'Apresentação da roupa de cama e banho');
INSERT INTO `item` VALUES ('42', '11', 'Limpeza das Instalações');
INSERT INTO `item` VALUES ('43', '11', 'Limpeza das áreas de circulação');
INSERT INTO `item` VALUES ('44', '12', 'Centro Cirúrgico');
INSERT INTO `item` VALUES ('45', '12', 'Centro Obstétrico');
INSERT INTO `item` VALUES ('46', '12', 'Psicologia');
INSERT INTO `item` VALUES ('47', '12', 'UTI Adulto');
INSERT INTO `item` VALUES ('48', '12', 'UTI Pediátrico');
INSERT INTO `item` VALUES ('49', '12', 'UTI Neonatal');
INSERT INTO `item` VALUES ('50', '12', 'Unid. Cuidados Intermediários');
INSERT INTO `item` VALUES ('51', '12', 'Outros Serviços');

-- ----------------------------
-- Table structure for `quem_respondeu`
-- ----------------------------
DROP TABLE IF EXISTS `quem_respondeu`;
CREATE TABLE `quem_respondeu` (
  `id` char(1) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quem_respondeu
-- ----------------------------
INSERT INTO `quem_respondeu` VALUES ('A', 'Acompanhante');
INSERT INTO `quem_respondeu` VALUES ('P', 'Paciente');
INSERT INTO `quem_respondeu` VALUES ('V', 'Visitante');

-- ----------------------------
-- Table structure for `questionario`
-- ----------------------------
DROP TABLE IF EXISTS `questionario`;
CREATE TABLE `questionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consultas` tinyint(4) NOT NULL DEFAULT '0',
  `exames` tinyint(4) NOT NULL DEFAULT '0',
  `internacao` tinyint(4) NOT NULL DEFAULT '0',
  `qual_unidade` varchar(255) DEFAULT NULL,
  `outros` varchar(255) DEFAULT NULL,
  `tipo_comentario_id` int(11) NOT NULL,
  `comentariosugestoes` varchar(255) DEFAULT NULL,
  `indicaria` tinyint(4) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `quem_respondeu_id` char(1) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `telefone2` varchar(100) DEFAULT NULL,
  `registration` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_questionario_tipo_comentario1` (`tipo_comentario_id`) USING BTREE,
  CONSTRAINT `questionario_ibfk_2` FOREIGN KEY (`tipo_comentario_id`) REFERENCES `tipo_comentario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of questionario
-- ----------------------------

-- ----------------------------
-- Table structure for `resposta`
-- ----------------------------
DROP TABLE IF EXISTS `resposta`;
CREATE TABLE `resposta` (
  `questionario_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `resposta_item_id` int(11) NOT NULL,
  PRIMARY KEY (`questionario_id`,`item_id`,`resposta_item_id`),
  KEY `fk_respostaquestionario_item1` (`item_id`) USING BTREE,
  KEY `fk_resposta_resposta_item1` (`resposta_item_id`) USING BTREE,
  KEY `fk_resposta_questionario1` (`questionario_id`) USING BTREE,
  CONSTRAINT `resposta_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `resposta_ibfk_2` FOREIGN KEY (`questionario_id`) REFERENCES `questionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `resposta_ibfk_3` FOREIGN KEY (`resposta_item_id`) REFERENCES `resposta_item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of resposta
-- ----------------------------

-- ----------------------------
-- Table structure for `resposta_item`
-- ----------------------------
DROP TABLE IF EXISTS `resposta_item`;
CREATE TABLE `resposta_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peso` tinyint(4) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of resposta_item
-- ----------------------------
INSERT INTO `resposta_item` VALUES ('1', '4', 'Ótimo');
INSERT INTO `resposta_item` VALUES ('2', '3', 'Bom');
INSERT INTO `resposta_item` VALUES ('3', '2', 'Regular');
INSERT INTO `resposta_item` VALUES ('4', '1', 'Ruim');
INSERT INTO `resposta_item` VALUES ('5', '0', 'Sem Resposta');

-- ----------------------------
-- Table structure for `tipo_comentario`
-- ----------------------------
DROP TABLE IF EXISTS `tipo_comentario`;
CREATE TABLE `tipo_comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `ordem` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao_UNIQUE` (`descricao`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_comentario
-- ----------------------------
INSERT INTO `tipo_comentario` VALUES ('1', 'Elogio', '2');
INSERT INTO `tipo_comentario` VALUES ('2', 'Reclamação', '3');
INSERT INTO `tipo_comentario` VALUES ('3', 'Sugestão', '5');
INSERT INTO `tipo_comentario` VALUES ('4', 'Reclamação e Sugestão', '4');
INSERT INTO `tipo_comentario` VALUES ('5', 'Sugestão e Elogio', '6');
INSERT INTO `tipo_comentario` VALUES ('6', 'Sugestão e Reclamação', '7');
INSERT INTO `tipo_comentario` VALUES ('7', 'Sem Comentário', '1');

-- ----------------------------
-- Table structure for `unidade`
-- ----------------------------
DROP TABLE IF EXISTS `unidade`;
CREATE TABLE `unidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of unidade
-- ----------------------------
INSERT INTO `unidade` VALUES ('1', 'UPA');
INSERT INTO `unidade` VALUES ('2', '3º ALA A');
INSERT INTO `unidade` VALUES ('3', '3º ALA B');
INSERT INTO `unidade` VALUES ('4', '4º ALA B');
INSERT INTO `unidade` VALUES ('5', 'SETOR DE SUPRIMENTOS - CAF');
INSERT INTO `unidade` VALUES ('9', 'NIR');
INSERT INTO `unidade` VALUES ('10', 'LABORATÓRIO');
INSERT INTO `unidade` VALUES ('11', 'CONTAS MÉDICAS');
INSERT INTO `unidade` VALUES ('12', 'UTI PED');
INSERT INTO `unidade` VALUES ('16', 'SADT');
INSERT INTO `unidade` VALUES ('18', 'CENTRO CIRÚRGICO');
INSERT INTO `unidade` VALUES ('19', 'CME');
INSERT INTO `unidade` VALUES ('20', 'AGÊNCIA TRANSFUSIONAL');
INSERT INTO `unidade` VALUES ('21', 'VIG. EPIDEMIOLÓGICA');
INSERT INTO `unidade` VALUES ('22', 'BCI - 1ºANDAR');
INSERT INTO `unidade` VALUES ('23', 'AMBULATÓRIO');
INSERT INTO `unidade` VALUES ('24', 'BIO IMAGEM');
INSERT INTO `unidade` VALUES ('25', 'ADMINISTRAÇÃO');
INSERT INTO `unidade` VALUES ('26', 'MANUTENÇÃO');
INSERT INTO `unidade` VALUES ('27', 'SERVIÇO DE FARMÁCIA');
INSERT INTO `unidade` VALUES ('29', 'SAME');
INSERT INTO `unidade` VALUES ('30', 'NUTRIÇÃO');
INSERT INTO `unidade` VALUES ('31', 'SERVIÇO GERAIS');
INSERT INTO `unidade` VALUES ('33', 'BRK SEGURANÇA INTEGRADA');
INSERT INTO `unidade` VALUES ('35', 'RH');
INSERT INTO `unidade` VALUES ('36', 'FONOAUDIOLOGIA');
INSERT INTO `unidade` VALUES ('37', 'UTI NEO');
INSERT INTO `unidade` VALUES ('38', 'PSICOLOGIA');
INSERT INTO `unidade` VALUES ('39', 'SAC/OUVIDORIA');
INSERT INTO `unidade` VALUES ('40', 'MARCAÇÃO DE EXAMES');
INSERT INTO `unidade` VALUES ('41', 'NÚCLEO DE ENSINO E PESQUISA');
INSERT INTO `unidade` VALUES ('42', 'FARMÁCIAS SATÉLITES');
INSERT INTO `unidade` VALUES ('44', 'TECNOLOGIA DA INFORMAÇÃO');
INSERT INTO `unidade` VALUES ('45', 'UNIDADE DE INTERNAMENTO');
INSERT INTO `unidade` VALUES ('46', 'COORDENAÇÕES DE ENFERMAGEM');
INSERT INTO `unidade` VALUES ('47', 'ENFERMEIROS DE REFERÊNCIA');
INSERT INTO `unidade` VALUES ('49', 'SERVIÇO SOCIAL');
INSERT INTO `unidade` VALUES ('50', 'WS');
INSERT INTO `unidade` VALUES ('52', 'GEOP');
INSERT INTO `unidade` VALUES ('54', 'FISIOTERAPIA');
INSERT INTO `unidade` VALUES ('55', 'BRK SUPERVISOR');
INSERT INTO `unidade` VALUES ('56', 'RECEPÇÃO');

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `datacriacao` date NOT NULL,
  `datamodificado` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`) USING BTREE,
  UNIQUE KEY `username_unique` (`usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('10', 'Administrador', 'admin@irmadulce.org.br', 'admin', 'f808ce8aae83f3a2cc885e1bafaea571e632507f', 'admin', '0000-00-00', '2012-08-17');
INSERT INTO `usuario` VALUES ('11', 'Default User', 'usuario@irmadulce.org.br', 'usuario', 'c0cd85122db50384fdfd30b108fbd561f3b1eb58', 'ouvidoria', '2012-08-17', '2012-08-17');
