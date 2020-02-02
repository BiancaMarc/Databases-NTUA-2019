/*Updatable view*/

CREATE VIEW `copy_view` AS
SELECT ISBN, copynr
FROM copy;

/*Non-updatable view*/

CREATE VIEW `books_borrowed_per_day` AS
SELECT COUNT(copynr) AS Books_Borrowed, date_of_borrowing
FROM borrows
GROUP BY date_of_borrowing;