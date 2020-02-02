CREATE TRIGGER `trigg_due_date` 
BEFORE INSERT ON `borrows` 
FOR EACH ROW 
	SET new.due_date = date_add(new.date_of_borrowing, INTERVAL 30 day);

DELIMITER $$
CREATE TRIGGER `perm_trigg` 
BEFORE INSERT ON `permanent` 
FOR EACH ROW 
	IF NEW.empid IN (SELECT empid FROM temporary) 
		THEN SET NEW.empid = NULL; 
	END IF;
$$
DELIMITER ;

/*διαχωριστικό*/

DELIMITER $$
CREATE TRIGGER `temp_trigg`
BEFORE INSERT ON `temporary`
FOR EACH ROW
        IF NEW.empid IN (SELECT empid FROM permanent)
                THEN SET NEW.empid = NULL;
        END IF;
$$
DELIMITER ;