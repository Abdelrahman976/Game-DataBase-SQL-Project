-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 02:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinegame`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPlayerDetailsByWorld` (IN `world_id` INT)   BEGIN
    SELECT 
        p.PlayerID,
        p.Username,
        p.Status,
        p.XCoordinate,
        p.YCoordinate,
        p.ZCoordinate,
        p.WorldID,
        MAX(CASE WHEN s.Quantity = 1 THEN i.Name ELSE NULL END) AS Slot1,
        MAX(CASE WHEN s.Quantity = 2 THEN i.Name ELSE NULL END) AS Slot2,
        MAX(CASE WHEN s.Quantity = 3 THEN i.Name ELSE NULL END) AS Slot3
    FROM Player p
    LEFT JOIN Slot s ON p.PlayerID = s.PlayerID
    LEFT JOIN Item i ON s.ItemID = i.ItemID
    WHERE p.WorldID = world_id
    GROUP BY p.PlayerID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPlayersInWorld` (IN `world_id` INT)   BEGIN
    SELECT PlayerID, Username, Status, XCoordinate, YCoordinate, ZCoordinate
    FROM Player
    WHERE WorldID = world_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPlayersNotInWorld` (IN `input_world_id` INT)   BEGIN
    SELECT PlayerID, Username, Status, XCoordinate, YCoordinate, ZCoordinate, WorldID
    FROM Player
    WHERE WorldID <> input_world_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ViewPlayerDetails` (IN `playerID` INT)   BEGIN
    SELECT 
        p.PlayerID,
        p.Username,
        p.Status,
        p.XCoordinate,
        p.YCoordinate,
        p.ZCoordinate,
        s.SlotID,
        s.Quantity,
        i.ItemID,
        i.Name, 
        i.Durability
    FROM 
        Player AS p
        JOIN Slot AS s ON p.PlayerID = s.PlayerID
        JOIN Item AS i ON s.ItemID = i.ItemID
    WHERE 
        p.PlayerID = playerID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `biome`
--

CREATE TABLE `biome` (
  `BiomeName` varchar(255) NOT NULL,
  `Rarity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biome`
--

INSERT INTO `biome` (`BiomeName`, `Rarity`) VALUES
('Desert', 'Common'),
('Forest', 'Common'),
('Hills', 'Uncommon'),
('Mountains', 'Rare'),
('Ocean', 'Common'),
('Plains', 'Very Common'),
('Savannah', 'Uncommon'),
('Swamp', 'Uncommon'),
('Taiga', 'Rare'),
('Tundra', 'Rare');

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `BlockID` int(11) NOT NULL,
  `BlockType` varchar(255) NOT NULL,
  `IsCraftable` bit(1) NOT NULL,
  `IsBreakable` bit(1) NOT NULL,
  `Transparency` bit(1) NOT NULL,
  `Texture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`BlockID`, `BlockType`, `IsCraftable`, `IsBreakable`, `Transparency`, `Texture`) VALUES
(1, 'Stone', b'0', b'1', b'0', 'rough_gray'),
(2, 'Dirt', b'0', b'1', b'0', 'granular_brown'),
(3, 'Grass Block', b'0', b'1', b'0', 'textured_green'),
(4, 'Cobblestone', b'0', b'1', b'0', 'rugged_gray'),
(5, 'Wood Planks', b'1', b'1', b'0', 'smooth_brown'),
(6, 'Sand', b'0', b'1', b'0', 'fine_grain_yellow'),
(7, 'Gravel', b'0', b'1', b'0', 'coarse_gray'),
(8, 'Gold Ore', b'0', b'1', b'0', 'speckled_gold'),
(9, 'Iron Ore', b'0', b'1', b'0', 'spotted_rust'),
(10, 'Coal Ore', b'0', b'1', b'0', 'black_chunky'),
(11, 'BedRock', b'1', b'0', b'0', 'rough');

-- --------------------------------------------------------

--
-- Table structure for table `consistof`
--

