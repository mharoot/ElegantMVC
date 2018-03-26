-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2018 at 09:17 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elegant-mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CustomerName` varchar(255) DEFAULT NULL,
  `ContactName` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `PostalCode` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `UserID`, `CustomerName`, `ContactName`, `Address`, `City`, `PostalCode`, `Country`) VALUES
(1, 6, 'Alfreds Futterkiste', 'Maria Anders', 'Obere Str. 57', 'Berlin', '12209', 'Germany'),
(2, 7, 'Ana Trujillo Emparedados y helados', 'Ana Trujillo', 'Avda. de la ConstituciÃ³n 2222', 'MÃ©xico D.F.', '05021', 'Mexico'),
(3, 8, 'Antonio Moreno TaquerÃ­a', 'Antonio Moreno', 'Mataderos 2312', 'MÃ©xico D.F.', '05023', 'Mexico'),
(4, 9, 'Around the Horn', 'Thomas Hardy', '120 Hanover Sq.', 'London', 'WA1 1DP', 'UK'),
(5, 10, 'Berglunds snabbkÃ¶p', 'Christina Berglund', 'BerguvsvÃ¤gen 8', 'LuleÃ¥', 'S-958 22', 'Sweden'),
(6, 11, 'Blauer See Delikatessen', 'Hanna Moos', 'Forsterstr. 57', 'Mannheim', '68306', 'Germany'),
(7, 12, 'Blondel pÃ¨re et fils', 'FrÃ©dÃ©rique Citeaux', '24, place KlÃ©ber', 'Strasbourg', '67000', 'France'),
(8, 13, 'BÃ³lido Comidas preparadas', 'MartÃ­n Sommer', 'C/ Araquil, 67', 'Madrid', '28023', 'Spain'),
(9, 14, 'Bon app\'', 'Laurence Lebihans', '12, rue des Bouchers', 'Marseille', '13008', 'France'),
(10, 15, 'Bottom-Dollar Marketse', 'Elizabeth Lincoln', '23 Tsawassen Blvd.', 'Tsawassen', 'T2F 8M4', 'Canada'),
(11, 16, 'B\'s Beverages', 'Victoria Ashworth', 'Fauntleroy Circus', 'London', 'EC2 5NT', 'UK'),
(12, 17, 'Cactus Comidas para llevar', 'Patricio Simpson', 'Cerrito 333', 'Buenos Aires', '1010', 'Argentina'),
(13, 18, 'Centro comercial Moctezuma', 'Francisco Chang', 'Sierras de Granada 9993', 'MÃ©xico D.F.', '05022', 'Mexico'),
(14, 19, 'Chop-suey Chinese', 'Yang Wang', 'Hauptstr. 29', 'Bern', '3012', 'Switzerland'),
(15, 20, 'ComÃ©rcio Mineiro', 'Pedro Afonso', 'Av. dos LusÃ­adas, 23', 'SÃ£o Paulo', '05432-043', 'Brazil'),
(16, 21, 'Consolidated Holdings', 'Elizabeth Brown', 'Berkeley Gardens 12 Brewery ', 'London', 'WX1 6LT', 'UK'),
(17, 22, 'Drachenblut Delikatessend', 'Sven Ottlieb', 'Walserweg 21', 'Aachen', '52066', 'Germany'),
(18, 23, 'Du monde entier', 'Janine Labrune', '67, rue des Cinquante Otages', 'Nantes', '44000', 'France'),
(19, 24, 'Eastern Connection', 'Ann Devon', '35 King George', 'London', 'WX3 6FW', 'UK'),
(20, 25, 'Ernst Handel', 'Roland Mendel', 'Kirchgasse 6', 'Graz', '8010', 'Austria'),
(21, 26, 'Familia Arquibaldo', 'Aria Cruz', 'Rua OrÃ³s, 92', 'SÃ£o Paulo', '05442-030', 'Brazil'),
(22, 27, 'FISSA Fabrica Inter. Salchichas S.A.', 'Diego Roel', 'C/ Moralzarzal, 86', 'Madrid', '28034', 'Spain'),
(23, 28, 'Folies gourmandes', 'Martine RancÃ©', '184, chaussÃ©e de Tournai', 'Lille', '59000', 'France'),
(24, 29, 'Folk och fÃ¤ HB', 'Maria Larsson', 'Ã…kergatan 24', 'BrÃ¤cke', 'S-844 67', 'Sweden'),
(25, 30, 'Frankenversand', 'Peter Franken', 'Berliner Platz 43', 'MÃ¼nchen', '80805', 'Germany'),
(26, 31, 'France restauration', 'Carine Schmitt', '54, rue Royale', 'Nantes', '44000', 'France'),
(27, 32, 'Franchi S.p.A.', 'Paolo Accorti', 'Via Monte Bianco 34', 'Torino', '10100', 'Italy'),
(28, 33, 'Furia Bacalhau e Frutos do Mar', 'Lino Rodriguez ', 'Jardim das rosas n. 32', 'Lisboa', '1675', 'Portugal'),
(29, 34, 'GalerÃ­a del gastrÃ³nomo', 'Eduardo Saavedra', 'Rambla de CataluÃ±a, 23', 'Barcelona', '08022', 'Spain'),
(30, 35, 'Godos Cocina TÃ­pica', 'JosÃ© Pedro Freyre', 'C/ Romero, 33', 'Sevilla', '41101', 'Spain'),
(31, 36, 'Gourmet Lanchonetes', 'AndrÃ© Fonseca', 'Av. Brasil, 442', 'Campinas', '04876-786', 'Brazil'),
(32, 37, 'Great Lakes Food Market', 'Howard Snyder', '2732 Baker Blvd.', 'Eugene', '97403', 'USA'),
(33, 38, 'GROSELLA-Restaurante', 'Manuel Pereira', '5Âª Ave. Los Palos Grandes', 'Caracas', '1081', 'Venezuela'),
(34, 39, 'Hanari Carnes', 'Mario Pontes', 'Rua do PaÃ§o, 67', 'Rio de Janeiro', '05454-876', 'Brazil'),
(35, 40, 'HILARIÃ“N-Abastos', 'Carlos HernÃ¡ndez', 'Carrera 22 con Ave. Carlos Soublette #8-35', 'San CristÃ³bal', '5022', 'Venezuela'),
(36, 41, 'Hungry Coyote Import Store', 'Yoshi Latimer', 'City Center Plaza 516 Main St.', 'Elgin', '97827', 'USA'),
(37, 42, 'Hungry Owl All-Night Grocers', 'Patricia McKenna', '8 Johnstown Road', 'Cork', '', 'Ireland'),
(38, 43, 'Island Trading', 'Helen Bennett', 'Garden House Crowther Way', 'Cowes', 'PO31 7PJ', 'UK'),
(39, 44, 'KÃ¶niglich Essen', 'Philip Cramer', 'Maubelstr. 90', 'Brandenburg', '14776', 'Germany'),
(40, 45, 'La corne d\'abondance', 'Daniel Tonini', '67, avenue de l\'Europe', 'Versailles', '78000', 'France'),
(41, 46, 'La maison d\'Asie', 'Annette Roulet', '1 rue Alsace-Lorraine', 'Toulouse', '31000', 'France'),
(42, 47, 'Laughing Bacchus Wine Cellars', 'Yoshi Tannamuri', '1900 Oak St.', 'Vancouver', 'V3F 2K1', 'Canada'),
(43, 48, 'Lazy K Kountry Store', 'John Steel', '12 Orchestra Terrace', 'Walla Walla', '99362', 'USA'),
(44, 49, 'Lehmanns Marktstand', 'Renate Messner', 'Magazinweg 7', 'Frankfurt a.M. ', '60528', 'Germany'),
(45, 50, 'Let\'s Stop N Shop', 'Jaime Yorres', '87 Polk St. Suite 5', 'San Francisco', '94117', 'USA'),
(46, 51, 'LILA-Supermercado', 'Carlos GonzÃ¡lez', 'Carrera 52 con Ave. BolÃ­var #65-98 Llano Largo', 'Barquisimeto', '3508', 'Venezuela'),
(47, 52, 'LINO-Delicateses', 'Felipe Izquierdo', 'Ave. 5 de Mayo Porlamar', 'I. de Margarita', '4980', 'Venezuela'),
(48, 53, 'Lonesome Pine Restaurant', 'Fran Wilson', '89 Chiaroscuro Rd.', 'Portland', '97219', 'USA'),
(49, 54, 'Magazzini Alimentari Riuniti', 'Giovanni Rovelli', 'Via Ludovico il Moro 22', 'Bergamo', '24100', 'Italy'),
(50, 55, 'Maison Dewey', 'Catherine Dewey', 'Rue Joseph-Bens 532', 'Bruxelles', 'B-1180', 'Belgium'),
(51, 56, 'MÃ¨re Paillarde', 'Jean FresniÃ¨re', '43 rue St. Laurent', 'MontrÃ©al', 'H1J 1C3', 'Canada'),
(52, 57, 'Morgenstern Gesundkost', 'Alexander Feuer', 'Heerstr. 22', 'Leipzig', '04179', 'Germany'),
(53, 58, 'North/South', 'Simon Crowther', 'South House 300 Queensbridge', 'London', 'SW7 1RZ', 'UK'),
(54, 59, 'OcÃ©ano AtlÃ¡ntico Ltda.', 'Yvonne Moncada', 'Ing. Gustavo Moncada 8585 Piso 20-A', 'Buenos Aires', '1010', 'Argentina'),
(55, 60, 'Old World Delicatessen', 'Rene Phillips', '2743 Bering St.', 'Anchorage', '99508', 'USA'),
(56, 61, 'Ottilies KÃ¤seladen', 'Henriette Pfalzheim', 'Mehrheimerstr. 369', 'KÃ¶ln', '50739', 'Germany'),
(57, 62, 'Paris spÃ©cialitÃ©s', 'Marie Bertrand', '265, boulevard Charonne', 'Paris', '75012', 'France'),
(58, 63, 'Pericles Comidas clÃ¡sicas', 'Guillermo FernÃ¡ndez', 'Calle Dr. Jorge Cash 321', 'MÃ©xico D.F.', '05033', 'Mexico'),
(59, 64, 'Piccolo und mehr', 'Georg Pipps', 'Geislweg 14', 'Salzburg', '5020', 'Austria'),
(60, 65, 'Princesa Isabel Vinhoss', 'Isabel de Castro', 'Estrada da saÃºde n. 58', 'Lisboa', '1756', 'Portugal'),
(61, 66, 'Que DelÃ­cia', 'Bernardo Batista', 'Rua da Panificadora, 12', 'Rio de Janeiro', '02389-673', 'Brazil'),
(62, 67, 'Queen Cozinha', 'LÃºcia Carvalho', 'Alameda dos CanÃ rios, 891', 'SÃ£o Paulo', '05487-020', 'Brazil'),
(63, 68, 'QUICK-Stop', 'Horst Kloss', 'TaucherstraÃŸe 10', 'Cunewalde', '01307', 'Germany'),
(64, 69, 'Rancho grande', 'Sergio GutiÃ©rrez', 'Av. del Libertador 900', 'Buenos Aires', '1010', 'Argentina'),
(65, 70, 'Rattlesnake Canyon Grocery', 'Paula Wilson', '2817 Milton Dr.', 'Albuquerque', '87110', 'USA'),
(66, 71, 'Reggiani Caseifici', 'Maurizio Moroni', 'Strada Provinciale 124', 'Reggio Emilia', '42100', 'Italy'),
(67, 72, 'Ricardo Adocicados', 'Janete Limeira', 'Av. Copacabana, 267', 'Rio de Janeiro', '02389-890', 'Brazil'),
(68, 73, 'Richter Supermarkt', 'Michael Holz', 'Grenzacherweg 237', 'GenÃ¨ve', '1203', 'Switzerland'),
(69, 74, 'Romero y tomillo', 'Alejandra Camino', 'Gran VÃ­a, 1', 'Madrid', '28001', 'Spain'),
(70, 75, 'SantÃ© Gourmet', 'Jonas Bergulfsen', 'Erling Skakkes gate 78', 'Stavern', '4110', 'Norway'),
(71, 76, 'Save-a-lot Markets', 'Jose Pavarotti', '187 Suffolk Ln.', 'Boise', '83720', 'USA'),
(72, 77, 'Seven Seas Imports', 'Hari Kumar', '90 Wadhurst Rd.', 'London', 'OX15 4NB', 'UK'),
(73, 78, 'Simons bistro', 'Jytte Petersen', 'VinbÃ¦ltet 34', 'KÃ¸benhavn', '1734', 'Denmark'),
(74, 79, 'SpÃ©cialitÃ©s du monde', 'Dominique Perrier', '25, rue Lauriston', 'Paris', '75016', 'France'),
(75, 80, 'Split Rail Beer & Ale', 'Art Braunschweiger', 'P.O. Box 555', 'Lander', '82520', 'USA'),
(76, 81, 'SuprÃªmes dÃ©lices', 'Pascale Cartrain', 'Boulevard Tirou, 255', 'Charleroi', 'B-6000', 'Belgium'),
(77, 82, 'The Big Cheese', 'Liz Nixon', '89 Jefferson Way Suite 2', 'Portland', '97201', 'USA'),
(78, 83, 'The Cracker Box', 'Liu Wong', '55 Grizzly Peak Rd.', 'Butte', '59801', 'USA'),
(79, 84, 'Toms SpezialitÃ¤ten', 'Karin Josephs', 'Luisenstr. 48', 'MÃ¼nster', '44087', 'Germany'),
(80, 85, 'Tortuga Restaurante', 'Miguel Angel Paolino', 'Avda. Azteca 123', 'MÃ©xico D.F.', '05033', 'Mexico'),
(81, 86, 'TradiÃ§Ã£o Hipermercados', 'Anabela Domingues', 'Av. InÃªs de Castro, 414', 'SÃ£o Paulo', '05634-030', 'Brazil'),
(82, 87, 'Trail\'s Head Gourmet Provisioners', 'Helvetius Nagy', '722 DaVinci Blvd.', 'Kirkland', '98034', 'USA'),
(83, 88, 'Vaffeljernet', 'Palle Ibsen', 'SmagslÃ¸get 45', 'Ã…rhus', '8200', 'Denmark'),
(84, 89, 'Victuailles en stock', 'Mary Saveley', '2, rue du Commerce', 'Lyon', '69004', 'France'),
(85, 90, 'Vins et alcools Chevalier', 'Paul Henriot', '59 rue de l\'Abbaye', 'Reims', '51100', 'France'),
(86, 91, 'Die Wandernde Kuh', 'Rita MÃ¼ller', 'Adenauerallee 900', 'Stuttgart', '70563', 'Germany'),
(87, 92, 'Wartian Herkku', 'Pirkko Koskitalo', 'Torikatu 38', 'Oulu', '90110', 'Finland'),
(88, 93, 'Wellington Importadora', 'Paula Parente', 'Rua do Mercado, 12', 'Resende', '08737-363', 'Brazil'),
(89, 94, 'White Clover Markets', 'Karl Jablonski', '305 - 14th Ave. S. Suite 3B', 'Seattle', '98128', 'USA'),
(90, 95, 'Wilman Kala', 'Matti Karttunen', 'Keskuskatu 45', 'Helsinki', '21240', 'Finland'),
(91, 96, 'Wolski', 'Zbyszek', 'ul. Filtrowa 68', 'Walla', '01-012', 'Poland');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
