# Game Database Project

## Overview

This repository contains the SQL schema and associated PHP scripts for a game database project. The database is designed to manage and store data related to a virtual game world, including information about players, mobs (mobile characters), items, and food. The project also includes stored procedures and views to facilitate data management and retrieval.

## Database Schema

The database includes the following tables:

- **Player**: Stores data about players, including their coordinates within the game world and status.
- **World**: Contains details about different worlds within the game, such as creation time and last accessed time.
- **Mob**: Manages data on mobile characters (mobs), including their health, type, and behavior.
- **Item**: Holds information about various items that can be found or used within the game.
- **Food**: Lists different types of food items available in the game, detailing their effect on player health or status.
- **Tool**: Records data about tools that players can use within the game, including their durability and damage.

### Special Features

- **Stored Procedures**: Include procedures to fetch players by world, move players between worlds, and list mobs not in a specified world.
- **Triggers**: A trigger to update the `LastAccessed` time of a world when a player is moved to that world.
- **Views**: Views are set up to easily access complex data, such as mobs and the items they drop.