CREATE TABLE `consistof` (
  `BlockID` int(11) NOT NULL,
  `BiomeName` varchar(255) NOT NULL,
  `WorldID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consistof`
--

INSERT INTO `consistof` (`BlockID`, `BiomeName`, `WorldID`) VALUES
(1, 'Forest', 1),
(2, 'Desert', 2),
(3, 'Tundra', 3);

-- --------------------------------------------------------

--
-- Table structure for table `craft`
--

CREATE TABLE `craft` (
  `PlayerID` int(11) NOT NULL,
  `ToolName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `craft`
--

INSERT INTO `craft` (`PlayerID`, `ToolName`) VALUES
(10, 'Diamond Bow'),
(4, 'Gold Shovel'),
(9, 'Golden Shield'),
(3, 'Iron Pickaxe'),
(2, 'Stone Axe'),
(1, 'Wooden Sword');

-- --------------------------------------------------------

--
-- Table structure for table `drops`
--

CREATE TABLE `drops` (
  `ItemID` int(11) NOT NULL,
  `MobID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drops`
--

INSERT INTO `drops` (`ItemID`, `MobID`, `Quantity`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 1),
(7, 7, 2),
(8, 8, 1),
(9, 9, 2),
(10, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `eats`
--

CREATE TABLE `eats` (
  `PlayerID` int(11) NOT NULL,
  `FoodName` varchar(255) NOT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eats`
--

INSERT INTO `eats` (`PlayerID`, `FoodName`, `Quantity`) VALUES
(1, 'Apple', 2),
(2, 'Bread', 3),
(3, 'Steak', 1),
(4, 'Carrot', 5),
(5, 'Potato', 2),
(6, 'Chicken', 1),
(7, 'Fish', 2),
(8, 'Lamb', 1),
(9, 'Pork', 2),
(10, 'Mushroom', 3);

-- --------------------------------------------------------

--
-- Table structure for table `enchantment`
--

CREATE TABLE `enchantment` (
  `ToolName` varchar(255) NOT NULL,
  `DamageIncrease` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enchantment`
--

INSERT INTO `enchantment` (`ToolName`, `DamageIncrease`) VALUES
('Diamond Bow', 3),
('Gold Shovel', 1),
('Golden Shield', 1),
('Iron Pickaxe', 1),
('Stone Axe', 3),
('Wooden Sword', 2);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `FoodName` varchar(255) NOT NULL,
  `HungerPoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`FoodName`, `HungerPoints`) VALUES
('Apple', 5),
('Bread', 10),
('Carrot', 3),
('Chicken', 15),
('Fish', 12),
('Lamb', 18),
('Mushroom', 7),
('Pork', 20),
('Potato', 8),
('Steak', 20);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ItemID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Durability` int(11) DEFAULT NULL,
  `MobiD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `Name`, `Durability`, `MobiD`) VALUES
(1, 'Bucket', 100, NULL),
(2, 'Hammer', 80, NULL),
(3, 'Ladder', 150, NULL),
(4, 'Hoe', 50, NULL),
(5, 'Rope', 70, NULL),
(6, 'Lantern', 120, NULL),
(7, 'Sickle', 110, NULL),
(8, 'Watering Can', 60, NULL),
(9, 'Fishing Rod', 90, NULL),
(10, 'Wheelbarrow', 100, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mob`
--

CREATE TABLE `mob` (
  `MobiD` int(11) NOT NULL,
  `Health` int(11) NOT NULL,
  `IsHostile` bit(1) NOT NULL,
  `AttackDamage` int(11) NOT NULL,
  `SpawnCondition` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mob`
--

INSERT INTO `mob` (`MobiD`, `Health`, `IsHostile`, `AttackDamage`, `SpawnCondition`, `Type`) VALUES
(1, 100, b'1', 15, 'Night', 'Zombie'),
(2, 150, b'1', 20, 'Darkness', 'Skeleton'),
(3, 200, b'0', 0, 'Daylight', 'Cow'),
(4, 180, b'0', 0, 'Grasslands', 'Sheep'),
(5, 120, b'1', 10, 'Underground', 'Spider'),
(6, 300, b'1', 25, 'Nether', 'Ghast'),
(7, 250, b'1', 30, 'End', 'Enderman'),
(8, 500, b'1', 50, 'End', 'Dragon'),
(9, 350, b'1', 35, 'Caves', 'Creeper'),
(10, 400, b'1', 40, 'Night', 'Witch');

-- --------------------------------------------------------

--
-- Stand-in structure for view `mobdropsview`
-- (See below for the actual view)
--
CREATE TABLE `mobdropsview` (
`MobiD` int(11)
,`Health` int(11)
,`IsHostile` bit(1)
,`AttackDamage` int(11)
,`SpawnCondition` varchar(255)
,`Type` varchar(255)
,`DropQuantity` int(11)
,`ItemName` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `PlayerID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `XCoordinate` int(11) NOT NULL,
  `YCoordinate` int(11) NOT NULL,
  `ZCoordinate` int(11) NOT NULL,
  `WorldID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`PlayerID`, `Username`, `Status`, `XCoordinate`, `YCoordinate`, `ZCoordinate`, `WorldID`) VALUES
(1, 'Hero001', 'Online', 100, 200, 3000, 1),
(2, 'Hero002', 'Offline', 150, 250, 350, 1),
(3, 'Hero003', 'Online', 200, 300, 400, 1),
(4, 'Hero004', 'Offline', 250, 350, 450, 1),
(5, 'Hero005', 'Online', 300, 400, 500, 1),
(6, 'Hero006', 'Offline', 350, 450, 550, 2),
(7, 'Hero007', 'Online', 400, 500, 600, 3),
(8, 'Hero008', 'Offline', 450, 550, 650, 2),
(9, 'Hero009', 'Online', 500, 600, 700, 3),
(10, 'Hero010', 'Offline', 550, 650, 750, 3),
(11, 'Hero011', 'Online', 100, 200, 300, 1),
(12, 'Hero012', 'Offline', 150, 250, 350, 1),
(13, 'Hero013', 'Online', 200, 300, 400, 1),
(14, 'Hero014', 'Offline', 250, 350, 450, 1),
(15, 'Hero015', 'Online', 300, 400, 500, 1);

--
-- Triggers `player`
--
DELIMITER $$
CREATE TRIGGER `UpdateLastAccessed` AFTER UPDATE ON `player` FOR EACH ROW BEGIN
    IF NEW.WorldID <> OLD.WorldID THEN
        UPDATE World
        SET LastAccessed = CURRENT_TIMESTAMP
        WHERE WorldID = NEW.WorldID;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `slot`
--

CREATE TABLE `slot` (
  `SlotID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `PlayerID` int(11) DEFAULT NULL,
  `ItemID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slot`
--

INSERT INTO `slot` (`SlotID`, `Quantity`, `PlayerID`, `ItemID`) VALUES
(1, 3, 1, 4),
(2, 5, 1, 1),
(3, 1, 1, 2),
(4, 1, 2, 1),
(5, 7, 2, 3),
(6, 2, 2, 4),
(7, 3, 3, 5),
(8, 6, 3, 6),
(9, 8, 3, 7),
(10, 4, 4, 8),
(11, 5, 4, 9),
(12, 9, 4, 10),
(13, 2, 5, 2),
(14, 3, 5, 3),
(15, 7, 5, 4),
(16, 8, 6, 5),
(17, 4, 6, 6),
(18, 1, 6, 7),
(19, 5, 7, 8),
(20, 6, 7, 9),
(21, 2, 7, 10),
(22, 4, 8, 1),
(23, 3, 8, 2),
(24, 9, 8, 3),
(25, 7, 9, 4),
(26, 1, 9, 5),
(27, 6, 9, 6),
(28, 8, 10, 7),
(29, 2, 10, 8),
(30, 5, 10, 9);

--
-- Triggers `slot`
--
DELIMITER $$
CREATE TRIGGER `check_slot_limit` BEFORE INSERT ON `slot` FOR EACH ROW BEGIN
    -- Declare a variable to store the count of slots
    DECLARE slot_count INT DEFAULT 0;

    -- Calculate the number of existing slots for the player trying to add a new slot
    SELECT COUNT(*) INTO slot_count
    FROM Slot
    WHERE PlayerID = NEW.PlayerID;

    -- Check if the player already has 3 slots
    IF slot_count >= 3 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Each player can have only up to 3 slots.';
    END IF; -- Make sure this is properly terminated
    -- No ELSE part is needed because if the condition is not met, the insert will proceed as normal
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tool`
--

CREATE TABLE `tool` (
  `ToolName` varchar(255) NOT NULL,
  `Durability` int(11) NOT NULL,
  `Damage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tool`
--

INSERT INTO `tool` (`ToolName`, `Durability`, `Damage`) VALUES
('Cross-bow', 500, 100),
('Diamond Bow', 384, 1),
('diamond hoe', 300, 15),
('Diamond Sword', 500, 50),
('Gold Shovel', 32, 2),
('Golden Shield', 336, 1),
('Iron Pickaxe', 250, 3),
('Netherite Sword', 600, 60),
('Stone Axe', 131, 5),
('Trident', 700, 400),
('Wooden Shovel', 100, 10),
('Wooden Sword', 59, 4);

-- --------------------------------------------------------

--
-- Table structure for table `world`
--

CREATE TABLE `world` (
  `WorldID` int(11) NOT NULL,
  `WorldName` varchar(255) NOT NULL,
  `WorldType` varchar(255) NOT NULL,
  `TimeCreated` datetime NOT NULL,
  `LastAccessed` datetime NOT NULL,
  `Seed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `world`
--

INSERT INTO `world` (`WorldID`, `WorldName`, `WorldType`, `TimeCreated`, `LastAccessed`, `Seed`) VALUES
(1, 'Earth', 'PvE', '2023-04-10 14:23:55', '2024-04-27 00:12:02', 123456),
(2, 'Mars', 'PvP', '2023-04-11 10:12:48', '2024-04-24 00:20:47', 654321),
(3, 'Venus', 'PvE', '2023-04-12 05:15:22', '2023-04-12 05:20:00', 234567);

-- --------------------------------------------------------

--
-- Structure for view `mobdropsview`
--
DROP TABLE IF EXISTS `mobdropsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mobdropsview`  AS SELECT `m`.`MobiD` AS `MobiD`, `m`.`Health` AS `Health`, `m`.`IsHostile` AS `IsHostile`, `m`.`AttackDamage` AS `AttackDamage`, `m`.`SpawnCondition` AS `SpawnCondition`, `m`.`Type` AS `Type`, `d`.`Quantity` AS `DropQuantity`, `i`.`Name` AS `ItemName` FROM ((`mob` `m` left join `drops` `d` on(`m`.`MobiD` = `d`.`MobID`)) left join `item` `i` on(`d`.`ItemID` = `i`.`ItemID`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biome`
--
ALTER TABLE `biome`
  ADD PRIMARY KEY (`BiomeName`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`BlockID`);

--
-- Indexes for table `consistof`
--
ALTER TABLE `consistof`
  ADD PRIMARY KEY (`BlockID`,`BiomeName`,`WorldID`),
  ADD KEY `WorldID` (`WorldID`),
  ADD KEY `BiomeName` (`BiomeName`);

--
-- Indexes for table `craft`
--
ALTER TABLE `craft`
  ADD PRIMARY KEY (`ToolName`,`PlayerID`),
  ADD KEY `PlayerID` (`PlayerID`);

--
-- Indexes for table `drops`
--
ALTER TABLE `drops`
  ADD PRIMARY KEY (`ItemID`,`MobID`),
  ADD KEY `MobID` (`MobID`);

--
-- Indexes for table `eats`
--
ALTER TABLE `eats`
  ADD PRIMARY KEY (`PlayerID`,`FoodName`),
  ADD KEY `FoodName` (`FoodName`);

--
-- Indexes for table `enchantment`
--
ALTER TABLE `enchantment`
  ADD PRIMARY KEY (`ToolName`,`DamageIncrease`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`FoodName`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `mob`
--
ALTER TABLE `mob`
  ADD PRIMARY KEY (`MobiD`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`PlayerID`),
  ADD KEY `WorldID` (`WorldID`);

--
-- Indexes for table `slot`
--
ALTER TABLE `slot`
  ADD PRIMARY KEY (`SlotID`),
  ADD KEY `PlayerID` (`PlayerID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `tool`
--
ALTER TABLE `tool`
  ADD PRIMARY KEY (`ToolName`);

--
-- Indexes for table `world`
--
ALTER TABLE `world`
  ADD PRIMARY KEY (`WorldID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `BlockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mob`
--
ALTER TABLE `mob`
  MODIFY `MobiD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `PlayerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `slot`
--
ALTER TABLE `slot`
  MODIFY `SlotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `world`
--
ALTER TABLE `world`
  MODIFY `WorldID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consistof`
--
ALTER TABLE `consistof`
  ADD CONSTRAINT `consistof_ibfk_1` FOREIGN KEY (`WorldID`) REFERENCES `world` (`WorldID`),
  ADD CONSTRAINT `consistof_ibfk_2` FOREIGN KEY (`BiomeName`) REFERENCES `biome` (`BiomeName`),
  ADD CONSTRAINT `consistof_ibfk_3` FOREIGN KEY (`BlockID`) REFERENCES `block` (`BlockID`);

--
-- Constraints for table `craft`
--
ALTER TABLE `craft`
  ADD CONSTRAINT `craft_ibfk_1` FOREIGN KEY (`ToolName`) REFERENCES `tool` (`ToolName`),
  ADD CONSTRAINT `craft_ibfk_2` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`);

--
-- Constraints for table `drops`
--
ALTER TABLE `drops`
  ADD CONSTRAINT `drops_ibfk_1` FOREIGN KEY (`MobID`) REFERENCES `mob` (`MobiD`),
  ADD CONSTRAINT `drops_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`);

--
-- Constraints for table `eats`
--
ALTER TABLE `eats`
  ADD CONSTRAINT `eats_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`),
  ADD CONSTRAINT `eats_ibfk_2` FOREIGN KEY (`FoodName`) REFERENCES `food` (`FoodName`);

--
-- Constraints for table `enchantment`
--
ALTER TABLE `enchantment`
  ADD CONSTRAINT `enchantment_ibfk_1` FOREIGN KEY (`ToolName`) REFERENCES `tool` (`ToolName`);

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`WorldID`) REFERENCES `world` (`WorldID`);

--
-- Constraints for table `slot`
--
ALTER TABLE `slot`
  ADD CONSTRAINT `slot_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`),
  ADD CONSTRAINT `slot_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
