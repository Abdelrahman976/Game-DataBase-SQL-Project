use OnlineGame;
-- go
-- CREATE FUNCTION ViewPlayerDetails(@playerID INT)
-- RETURNS TABLE
-- AS
-- RETURN
-- (
--     SELECT
--         Player.PlayerID,
-- 		Username,
--         Status,
-- 		XCoordinate,
-- 		YCoordinate,
-- 		ZCoordinate,
--         Slot.SlotID,
--         Slot.Quantity,
--         Item.ItemID,
-- 		Name,
-- 		Durability
--     FROM
--         Player, Slot, Item
--     WHERE
--         Player.PlayerID = @playerID and Player.PlayerID = Slot.PlayerID
-- 		and Slot.ItemID = Item.ItemID
-- );
--
-- SELECT * FROM ViewPlayerDetails(1);
CREATE PROCEDURE ViewPlayerDetails(IN playerID INT)
BEGIN
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
END



