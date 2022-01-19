/*Insert the following new client to the clients table (Note: The clientId and clientLevel fields should handle their own values and do not need to be part of this query.):
Tony, Stark, tony@starkent.com, Iam1ronM@n, "I am the real Ironman"*/

Insert Into clients (clientFirstname, clientLastname, clientEmail,clientPassword, clientLevel,comment) 
Values ('Tony','Stark', 'tony@starknet.com','Iam1ronM@n',1,'I am the real Ironman');

/*Modify the Tony Stark record to change the clientLevel to 3. The previous insert query will have to have been stored in the database for the update query to work.*/

UPDATE clients
SET clientLevel = 3
WHERE
	clientLevel = 1;

/*Modify the "GM Hummer" record to read "spacious interior" rather than "small interior" using a single query. Explore the SQL Replace function. It needs to be part of an Update query as shown in the code examples of the SQL Reading - Read Ch. 1, section 3.*/

UPDATE inventory
SET invDescription = 'Do you have 6 kids and like to go off-roading? The Hummer gives you the spacious interiors with an engine to get you out of any muddy or rocky situation.'
WHERE invMake = 'GM' AND invModel = 'Hummer';

/*Use an inner join to select the invModel field from the inventory table and the classificationName field from the carclassification table for inventory items that belong to the "SUV" category. (These resources may help you: https://www.w3schools.com/sql/sql_join.asp and https://www.youtube.com/watch?v=0FEjw2HnfDs) Four records should be returned as a result of the query.*/

SELECT inventory.classificationId, carclassification.classificationName, inventory.invModel
FROM inventory
INNER JOIN carclassification ON inventory.classificationId=carclassification.classificationId
WHERE classificationName='SUV';

/*Delete the Jeep Wrangler from the database. [Note: You can restore the Inventory table by importing the SQL file that was used to create it again].*/

DELETE FROM inventory WHERE invMake='Jeep' AND invModel='Wrangler';

/*Update all records in the Inventory table to add "/phpmotors" to the beginning of the file path in the invImage and invThumbnail columns using a single query. These references may prove helpful - SQL Update, SQL Concat().*/

UPDATE inventory
SET invImage = concat('/phpmotors', invImage), invThumbnail= concat('/phpmotors', invThumbnail);