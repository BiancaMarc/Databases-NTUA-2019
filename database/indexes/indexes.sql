CREATE INDEX book_title_year ON book (`title`, `pubyear`);
CREATE INDEX bor_late ON borrows (`date_of_return`, `due_date`);
CREATE INDEX employee_name ON employee (`emplastname`, `empfirstname`);
CREATE INDEX rem_reminder ON reminder (`date_of_reminder`);
