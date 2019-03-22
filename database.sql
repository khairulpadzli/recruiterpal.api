CREATE SCHEMA `api_db` ;

CREATE TABLE `tbl_candidate` (
 `email` varchar(45) NOT NULL,
 `firstName` varchar(45) DEFAULT NULL,
 `lastName` varchar(45) DEFAULT NULL,
 `job_id` int(11) DEFAULT NULL,
 `status` int(11) DEFAULT '1',
 `recruiter` varchar(45) DEFAULT NULL,
 PRIMARY KEY (`email`)
);

CREATE TABLE `tbl_job` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
)

INSERT INTO tbl_candidate 
	VALUES('khairul.padzli@gmail.com', 'Mohamad', 'Khairul Padzli', 1, 1, 'khairul.padzli@hotmail.com');
	
INSERT INTO tbl_job (job_title) VALUES('Software Engineer');
INSERT INTO tbl_job (job_title) VALUES('Senior Software Engineer');