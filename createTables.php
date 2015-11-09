<!--
File: createTables.php
Purpose: n/a
Bugs: n/a
Author: Arron Dick(dickaj1)
Date: 24/10/2015 - 4:31:57 PM
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Create tables</title>
    </head>
    <body>

        <?php

        function do_queries($queries, $dbc) {
            foreach ($queries as $query) {
                echo "$query...<br/>";
                $result = mysqli_query($dbc, $query) or die("Couldn't add informtation to database: " . mysqli_error($dbc));
                echo "done...<br/><br/>";
            }
        }

        function encrypt($password) {
            //A higher "cost" is more secure but consumes more processing power
            $cost = 10;

            //Create a random salt
            $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_RANDOM)), '+', '.');

            //Prefix information about the hash so PHP knows how to verify it later.
            //"$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
            $salt = sprintf("$2a$%02d$", $cost) . $salt;

            //Hash the password with the salt and return
            return crypt($password, $salt);
        }

        //Get connection parameters
        require_once("scripts/connectvars.php");

        //Connect to database
        //Skip selecting schema by default, as it may not exist yet!
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Couldn't connect to server: " . mysqli_error());

        //Database schema name
        $schema = DB_NAME;

        //Drop old database
        $queries[0] = "DROP SCHEMA IF EXISTS `$schema`";

        //Create schema
        $queries[1] = "CREATE SCHEMA IF NOT EXISTS `$schema`";

        //Use schema
        $queries[2] = "USE `$schema`";

        //Create tbl_user
        $queries[4] = "CREATE TABLE IF NOT EXISTS `tbl_user` 
            (`user_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
            `username` VARCHAR(45) NOT NULL COMMENT '',
            `fullName` VARCHAR(45) NOT NULL COMMENT '',
            `email` VARCHAR(100) NOT NULL COMMENT '',
            `birthDate` DATE NULL COMMENT '',
            `password` VARCHAR(100) NOT NULL COMMENT '',
            `image` VARCHAR(100) NULL DEFAULT 'noimage.png' COMMENT '',
            `description` VARCHAR(3000) NULL COMMENT '',
            PRIMARY KEY (`user_id`)  COMMENT '',
            UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC)  COMMENT '',
            UNIQUE INDEX `username_UNIQUE` (`username` ASC)  COMMENT '')
            ENGINE = InnoDB;";

        //Create tbl_category
        $queries[5] = "CREATE TABLE IF NOT EXISTS `tbl_category` (
            `category_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
            `description` VARCHAR(45) NOT NULL COMMENT '',
            PRIMARY KEY (`category_id`)  COMMENT '',
            UNIQUE INDEX `category_id_UNIQUE` (`category_id` ASC)  COMMENT '',
            UNIQUE INDEX `description_UNIQUE` (`description` ASC)  COMMENT '')
            ENGINE = InnoDB;";

        //Create tbl_item
        $queries[6] = "CREATE TABLE IF NOT EXISTS `tbl_item` (
            `item_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
            `user_id` INT NOT NULL COMMENT '',
            `category_id` INT NOT NULL COMMENT '',
            `amount` DECIMAL(19,2) NOT NULL COMMENT '',
            `comment` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
            `date` DATE NOT NULL COMMENT '',
            PRIMARY KEY (`item_id`)  COMMENT '',
            UNIQUE INDEX `item_id_UNIQUE` (`item_id` ASC)  COMMENT '',
            INDEX `item_user_idx` (`user_id` ASC)  COMMENT '',
            INDEX `fk_category_item_idx` (`category_id` ASC)  COMMENT '',
            CONSTRAINT `fk_user_item`
                FOREIGN KEY (`user_id`)
                REFERENCES `tbl_user` (`user_id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
            CONSTRAINT `fk_category_item`
                FOREIGN KEY (`category_id`)
                REFERENCES `tbl_category` (`category_id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE)
            ENGINE = InnoDB;";

        do_queries($queries, $dbc);

        //Create sample data
        //Add users
        $queries[0] = "INSERT INTO `tbl_user` (`user_id`, `username`, `fullName`, `email`, `birthDate`, `password`) 
                VALUES (1,'dale','Dale Parsons','dale@op.ac.nz','2000-01-01','".encrypt("test")."')";
        
        $queries[1] = "INSERT INTO `tbl_user` (`user_id`, `username`, `fullName`, `email`, `birthDate`, `password`) 
                VALUES (2,'dickaj1','Arron Dick','dickaj1@student.op.ac.nz','1985-02-27','".encrypt("test")."')";
        
        $queries[2] = "INSERT INTO `tbl_user` (`user_id`, `username`, `fullName`, `email`, `birthDate`, `password`) 
                VALUES (3,'neilg2','Greg Neilson','neilg2@student.op.ac.nz','2000-01-01','".encrypt("test")."')";

        do_queries($queries, $dbc);

        //Add categories
        $queries[0] = "INSERT INTO `tbl_category` VALUES (1,'Junk food')";
        $queries[1] = "INSERT INTO `tbl_category` VALUES (2,'Alcohol')";
        $queries[2] = "INSERT INTO `tbl_category` VALUES (3,'Groceries')";
        $queries[3] = "INSERT INTO `tbl_category` VALUES (4,'Tobacco')";
        $queries[4] = "INSERT INTO `tbl_category` VALUES (5,'Lunch')";
        $queries[5] = "INSERT INTO `tbl_category` VALUES (6,'Gambling')";
        $queries[6] = "INSERT INTO `tbl_category` VALUES (7,'Toys and Games')";
        $queries[7] = "INSERT INTO `tbl_category` VALUES (8,'Entertainment')";
        $queries[8] = "INSERT INTO `tbl_category` VALUES (9,'Other')";

        do_queries($queries, $dbc);

        //Add items
        //TODO: Edit dates so the date entered is always for the current weeek!
        //
        //Items for Arron

        $queries[0] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '4', '24', '2015-10-19')";
        $queries[1] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '3', '12.62', '2015-10-19')";
        $queries[2] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '6', '5', '2015-10-19')";
        $queries[3] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '3', '27.53', '2015-10-20')";
        $queries[4] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '7', '16', '2015-10-20')";
        $queries[5] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '4', '82.74', '2015-10-21')";
        $queries[6] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '5', '11', '2015-10-22')";
        $queries[7] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '5', '4.3', '2015-10-22')";
        $queries[8] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '7', '40', '2015-10-23')";
        $queries[9] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '5', '5.1', '2015-10-23')";
        $queries[10] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '1', '10', '2015-10-24')";
        $queries[11] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '8', '10', '2015-10-24')";
        $queries[12] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '5', '3.9', '2015-10-25')";
        //Items for Greg
        $queries[13] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '5', '14', '2015-10-19')";
        $queries[14] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '5', '11.9', '2015-10-19')";
        $queries[15] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '4', '75.4', '2015-10-20')";
        $queries[16] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '3', '42.76', '2015-10-20')";
        $queries[17] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '3', '20.23', '2015-10-21')";
        $queries[18] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '3', '3.8', '2015-10-22')";
        $queries[19] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '5', '3', '2015-10-22')";
        $queries[20] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '5', '4.3', '2015-10-22')";
        $queries[21] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '1', '3', '2015-10-23')";
        $queries[22] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '3', '2', '2015-10-23')";
        $queries[23] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '6', '12', '2015-10-24')";
        $queries[24] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '3', '6.35', '2015-10-24')";
        $queries[25] = "INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('3', '1', '13.6', '2015-10-25')";
        //test for current day
        $queries[26]="INSERT `tbl_item` (`user_id`, `category_id`, `amount`, `date`) VALUES ('2', '1', '13.6', '2015-11-05')";

        do_queries($queries, $dbc);

        echo "All queries finished";
        ?>
    </body>
</html>