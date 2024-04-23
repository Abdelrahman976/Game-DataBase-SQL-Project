
GRANT ALL ON OnlineGame.* TO 'Team10'@'localhost' IDENTIFIED BY 'SurvivalGameDB';
GRANT ALL ON OnlineGame.* TO 'Team10'@'127.0.0.1' IDENTIFIED BY 'SurvivalGameDB';
Create Database OnlineGame;
USE OnlineGame;


CREATE TABLE World (
  WorldID INT PRIMARY KEY AUTO_INCREMENT,
  WorldName VARCHAR(255) NOT NULL,
  WorldType VARCHAR(255) NOT NULL,
  TimeCreated DATETIME NOT NULL,
  LastAccessed DATETIME NOT NULL,
  Seed int NOT NULL
);

CREATE TABLE Player (
  PlayerID INT PRIMARY KEY AUTO_INCREMENT,
  Username VARCHAR(255) NOT NULL,
  Status VARCHAR(255) NOT NULL,
  XCoordinate INT NOT NULL,
  YCoordinate INT NOT NULL,
  ZCoordinate INT NOT NULL,
  WorldID INT NOT NULL,
  FOREIGN KEY (WorldID) REFERENCES World(WorldID)
);
CREATE TABLE Food (
  FoodName VARCHAR(255) PRIMARY KEY,
  HungerPoints INT NOT NULL
);
CREATE TABLE Eats (
  PlayerID INT,
  FoodName VARCHAR(255),
  Quantity INT,
  FOREIGN KEY (PlayerID) REFERENCES Player(PlayerID),
  FOREIGN KEY (FoodName) REFERENCES Food(FoodName),
  PRIMARY KEY (PlayerID, FoodName)
);
CREATE TABLE Item (
  ItemID INT PRIMARY KEY AUTO_INCREMENT,
  Name VARCHAR(255),
  Durability INT,
  MobiD INT
);
CREATE TABLE Slot (
  SlotID INT PRIMARY KEY AUTO_INCREMENT,
  Quantity INT,
  PlayerID INT,
  ItemID INT,
  FOREIGN KEY (PlayerID) REFERENCES Player(PlayerID),
  FOREIGN KEY (ItemID) REFERENCES Item(ItemID)
);
CREATE TABLE Mob (
  MobiD INT PRIMARY KEY AUTO_INCREMENT,
  Health INT NOT NULL,
  IsHostile BIT NOT NULL,
  AttackDamage INT NOT NULL,
  SpawnCondition VARCHAR(255) NOT NULL,
  Type VARCHAR(255) NOT NULL
);
CREATE TABLE Drops (
  ItemID INT,
  MobID INT,
  Quantity INT,
  FOREIGN KEY (MobID) REFERENCES Mob(MobiD),
  FOREIGN KEY (ItemID) REFERENCES Item(ItemID),
  PRIMARY KEY (ItemID, MobID)
);
CREATE TABLE Tool (
  ToolName VARCHAR(255) PRIMARY KEY,
  Durability INT NOT NULL,
  Damage INT NOT NULL
);
CREATE TABLE Enchantment (
  ToolName VARCHAR(255),
  DamageIncrease INT,
  FOREIGN KEY (ToolName) REFERENCES Tool(ToolName),
  PRIMARY KEY (ToolName, DamageIncrease)
);
CREATE TABLE Craft (
  PlayerID INT,
  ToolName VARCHAR(255),
  FOREIGN KEY (ToolName) REFERENCES Tool(ToolName),
  FOREIGN KEY (PlayerID) REFERENCES Player(PlayerID),
  PRIMARY KEY (ToolName, PlayerID)
);
CREATE TABLE Block (
  BlockID INT PRIMARY KEY AUTO_INCREMENT,
  BlockType VARCHAR(255) NOT NULL,
  IsCraftable BIT NOT NULL,
  IsBreakable BIT NOT NULL,
  Transparency BIT NOT NULL,
  Texture VARCHAR(255) NOT NULL
);
Create Table Biome(
  BiomeName VARCHAR(255) PRIMARY KEY,
  Rarity VARCHAR(255) NOT NULL
);
Create Table ConsistOf(
  BlockID INT,
  BiomeName VARCHAR(255),
  WorldID INT,
  FOREIGN KEY (WorldID) REFERENCES World(WorldID),
  FOREIGN KEY (BiomeName) REFERENCES Biome(BiomeName),
  FOREIGN KEY (BlockID) REFERENCES Block(BlockID),
  PRIMARY KEY (BlockID, BiomeName,WorldID)
);
-- Inserting data into the World table
INSERT INTO World (WorldName, WorldType, TimeCreated, LastAccessed, Seed) VALUES
('Earth', 'PvE', '2023-04-10 14:23:55', '2023-04-12 16:25:33', 123456),
('Mars', 'PvP', '2023-04-11 10:12:48', '2023-04-12 11:45:29', 654321),
('Venus', 'PvE', '2023-04-12 05:15:22', '2023-04-12 05:20:00', 234567),
-- Inserting data into the Player table
INSERT INTO Player (Username, Status, XCoordinate, YCoordinate, ZCoordinate, WorldID) VALUES
('Hero001', 'Online', 100, 200, 300, 1),
('Hero002', 'Offline', 150, 250, 350, 2),
('Hero003', 'Online', 200, 300, 400, 3),
('Hero004', 'Offline', 250, 350, 450, 4),
('Hero005', 'Online', 300, 400, 500, 5),
('Hero006', 'Offline', 350, 450, 550, 6),
('Hero007', 'Online', 400, 500, 600, 7),
('Hero008', 'Offline', 450, 550, 650, 8),
('Hero009', 'Online', 500, 600, 700, 9),
('Hero010', 'Offline', 550, 650, 750, 10);

