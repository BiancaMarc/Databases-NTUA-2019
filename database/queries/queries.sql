/*1st Query(aggregate)*/

SELECT AVG(E.salary)
FROM employee AS E, permanent AS P
WHERE E.empid=P.empid;

SELECT AVG(E.salary)
FROM employee AS E, temporary AS T
WHERE E.empid=T.empid;

/*2nd Query(aggregate)*/

SELECT COUNT(*) AS Total_Members
FROM member;

/*3rd Query(order by)*/

SELECT M.memid, M.memlastname, M.memfirstname
FROM member AS M, borrows AS B
WHERE M.memid=B.memid AND (B.due_date<B.date_of_return OR B.date_of_return IS NULL)
ORDER BY M.memlastname;

/*4th Query(group by)*/

SELECT C.ISBN, B.title, A.authlastname, A.authfirstname, B.pubname
FROM borrows AS BR, copy AS C, book AS B, author AS A, written_by AS W
WHERE B.ISBN=C.ISBN AND C.ISBN=BR.ISBN AND C.copynr=BR.copynr 
      AND BR.date_of_return IS NOT NULL AND A.authid=W.authid 
	    AND W.ISBN=C.ISBN
GROUP BY B.title;

/*5th Query(group by-having)*/

SELECT M.memid, M.memlastname, M.memfirstname
FROM member AS M, borrows AS B
WHERE M.memid=B.memid AND B.date_of_return IS NULL
GROUP BY memid
HAVING COUNT(*)=5
ORDER BY memlastname;

/*6th Query(inner joins)*/

SELECT B.ISBN, B.title, C.copynr, B.pubyear, B.numpages, A.authlastname, A.authfirstname, B.pubname, Cat.catname
FROM book B 
     INNER JOIN copy C ON C.ISBN=B.ISBN 
     INNER JOIN belongs_to BT ON BT.ISBN=C.ISBN
     INNER JOIN category Cat ON Cat.catname=BT.catname
     INNER JOIN written_by WB ON WB.ISBN=B.ISBN
     INNER JOIN author A ON A.authid=WB.authid
ORDER BY B.title;
     
/*7th Query(inner joins+left join)*/    

SELECT M.memid, M.memlastname, M.memfirstname, B.ISBN, B.title, C.copynr, BR.date_of_borrowing, R.date_of_reminder, BR.due_date
FROM member M
	 INNER JOIN borrows BR ON BR.memid=M.memid
     INNER JOIN book B ON B.ISBN=BR.ISBN
     INNER JOIN copy C ON C.ISBN=B.ISBN 
     LEFT JOIN reminder R ON R.memid=M.memid     
WHERE BR.date_of_return IS NULL
GROUP BY M.memlastname;

/*8th Query(nested query)*/

SELECT empid, emplastname, empfirstname
FROM employee
WHERE salary<1500 AND empid NOT IN (SELECT DISTINCT empid
                            FROM reminder);