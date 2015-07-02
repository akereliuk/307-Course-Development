CREATE TABLE Enrollment
(
	EnrolleeID INT(11) NOT NULL AUTO_INCREMENT,
	LastName VARCHAR(45) NOT NULL,
	FirstName VARCHAR(45) NOT NULL,
	Birthdate DATE NOT NULL,
	PhoneNumber VARCHAR(15) NOT NULL,
	Address VARCHAR(45) NOT NULL,
	DateEnrolled DATE NOT NULL, 
	CONSTRAINT EnrolleeID_pk PRIMARY KEY (EnrolleeID)
);

CREATE TABLE ConferenceRoomBooking
(
	MeetingID INT(11) NOT NULL AUTO_INCREMENT,
	MeetingName VARCHAR(45) NOT NULL,
	Description VARCHAR(150) NULL,
	Department ENUM('Information Systems', 'Administration', 'Infrastructure Support', 'Finance', 'Human Resources') NULL,
	StartDate DATE NOT NULL,
	EndDate DATE NOT NULL,
	BookedBy VARCHAR(45) NOT NULL, 
	CONSTRAINT MeetingID_pk PRIMARY KEY (MeetingID)
);

CREATE TABLE Menu
(
	ItemID INT(11) NOT NULL AUTO_INCREMENT,
	ItemName VARCHAR(45) NOT NULL,
	Description VARCHAR(150) NULL,
	FoodType ENUM('Appetizer', 'Dessert', 'Beverage', 'Fish', 'Meat', 'Soup & Salad', 'Sandwich', 'Pasta') NOT NULL,
	Price DOUBLE NOT NULL,
	Spicyness ENUM('N/A', 'Mild', 'Medium', 'Hot', 'Very Hot') NOT NULL DEFAULT 'N/A',
	Kosher TINYINT(1) NOT NULL DEFAULT 0, 
	CONSTRAINT ItemID_pk PRIMARY KEY (ItemID)
);