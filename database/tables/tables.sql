CREATE TABLE `author` (
  `authid` int NOT NULL AUTO_INCREMENT,
  `authlastname` varchar(45) NOT NULL,
  `authfirstname` varchar(45) NOT NULL,
  `authbirthdate` date DEFAULT NULL,
  PRIMARY KEY (`authid`),
  CONSTRAINT `auth_un` UNIQUE (`authlastname`, `authfirstname`, `authbirthdate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `publisher` (
  `pubname` varchar(50) NOT NULL,
  `estyear` year(4) NOT NULL,
  `pubstreet` varchar(45) NOT NULL,
  `pubnumber` smallint NOT NULL,
  `pubpostcode` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`pubname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `book` (
  `ISBN` varchar(17) NOT NULL,
  `title` varchar(100) NOT NULL,
  `pubyear` year(4) NOT NULL,
  `numpages` smallint NOT NULL,
  `pubname` varchar(50) NOT NULL,
  PRIMARY KEY (`ISBN`),
  /*UNIQUE KEY `USBN_UNIQUE` (`ISBN`),*/
  /*KEY `pub_book` (`pubname`),*/
  CONSTRAINT `pub_book` FOREIGN KEY (`pubname`) REFERENCES `publisher` (`pubname`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `copy` (
  `ISBN` varchar(17) NOT NULL,
  `copynr` smallint NOT NULL AUTO_INCREMENT,
  `shelf` varchar(10) NULL,
  PRIMARY KEY (`copynr`,`ISBN`),
  /*UNIQUE KEY `copynr_UNIQUE` (`copynr`),*/
  /*KEY `ISBN_idx` (`ISBN`),*/
  CONSTRAINT `ISBN` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `written_by` (
  `ISBN` varchar(17) NOT NULL,
  `authid` int NOT NULL,
  PRIMARY KEY (`ISBN`,`authid`),
  /*KEY `fk_book_has_author_author1_idx` (`author_authid`),
  KEY `fk_book_has_author_book1_idx` (`book_ISBN`),*/
  CONSTRAINT `written_book` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `written_author` FOREIGN KEY (`authid`) REFERENCES `author` (`authid`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `category` (
  `catname` varchar(50) NOT NULL,
  `maincatname` varchar(50),
  PRIMARY KEY (`catname`),
  CONSTRAINT `cat_fk` FOREIGN KEY (`maincatname`) REFERENCES `category` (`catname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `member` (
  `memid` int NOT NULL AUTO_INCREMENT,
  `memfirstname` varchar(45) NOT NULL,
  `memlastname` varchar(45) NOT NULL,
  `membirthdate` date NOT NULL,
  `memstreet` varchar(45) NOT NULL,
  `memnr` smallint NOT NULL,
  `mempostcode` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`memid`),
  CONSTRAINT `mem_un` UNIQUE (`memlastname`, `memfirstname`, `membirthdate`)
  /*UNIQUE KEY `memid_UNIQUE` (`memid`)*/
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `employee` (
  `empid` int NOT NULL AUTO_INCREMENT,
  `salary` int NOT NULL,
  `emplastname` varchar(45) NOT NULL,
  `empfirstname` varchar(45) NOT NULL,
  PRIMARY KEY (`empid`)
  /*UNIQUE KEY `empid_UNIQUE` (`empid`)*/
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `permanent` (
  `empid` int NOT NULL,
  `hiringdate` date NOT NULL,
  PRIMARY KEY (`empid`),
  CONSTRAINT `empidperm` FOREIGN KEY (`empid`) REFERENCES `employee` (`empid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `temporary` (
  `empid` int NOT NULL,
  `contractnr` varchar(20) NOT NULL,
  PRIMARY KEY (`empid`),
  CONSTRAINT `empidtemp` FOREIGN KEY (`empid`) REFERENCES `employee` (`empid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `belongs_to` (
  `ISBN` varchar(17) NOT NULL,
  `catname` varchar(50) NOT NULL,
  PRIMARY KEY (`ISBN`,`catname`),
  /*KEY `fk_book_has_category_category1_idx` (`category_catname`),
  KEY `fk_book_has_category_book1_idx` (`book_ISBN`),*/
  CONSTRAINT `book_bel` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cat_bel` FOREIGN KEY (`catname`) REFERENCES `category` (`catname`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `borrows` (
  `memid` int NOT NULL,
  `copynr` smallint NOT NULL,
  `ISBN` varchar(17) NOT NULL,
  `date_of_borrowing` date NOT NULL,
  `date_of_return` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  PRIMARY KEY (`memid`,`copynr`,`ISBN`,`date_of_borrowing`),
  /*KEY `fk_member_has_copy_copy1_idx` (`copy_copynr`,`copy_ISBN`),
  KEY `fk_member_has_copy_member1_idx` (`member_memid`),*/
  CONSTRAINT `mem_borrows` FOREIGN KEY (`memid`) REFERENCES `member` (`memid`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `mem_book` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `copy_borrows` FOREIGN KEY (`copynr`, `ISBN`) REFERENCES `copy` (`copynr`, `ISBN`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `reminder` (
  `empid` int NOT NULL,
  `memid` int NOT NULL,
  `ISBN` varchar(17) NOT NULL,
  `copynr` smallint NOT NULL,
  `date_of_borrowing` date NOT NULL,
  `date_of_reminder` date NOT NULL,
  PRIMARY KEY (`empid`,`memid`,`ISBN`,`copynr`,`date_of_borrowing`,`date_of_reminder`),
  /*KEY `rem_borrow` (`memberid`,`copynr`,`rem_ISBN`,`date_of_borrowing`),
  KEY `rem_copy` (`rem_ISBN`,`copynr`),*/
  CONSTRAINT `fk_reminder_1` FOREIGN KEY (`empid`) REFERENCES `employee` (`empid`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `rem_borrow` FOREIGN KEY (`memid`, `copynr`, `ISBN`, `date_of_borrowing`) REFERENCES `borrows` (`memid`, `copynr`, `ISBN`, `date_of_borrowing`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `rem_isbn` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `rem_mem` FOREIGN KEY (`memid`) REFERENCES `member` (`memid`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `rem_copy` FOREIGN KEY (`copynr`, `ISBN`) REFERENCES `copy` (`copynr`, `ISBN`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;