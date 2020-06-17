CREATE DATABASE  IF NOT EXISTS `bicicletaria` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bicicletaria`;
-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bicicletaria
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `entrega_venda`
--

DROP TABLE IF EXISTS `entrega_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrega_venda` (
  `id_venda` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `cep` varchar(25) NOT NULL,
  `rua` varchar(200) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(5) NOT NULL,
  KEY `fk_identrega_cliente_jur` (`cliente`),
  CONSTRAINT `fk_identrega_cliente_jur` FOREIGN KEY (`cliente`) REFERENCES `usuario_juridico` (`id_user_jur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrega_venda`
--

LOCK TABLES `entrega_venda` WRITE;
/*!40000 ALTER TABLE `entrega_venda` DISABLE KEYS */;
INSERT INTO `entrega_venda` VALUES (1,1,'16402-160<br>','Rua Presidente Eurico Gaspar Dutra<br>',1,'Jardim São Francisco da Boa Vista<br>','casa<br>','Lins<br>','SP<br'),(2,1,'16402-160','Rua Presidente Eurico Gaspar Dutra',1,'Jardim São Francisco da Boa Vista','','Lins','SP');
/*!40000 ALTER TABLE `entrega_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `espec_produtos`
--

DROP TABLE IF EXISTS `espec_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `espec_produtos` (
  `id_espec` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod_espec` int(11) NOT NULL,
  `estoque` int(11) NOT NULL,
  `cor` varchar(20) DEFAULT NULL,
  `cod_cor` varchar(20) DEFAULT NULL,
  `marca` varchar(40) DEFAULT NULL,
  `largura` varchar(10) DEFAULT NULL,
  `comprimento` varchar(10) DEFAULT NULL,
  `altura` varchar(10) DEFAULT NULL,
  `peso` varchar(10) DEFAULT NULL,
  `tamanho` varchar(5) DEFAULT NULL,
  `img_produto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_espec`),
  KEY `fk_espec_produto` (`id_prod_espec`),
  CONSTRAINT `fk_espec_produto` FOREIGN KEY (`id_prod_espec`) REFERENCES `produtos` (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `espec_produtos`
--

LOCK TABLES `espec_produtos` WRITE;
/*!40000 ALTER TABLE `espec_produtos` DISABLE KEYS */;
INSERT INTO `espec_produtos` VALUES (1,1,12,'Rosa','#F0F','Bella','0','100','60','0','0','produto_id_1.jpg'),(2,2,5,'Preto','#000','Track Bikes','0','103','57','0','0','produto_id_2.jpg'),(3,3,4,'-','-','Bandeirate','0','97.5','52','0','0','produto_id_3.jpg'),(4,4,6,'Azul','#00F','Wendy','0','80','53','13','0','produto_id_4.jpg'),(5,5,25,'Preto','#000','Exalt','510','539','0','0','0','produto_id_5.jpg'),(6,6,14,'Preto','#000','Invictus','0','0','0','0','0','produto_id_6.jpg'),(7,7,12,'Cromo','#999','KMC','0','0','0','0.365','0','produto_id_7.jpg'),(8,8,45,'-','-','Zefal','0','0','0','0.125','0','produto_id_8.jpg'),(9,9,23,'-','-','Solifes','0','0','0','0.200','0','produto_id_9.jpg'),(10,10,3,'-','-','Paco','0','0','0','0','0.80','produto_id_10.jpg'),(11,11,15,'-','-','Surtek','0','0','0','0','103','produto_id_11.jpg'),(12,12,12,'Prata','#CCC','Bee Bump','0','0','0','2.100','95','produto_id_12.jpg'),(13,13,12,'Vermelho','#F00','Supreme','0','0','0','0','44','produto_id_13.jpg'),(14,14,6,'-','-','Zefal','0','0','0','0','264','produto_id_14.jpg'),(15,15,67,'Preto','#000','Pirelli','26','195','0','0.950','0','produto_id_15.jpg'),(16,16,43,'Verde','#090','Pro Tork','0','0','0','0','P','produto_id_16.jpg'),(17,16,23,'Azul','#00F','Pro Tork','0','0','0','0','M','produto_id_16.jpg'),(18,16,12,'Verde','#090','Pro Tork','0','0','0','0','G','produto_id_16.jpg'),(19,16,15,'Verde','#090','Pro Tork','0','0','0','0','GG','produto_id_16.jpg');
/*!40000 ALTER TABLE `espec_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pagamento`
--

DROP TABLE IF EXISTS `forma_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pagamento` (
  `id_forma` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) NOT NULL,
  PRIMARY KEY (`id_forma`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pagamento`
--

LOCK TABLES `forma_pagamento` WRITE;
/*!40000 ALTER TABLE `forma_pagamento` DISABLE KEYS */;
INSERT INTO `forma_pagamento` VALUES (1,'Cartão de Crédito'),(2,'Cartão de Débito'),(3,'Boleto');
/*!40000 ALTER TABLE `forma_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_venda`
--

DROP TABLE IF EXISTS `itens_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_venda` (
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `desconto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_venda`
--

LOCK TABLES `itens_venda` WRITE;
/*!40000 ALTER TABLE `itens_venda` DISABLE KEYS */;
INSERT INTO `itens_venda` VALUES (1,7,'KMC',28.50,10,1,25.70),(2,16,'Pro Tork',64.00,10,2,121.60),(2,5,'Exalt',199.00,10,1,179.10),(2,7,'KMC',28.50,10,1,25.70);
/*!40000 ALTER TABLE `itens_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ofertas` (
  `id_oferta` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto_oferta` int(11) NOT NULL,
  `desconto` int(11) NOT NULL,
  `data_inicio_oferta` date DEFAULT NULL,
  `data_fim_oferta` date DEFAULT NULL,
  PRIMARY KEY (`id_oferta`),
  KEY `fk_prod_oferta` (`id_produto_oferta`),
  CONSTRAINT `fk_prod_oferta` FOREIGN KEY (`id_produto_oferta`) REFERENCES `produtos` (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ofertas`
--

LOCK TABLES `ofertas` WRITE;
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
INSERT INTO `ofertas` VALUES (1,2,15,'2019-01-02','2019-04-02'),(2,5,10,'2019-01-02','2019-03-02'),(3,7,10,'2019-01-02','2019-02-05'),(4,13,15,'2019-01-02','2019-02-25'),(5,9,10,'2019-01-02','2019-03-10'),(6,15,12,'2019-01-02','2019-01-28'),(7,16,10,'2019-01-02','2019-01-18');
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagamentos`
--

DROP TABLE IF EXISTS `pagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagamentos` (
  `id_venda` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `forma_pag` int(11) NOT NULL,
  `cod_barras` varchar(200) DEFAULT NULL,
  `num_cartao` varchar(25) NOT NULL,
  `val_mes` int(2) NOT NULL,
  `val_ano` int(5) NOT NULL,
  `cvc` int(3) NOT NULL,
  `parcelas` int(2) NOT NULL,
  UNIQUE KEY `num_cartao` (`num_cartao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamentos`
--

LOCK TABLES `pagamentos` WRITE;
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;
INSERT INTO `pagamentos` VALUES (2,1,1,'-','5090.6526.3014.3103',1,2020,905,2),(1,1,1,'-','5232841967101664<br>',1,2020,830,4);
/*!40000 ALTER TABLE `pagamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_produto` varchar(10) NOT NULL,
  `nome_produto` varchar(100) NOT NULL,
  `valor_unitario` varchar(10) NOT NULL,
  `parcelas_max` int(11) NOT NULL,
  `garantia` int(11) NOT NULL,
  `descricao` text DEFAULT NULL,
  `detalhes` varchar(400) DEFAULT NULL,
  `tipo_produto` int(11) NOT NULL,
  `sub_tipo_produto` int(11) NOT NULL,
  `img_produto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  UNIQUE KEY `codigo_produto` (`codigo_produto`),
  UNIQUE KEY `nome_produto` (`nome_produto`),
  KEY `fk_tipo_prod` (`tipo_produto`),
  KEY `fk_sub_tipo_prod` (`sub_tipo_produto`),
  CONSTRAINT `fk_sub_tipo_prod` FOREIGN KEY (`sub_tipo_produto`) REFERENCES `sub_tipo_produto` (`id_sub_tipo`),
  CONSTRAINT `fk_tipo_prod` FOREIGN KEY (`tipo_produto`) REFERENCES `tipo_produto` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'00001','Bicicleta Aro 24 Feminina Bella Com Cesta','545.000000',10,3,'-','Aros 24 em alumínio com paredes simples 36 furos, cesta, descando lateral, freios v-break, guidão de aço carbono, protetor de coroa e kit de segurança ',1,1,'produto_id_1.jpg'),(2,'00002','Bicicleta Aro 26 Track Bikes TB100XS com 18 Marchas e Dupla Suspensão','564.000000',10,3,'-','Quadro aço carbono com suspensão; Garfo suspensão aço carbono; Guidão aço carbono curvo mesa MTB; Freios V-Brake; Corrente KMC; Selim em poliuretano; Faixa Etária Sugerida: a partir dos 16 Anos',1,2,'produto_id_2.jpg'),(3,'00003','Bicicleta Aro 14 - Pantera Negra','429.000000',10,3,'-','Guidão com Regulagem de Altura, Melhor Ergonomia; Pedivela de Fácil Manutenção; Freio Traseiro a Tambor: Mais Eficiente; Rodas com Pneu em Eva: Melhor Performance; Selim Acolchoado; Guidão com Limitador de Giro;Rodinhas Laterais Para Aprendizagem; Fixadas No Quadro e Removíveis',1,6,'produto_id_3.jpg'),(4,'00004','Bicicleta Wendy Aro 20 Masculina Freios V-brake','435.000000',10,3,'-','Freios V-Brake; Aro 20 ; Peso Suportado: Aprox.: 70 KG; Peso Aprox.: 13 KG; Quadro: Aço Carbono',1,1,'produto_id_4.jpg'),(5,'00005','Cotoveleira Exalt T3 Elbow Pad','199.000000',10,1,'A cotoveleira Exalt vai lhe proporcionar uma ótima proteção para o jogo de nível profissional ao ser super leve e confortável; Feita com material respirável para manter seco e confortável; Três camada de preenchimento, suaviza impactos. ','-',5,35,'produto_id_5.jpg'),(6,'00006','Cotoveleira Tática Invictus Protec','89.6800000',8,1,'A Cotovoleira Tática Invictus Protec - Preta foi desenvolvida para absorver e resistir os fortes impactos, a tecnologia das cotoveleiras Protec INVICTUS garante segurança e conforto ao operador ou esportista.','Couraça em TPU (Poliuretano termoplástico), flexível e de alta resistência a impactos; Rebites metálicos na cor do produto; Acabamento fosco antirreflexo; Ajustes maleáveis; Parte interna em malha respirável; Parte externa em tecido resistente',5,35,'produto_id_6.jpg'),(7,'00007','Corrente Para Bike Fixa Sem Marcha Grossa Cromada 114 Elos','28.5000000',2,1,'-','Peso: Aprox. 365g; Universal para qualquer bicicleta sem marcha; Itens Inclusos: 1 Corrente Grossa Cromada.',4,25,'produto_id_7.jpg'),(8,'00008','LUBRIFICANTE ANTICORROSIVO ZEFAL PRO BIO LUBE ','38.9000000',2,0,'O Lubrificante Anticorrosivo da Zefal é perfeito para qualquer tipo de ambiente, pois forma uma camada protetora que mantém sua relação em ótimo estado, prevenindo a mesma contra corrosão e possíveis riscos, além de manter a relação lubrificada, assim garantindo uma transmissão com um bom desempenho e alta resistência.','Feito à base de ésteres sintéticos que dão uma proteção mais duradoura e de alto desempenho para peças de metal contra o uso diário, corrosão e riscos; Fornece performance espetacular contra condições atmosféricas versáteis; Ideal para os ciclistas que procuram competitividade e performance; Lubrificante de longa duração para qualquer condição; Totalmente biodegradável; Alto poder de lubrificação',3,17,'produto_id_8.jpg'),(9,'00009','Óleo Lubrificante Bike Bicicleta Mtb Hiper Solifes ','35.9900000',2,0,'O Hiper Lubrificante Solifes Oil é a evolução dos lubrificantes para correntes, são muitas vantagens em relação aos oleos comuns para tal finalidade; A aplicação em bicicletas tanto para Speed ou para MTB, garante até 180km de rodagem com total eficiência do produto. Sua aplicação é fácil, não lambusa, mantendo a corrente da bicicleta sempre limpa, repele as sujeiras que podem se acumular na relação e não sai em dias de chuva. ','Spray é Fácil e Prático; O Spray é a forma mais eficaz de lubrificar peças e equipamentos sensíveis, como relações e elos da corrente; Resistente ao contato com água; Menos é Mais! Lubrifica mais com menos produto',3,17,'produto_id_9.jpg'),(10,'00010','Velocímetro Bicicleta Analógico 60km Redondo Grande Ponteiro','33.9000000',2,1,'-','Velocímetro Bicicleta analógico 60 Km Grande Redondo Com Ponteiro; Acompanha cabo e engrenagem; Medida visor: 80mm; Com odometro  ',2,11,'produto_id_10.jpg'),(11,'00011','Bomba de Ar para Bicicleta ','69.0000000',3,1,'Bomba de ar Surtek prática e funcional ideal para inflar jantes de bicicleta, balões, brinquedos e colchões insufláveis. Tem uma mangueira de nylon reforçada e suporte duplo, inclui também um adaptador insuflável.','-',3,15,'produto_id_11.jpg'),(12,'00012','Bomba de Bicicleta de Pé Bee Pump com Manômetro','68.9000000',3,2,'Produto de alta qualidade, tanto em acabamento como em sua utilização.','Peso aproximado: 2,100g; Tubo reforçado; Pressão máxima: 160psi / 11 BAR',3,15,'produto_id_12.jpg'),(13,'00013','MEIA WOOM SUPREME MONACO 19','37.9000000',2,0,'Garanta muito mais conforto ao andar de bicicleta com a Meia Woom Supreme Monaco. Ideal para encarar qualquer modalidade de mountain bike - MTB, ciclismo de estrada e até mesmo para enfrentar seu dia a dia.','Tecido com tratamento térmico e de umidade - muito mais conforto em uma rápida absorção e liberação da umidade mantendo a temperatura ideal para o máximo em conforto; Confeccionada 100% em poliamida - maior leveza e maciez ao contato com a pele, além de diferentes gramaturas para as diferentes regiões dos pés;Tamanho único - composição que se molda ao formato dos pés de tamanhos 40 ao 44',5,33,'produto_id_13.jpg'),(14,'00014','CAMPAINHA ZÉFAL PIING - ALUMÍNIO E PLASTICO','30.0000000',2,2,'Campainha Piing em aluminio natural com base plastica preto','-',2,7,'produto_id_14.jpg'),(15,'00015','Pneu Bicicleta Slick Aro 26 Pirelli Tipo Caloi','52.0000000',2,0,'A Pirelli lança a linha premium de pneus de bicicleta, que foi desenvolvida especialmente para todos os segmentos disponíveis no mercado brasileiro. Os novos produtos contam com a mais avançada tecnologia em termos de compostos e processo produtivo que, alinhada à tradição da marca Pirelli, culmina em um pneu que acompanha o desempenho das bicicletas mais sofisticadas do mercado nacional.','Pode ser utilizado em MTB aro 26; Estrutura com arame; Peso aproximado: 950gr; Pressão Máxima: 60 psi',4,22,'produto_id_15.jpg'),(16,'00016','Camisa Ciclismo Bike Bicicleta Pro Tork Line 1 Hi-vis Verde','64.0000000',3,1,'-','Fabricado em tecido poliéster mais leve com tecnologia Dry; Zíper Invisível frontal; Modelagem sem elásticos nas mangas;  Bolsos traseiros para acondicionar utensílios; DISPONÍVEL NOS TAMANHOS: P, M, G, GG; Garantia de 90 dias contra defeitos de fabricação;',5,31,'produto_id_16.jpg');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_tipo_produto`
--

DROP TABLE IF EXISTS `sub_tipo_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_tipo_produto` (
  `id_sub_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_sub_tipo` varchar(20) DEFAULT NULL,
  `tipo_prod` int(11) NOT NULL,
  PRIMARY KEY (`id_sub_tipo`),
  KEY `fk_tipo_produto` (`tipo_prod`),
  CONSTRAINT `fk_tipo_produto` FOREIGN KEY (`tipo_prod`) REFERENCES `tipo_produto` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_tipo_produto`
--

LOCK TABLES `sub_tipo_produto` WRITE;
/*!40000 ALTER TABLE `sub_tipo_produto` DISABLE KEYS */;
INSERT INTO `sub_tipo_produto` VALUES (1,'Urbana',1),(2,'Mountain Bike',1),(3,'Fixed Gear Bike',1),(4,'Corrida',1),(5,'BMX',1),(6,'Infantil',1),(7,'Campainhas',2),(8,'Farol',2),(9,'Espelho',2),(10,'Cesta',2),(11,'Velocímetro',2),(12,'Bagageiro',2),(13,'Descanso',2),(14,'Cadeirinha',2),(15,'Bombas',3),(16,'Chaves',3),(17,'Lubrificantes',3),(18,'Remendos',3),(19,'Aro',4),(20,'Câmbio',4),(21,'Câmaras',4),(22,'Pneu',4),(23,'Roda',4),(24,'Freio',4),(25,'Corrente',4),(26,'Guidão ',4),(27,'Pedal',4),(28,'Quadro',4),(29,'Suspensão',4),(30,'Selim',4),(31,'Camisas',5),(32,'Calças',5),(33,'Meias',5),(34,'Joelheiras',5),(35,'Cotoveleiras',5),(36,'Corta Vento',5),(37,'Óculos',5),(38,'Capacete',5),(39,'Meias',5),(40,'Luvas',5);
/*!40000 ALTER TABLE `sub_tipo_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_cliente`
--

DROP TABLE IF EXISTS `tipo_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_cliente` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tipo_cliente` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_cliente`
--

LOCK TABLES `tipo_cliente` WRITE;
/*!40000 ALTER TABLE `tipo_cliente` DISABLE KEYS */;
INSERT INTO `tipo_cliente` VALUES (1,'Pessoa Física'),(2,'Pessoa Jurídica');
/*!40000 ALTER TABLE `tipo_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_produto`
--

DROP TABLE IF EXISTS `tipo_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_produto` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tipo` varchar(25) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_produto`
--

LOCK TABLES `tipo_produto` WRITE;
/*!40000 ALTER TABLE `tipo_produto` DISABLE KEYS */;
INSERT INTO `tipo_produto` VALUES (1,'Bicicletas'),(2,'Acessórios'),(3,'Ferramentas'),(4,'Componentes'),(5,'Vestuário');
/*!40000 ALTER TABLE `tipo_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_cliente` int(11) NOT NULL,
  `nome_user` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `senha` varchar(15) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'Gabriel de Oliveira Passos','424.299.158-47','(14) 91116-8633','gabriel.gamesyt2017@gmail.com','12345');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_juridico`
--

DROP TABLE IF EXISTS `usuario_juridico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_juridico` (
  `id_user_jur` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_cliente` int(5) NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `telefone_jur` varchar(15) DEFAULT NULL,
  `email_jur` varchar(45) NOT NULL,
  `senha` varchar(20) NOT NULL,
  PRIMARY KEY (`id_user_jur`),
  UNIQUE KEY `cnpj` (`cnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_juridico`
--

LOCK TABLES `usuario_juridico` WRITE;
/*!40000 ALTER TABLE `usuario_juridico` DISABLE KEYS */;
INSERT INTO `usuario_juridico` VALUES (1,2,'Empresa Teste LTDA','51.421.467/1247-92','(14) 99586-4997','email.emprestateste@gmail.com','246810');
/*!40000 ALTER TABLE `usuario_juridico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendas` (
  `id_venda` int(11) NOT NULL AUTO_INCREMENT,
  `total_produtos` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `forma_pagamento` int(11) NOT NULL,
  `numero_parcelas` int(11) NOT NULL,
  `data_venda` date DEFAULT NULL,
  `hora_venda` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_venda`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` VALUES (1,1,25.70,1,4,'2020-04-26','15:40:32'),(2,4,326.40,1,2,'2020-04-27','14:41:35');
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bicicletaria'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-01 11:46:07
