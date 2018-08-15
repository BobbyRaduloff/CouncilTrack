# CouncilTrack
Software that allows the ACS student council to keep track of small-item purchases in social events.

# Attributions
Thanks to the people who made Bootstrap.
Created by: Bobby Radulov and Ognian Trajanov.
Idea by: Martin Kirilov.

# Output

First you select the event from a list and then it redirects you to its output page. The information is stored in a database, which automatically calculates the overall information:  money needed for products, profit and money which has been received from students. The output makes it harder for information to get lost. The website gives an output page of overall statistics and a table which consists of a list of students which should receive items and which items they should receive. If a student receives items from different students they will merge in the database and the variables will be recalculated in total.

In order to be easier for the database to be understood it items which have been NOT delivered will be marked in default white and black, items which have been delivered will be marked in green and those which have been problematic (ex. The student wants his money back are marked in red so the staff can sort out their differences).

# Input

The information should be entered as easily possible: A single page with forms large enough not to miss the input you want to enter the needed information as quickly as possible and not to make any mistakes. It should consist of a form that has the student which ought to receive the gifts:

* First name - text
* Last name - text
* Class - text
* list of items- check boxes (calculates money needed automatically and the text of the required amount of money should be clear enough so that it is helpful)
* In the beginning you should choose in which database you want to store the information - a list of events.

# For council administrators

They can:

* create databases for the CouncilTrack;
* Edit information for both input information and also the database values like prices, names, etc. (The server should compile when the items are removed and recalculate when the prices are changed)
* The website should record who entered the information inside of the database
* There should be options where you can mark delivered orders in green, those which have not been delivered in default black and white and those where there is trouble such as the student denying having ordered in red so the council can sort things out with that student or another incident has been caused.

# Sign Up

The users are sorted by their respective permission level:

0. "System Administrator"- Ognian Trajanov and Bobby Radulov - responsible for fixing the website if it crashes and to fix its bugs <also name the school administrator.>
1. "Council Administrator"- Given to the president of the social life committee, can edit database input and information (prices, names, items, etc.); Can erase databases.
2. "User"- Can Input information to specific databases; Can view the final database but not edit it;

Requirements:

* Second Name
* First Name
* Section
* Username
* Password
* **Admin Approval & Account Creation via email**

# Log In

* Username
* Password
* _Note_: When I state database, which the users can view, I mean a generated table with the data of the database, not the actual SQL Database.
* Log In -> Choose between Input and Output -> Choosing The Event -> Input or Output
