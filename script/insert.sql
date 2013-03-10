SELECT * FROM girl;


(
	SELECT girlid,COUNT(usrid) AS num
	FROM record
	GROUP BY usrid
)


INSERT INTO `ifso_girls`.`girl` 
(`usrid`, `name`, `path`)
VALUES (0, 'Lily', '1.jpg');
INSERT INTO `ifso_girls`.`girl` 
(`usrid`, `name`, `path`)
VALUES (0, 'Jassic', '2.jpg');
INSERT INTO `ifso_girls`.`girl` 
(`usrid`, `name`, `path`)
VALUES (0, 'Halen', '3.jpg');
INSERT INTO `ifso_girls`.`girl` 
(`usrid`, `name`, `path`)
VALUES (0, 'Fion', '4.jpg');

`girlid`