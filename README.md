Backend Developer Test
======================
The Business of Fashion uses various tests to assess whether a candidate is best suited to the expectations of the role advertised and the offer given.

This test aims to demonstrate your technical skills in practice: that you can deliver a solution which implements a scalable backend architecture, that produces the right results, and that pays attention to the requirement details.

Instructions & Deliverables
---------------------------

1. Fork this repository to your account (https://help.github.com/articles/fork-a-repo/)
1. Read these instructions carefully first before continuing with the practical test
2. Read the Requirements / Story Definition and Conditions of Acceptance
3. Identify and write at least 5 test cases (no code necessary; Gherkin or a written list will suffice)
    - Demonstrate your understanding of the Conditions of Acceptance
    - Identify any appropriate edge cases
4. Implement the Story's functionality using the ReportYearlyCommand.php file
    - Develop a solution which demonstrates your skills and strengths
    - You may add/change/modify any files in the project
    - You may use any tool to review/modify the associated database
    - You may use any google or other references for mysql/php syntax queries
5. Describe how you can build a better "Product" for this coding task in SOLUTION.md and include your estimates
7. Create a pull request to origin repository when you are satisfied with your solution (https://help.github.com/articles/about-pull-requests/) 


Other Notes
-----------

- You may modify the database accordingly, however, please mention what you have done
- This is not a full Symfony framework app so some components are missing - you can add any components you might need 
- Please remember to demonstrate your skills and how you would  normally approach
development tasks regardless of this smaller task size.
- I must ask that you time yourself so that you balance Quality and Delivery. I will not prescribe a
deadline of X hours, instead, I would like you estimate the task, complete the task, and measure your elapsed time. Please submit your estimate and actual time with your code solution.


Requirements / Story Definitions
================================

So that I can have visibility on profile performance, as a Business Analyst, I want to report the monthly views for each profile.
CONDITIONS OF ACCEPTANCE (COA's)

``` gherkin
GIVEN that there is historical data available
WHEN I execute the Yearly Views report
THEN I expect to see a monthly breakdown of the total views per profiles

GIVEN that there is historical data available
WHEN I view the Yearly Views report
THEN I expect to have the profiles names listed in alphabetical order

GIVEN that there is historical data available
WHEN I view the Yearly Views report
THEN I expect to see "n/a" when data is not available

```

Technical Setup
===============


1. On the command prompt, run:

    $> cd /path/to/the/test/folder

    $> mysql -uroot -p < setup.sql
  
    This can be used to reset the entire database if required.
    
    $> composer install

2. Ensure the database schema and user is setup as per setup.sql

3. Execute the test:data:reset command to add the required data for the test:

    $> bin/console test:data:reset

4. Execute the report:profiles:yearly command to see a sample output and test the environment:

    $> bin/console report:profiles:yearly

    You should see a list of items in the databases


Example Output
--------------

``` 
+---------------------+---------+---------+---------+---------+---------+---------+---------+---------+---------+---------+---------+---------+
| Profile        2008 | Jan     | Feb     | Mar     | Apr     | May     | Jun     | Jul     | Aug     | Sep     | Oct     | Nov     | Dec     |
+---------------------+---------+---------+---------+---------+---------+---------+---------+---------+---------+---------+---------+---------+
| Karl Lagerfeld      | 480,473 | 463,351 | 532,346 | 465,007 | 521,620 | 491,639 | 533,723 | 517,978 | 543,445 | 484,934 | 476,251 | 495,360 |
| Anna Wintor         | 507,203 | 508,857 | 538,266 | 494,497 | 452,481 | 441,739 | 502,678 | 514,375 | 484,821 | 510,688 | 493,846 | 501,483 |
| Tom Ford            | 536,575 | 469,248 | 524,297 | 492,777 | 488,485 | 511,724 | 483,425 |  34,670 | 496,402 | 528,325 | 504,403 | 507,595 |
| Pierre Alexis Dumas | 514,707 | 466,740 | 517,315 | 472,719 | 519,206 | 475,285 | 508,163 | 502,462 | 514,564 | 511,195 | 524,600 | 495,845 |
| Sandra Choi         | 528,838 | 498,999 | 502,382 | 510,503 | 517,367 | 492,643 | 517,876 | 545,373 | 492,309 | 598,763 | 503,187 | 516,981 |
+---------------------+---------+---------+---------+---------+---------+---------+---------+---------+---------+---------+---------+---------+
``` 