-- Inserting data into the Food table
INSERT INTO Food (FoodName, HungerPoints) VALUES
('Apple', 5),
('Bread', 10),
('Steak', 20),
('Carrot', 3),
('Potato', 8),
('Chicken', 15),
('Fish', 12),
('Lamb', 18),
('Pork', 20),
('Mushroom', 7);

-- Inserting data into the Eats table (assuming players eat different food items)
INSERT INTO Eats (PlayerID, FoodName, Quantity) VALUES
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

-- Inserting data into the Item table (some items without MobiD initially)
INSERT INTO Item (Name, Durability, MobiD) VALUES
('Bucket', 100, NULL),
('Hammer', 80, NULL),
('Ladder', 150, NULL),
('Hoe', 50, NULL),
('Rope', 70, NULL),
('Lantern', 120, NULL),
('Sickle', 110, NULL),
('Watering Can', 60, NULL),
('Fishing Rod', 90, NULL),
('Wheelbarrow', 100, NULL);
-- Inserting data into the Mob table
INSERT INTO Mob (Health, IsHostile, AttackDamage, SpawnCondition, Type) VALUES
(100, 1, 15, 'Night', 'Zombie'),
(150, 1, 20, 'Darkness', 'Skeleton'),
(200, 0, 0, 'Daylight', 'Cow'),
(180, 0, 0, 'Grasslands', 'Sheep'),
(120, 1, 10, 'Underground', 'Spider'),
(300, 1, 25, 'Nether', 'Ghast'),
(250, 1, 30, 'End', 'Enderman'),
(500, 1, 50, 'End', 'Dragon'),
(350, 1, 35, 'Caves', 'Creeper'),
(400, 1, 40, 'Night', 'Witch');

-- Inserting data into the Slot table
INSERT INTO Slot (Quantity, PlayerID, ItemID) VALUES
(3, 1, 4),
(5, 1, 1),
(1, 1, 2),
(1, 2, 1),
(7, 2, 3),
(2, 2, 4),
(3, 3, 5),
(6, 3, 6),
(8, 3, 7),
(4, 4, 8),
(5, 4, 9),
(9, 4, 10),
(2, 5, 2),
(3, 5, 3),
(7, 5, 4),
(8, 6, 5),
(4, 6, 6),
(1, 6, 7),
(5, 7, 8),
(6, 7, 9),
(2, 7, 10),
(4, 8, 1),
(3, 8, 2),
(9, 8, 3),
(7, 9, 4),
(1, 9, 5),
(6, 9, 6),
(8, 10, 7),
(2, 10, 8),
(5, 10, 9);
-- Inserting data into the Drops table
INSERT INTO Drops (ItemID, MobID, Quantity) VALUES
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

-- Inserting data into the Tool table
INSERT INTO Tool (ToolName, Durability, Damage) VALUES
('Wooden Sword', 59, 4),
('Stone Axe', 131, 5),
('Iron Pickaxe', 250, 3),
('Gold Shovel', 32, 2),
('Diamond Helmet', 363, 1),
('Leather Chestplate', 81, 1),
('Chain Leggings', 225, 1),
('Iron Boots', 196, 1),
('Golden Shield', 336, 1),
('Diamond Bow', 384, 1);

-- Inserting data into the Enchantment table
INSERT INTO Enchantment (ToolName, DamageIncrease) VALUES
('Wooden Sword', 2),
('Stone Axe', 3),
('Iron Pickaxe', 1),
('Gold Shovel', 1),
('Diamond Helmet', 1),
('Leather Chestplate', 1),
('Chain Leggings', 1),
('Iron Boots', 1),
('Golden Shield', 1),
('Diamond Bow', 3);

-- Inserting data into the Craft table
INSERT INTO Craft (PlayerID, ToolName) VALUES
(1, 'Wooden Sword'),
(2, 'Stone Axe'),
(3, 'Iron Pickaxe'),
(4, 'Gold Shovel'),
(5, 'Diamond Helmet'),
(6, 'Leather Chestplate'),
(7, 'Chain Leggings'),
(8, 'Iron Boots'),
(9, 'Golden Shield'),
(10, 'Diamond Bow');

-- Inserting data into the Block table
INSERT INTO Block (BlockType, IsCraftable, IsBreakable, Transparency, Texture) VALUES
('Stone', 0, 1, 0, 'rough_gray'),
('Dirt', 0, 1, 0, 'granular_brown'),
('Grass Block', 0, 1, 0, 'textured_green'),
('Cobblestone', 0, 1, 0, 'rugged_gray'),
('Wood Planks', 1, 1, 0, 'smooth_brown'),
('Sand', 0, 1, 0, 'fine_grain_yellow'),
('Gravel', 0, 1, 0, 'coarse_gray'),
('Gold Ore', 0, 1, 0, 'speckled_gold'),
('Iron Ore', 0, 1, 0, 'spotted_rust'),
('Coal Ore', 0, 1, 0, 'black_chunky');


-- Inserting data into the Biome table
INSERT INTO Biome (BiomeName, Rarity) VALUES
('Forest', 'Common'),
('Desert', 'Common'),
('Tundra', 'Rare'),
('Savannah', 'Uncommon'),
('Swamp', 'Uncommon'),
('Taiga', 'Rare'),
('Plains', 'Very Common'),
('Hills', 'Uncommon'),
('Mountains', 'Rare'),
('Ocean', 'Common');

-- Inserting data into the ConsistOf table
INSERT INTO ConsistOf (BlockID, BiomeName, WorldID) VALUES
(1, 'Forest', 1),
(2, 'Desert', 2),
(3, 'Tundra', 3),


