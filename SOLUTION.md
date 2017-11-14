SOLUTION
========

Generating a yearly report for each profile by month is not very complicated
task. So app can be upgraded featurewise and codewise. Some nice features that
could be added are - report by profile and sorting by value of sum of views. 

Codewise: code could be more structured. One thing that would be worth working
on is creating Classes that corespond with data structure and mapping them
together. That would increase the readability and more importantly scalability
of code especialy if new features would be added. 

Estimation
----------
Estimated: 5 hours

Spent: 7 hours 


Solution
--------

I had no prior knowledge of Simfony framework, so the majority of time was spent
for getting to know its basics.

     Scenario: get report for year X
       Make SQL query for each month
       Write Monthly data in Yearly array
       Write Yearly data in Profile array
       Structure data that it will be suitable for output report
       Given that there is data for year X

     Scenario: year argument for report generation not given
       Throw exception - year argument is required
       (This means that Not enough arguments exception - is a feature.)

Tests
-----

Check if "n/a" is shown for months without data.

Check if numbers are written with comma delimiting thousands.

Check if leap year is working for year 2016 (which is in database).
