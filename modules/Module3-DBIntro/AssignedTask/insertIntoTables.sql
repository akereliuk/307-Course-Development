INSERT INTO Enrollment (LastName, FirstName, Birthdate, PhoneNumber, Address, DateEnrolled)
VALUES
("Lopez", "Vera", "1936-04-28", "701-738-7164", "522 Hidden Meadow Drive", "2015-06-29"),
("Kitt", "Josie", "1960-03-19", "843-373-7326", "837 Kessla Way", "2015-06-15"),
("Sanchez", "Colleen", "1956-01-04", "339-645-1592", "4196 Hillside Drive", "2015-06-12"),
("Cook", "Luigi", "1975-03-10", "310-588-2171", "2204 Sumner Street", "2015-05-28"),
("Carson", "Carolyn", "1969-01-17", "786-429-6417", "2431 Rinehart Road", "2015-06-08");

INSERT INTO ConferenceRoomBooking (MeetingName, Description, Department, StartDate, EndDate, BookedBy)
VALUES
("Corporate Quarterly Review", "Discuss Company Finances and review quarter", "Finance", "2014-11-20 10:00:00", "2014-11-20 13:00:00", "John Smith"),
("HR Weekly Review", NULL, "Human Resources", "2015-08-13 09:15:00", "2015-08-13 09:45:00", "Janet Wilson"),
("Infrastructure New Project", "Brainstorm the new upcoming project", "Infrastructure Support", "2015-10-03 15:00:00", "2015-10-03 17:00:00", "Marshall Hansen"),
("Office Cleanup Group Meeting", "Get the cleanup group together and discuss plans", NULL, "2013-03-17 11:00:00", "2013-03-17 11:30:00", "Bobby Clean"),
("Interviews for New Developer Position", "Booking conference room for Developer interviews", "Information Systems", "2015-04-28 13:00:00", "2015-04-28 17:00:00", "Rachel Tanith");

INSERT INTO Menu (ItemName, Description, FoodType, Price, Spicyness, Kosher)
VALUES
("Caesar Salad", "Boneless chicken, Romaine lettuce, Parmesan cheese, croutons tossed with Caesar dressing", "Soup & Salad", 2.99, "N/A", 1),
("French Fries", "Deep fried french fries lightly salted and served with special sauce", "Appetizer", 2.99, "N/A", 1),
("Beef Tenderloin", "Savory beef tenderloin with mustard-herb crust", "Meat", 11.00, "N/A", 0),
("Spicy Boneless Wings", "6 boneless wings with your choice of hot sauce", "Meat", 8.99, "Hot", 0),
("Tiramisu", "Classic Italian dessert cooked with rum, drizzled with chocolate powder", "Dessert", 5.99, "N/A", 0);