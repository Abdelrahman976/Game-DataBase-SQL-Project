CREATE TRIGGER check_slot_limit
ON Slot
INSTEAD OF INSERT
AS
BEGIN
    -- Declare a variable to store the count of slots
    DECLARE @slot_count INT;

    -- Calculate the number of existing slots for the player trying to add a new slot
    SELECT @slot_count = COUNT(*)
    FROM Slot
    WHERE PlayerID = (SELECT PlayerID FROM inserted);

    -- Check if the player already has 3 slots
    IF @slot_count >= 3
    BEGIN
        RAISERROR('Each player can have only up to 3 slots.', 16, 1);
        RETURN;
    END;

    -- If not exceeding limit, insert the row into Slot table
    INSERT INTO Slot(SlotID, Quantity, PlayerID, ItemID)
    SELECT SlotID, Quantity, PlayerID, ItemID FROM inserted;
END;
