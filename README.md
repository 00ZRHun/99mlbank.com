# 99mlbank.com

## Setup

PHP Version: 8.0

## Credential

https://99mlbank.com
Username: masteradmin
Password: 123456789

## Database

# login MySQL - METHOD 1

(base) ZRHuns-MacBook-Pro:~ zrhun$ mysql -u zrhun -p
Enter password:
(password)
Welcome to the MySQL monitor. Commands end with ; or \g.
Your MySQL connection id is 20
Server version: 8.0.32 Homebrew

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql>

# login MySQL - METHOD 2

(base) ZRHuns-MacBook-Pro:~ zrhun$ sudo mysql
Password:
Welcome to the MySQL monitor. Commands end with ; or \g.
Your MySQL connection id is 28
Server version: 8.0.32 Homebrew

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql>

# select & connect database

mysql> SHOW DATABASES;
+--------------------+
| Database |
+--------------------+
| ecadmin_99mlbank |
| ecadmin_crm |
| hthcella_ams |
| information_schema |
| mydoclabbe_old |
| mysql |
| performance_schema |
| sys |
+--------------------+
8 rows in set (0.01 sec)

mysql> USE ecadmin_99mlbank

## Modules

- 1st chkbox - task
- 2nd chkbox - testing

1. Login

   - [x] clone layout
   - [x] add login function
   - [x] filter active status for 'users' only
   - [x] popup err msg if Username or Password is wrong or user inactive
   - [x] prevent to access other pages if haven't login yet
   - [x] add logout function

2. Header

   - [x] add logout function
   - [] change password

3. Home

   - [x] clone layout

**- Dasshboard**

4. User-management

   - [x][x] clone layout
   - [x][x] list users
     - [.../] filter by upline
   - [x][x] create user
   - [x][x] filter available username only (popup err msg if Username is taken)
   - [x][x] view user
   - [x][x] edit user
   - [][] fix wording switch between create & edit (title & msg)
   - [x][x] inactive / active user
   - [x][x] reset password
   - [x][x] search user
   - [][] filter user by date
   - [][] resolve dummy data under user-view
   - [] Approved
   - [] Others

========================= 5. Rent Pay

- [x][x] clone layout for rent pay
- [x][x] create rent table & insert dummy data by sql script
- [x][x] list rent pay
- [x][x] create rent
  - filter active user only
- [x][x] edit rent pay
- [x][x] delete rent pay

6. Expenses
   - [x][x] clone layout for expenses
   - [x][x] create expenses table & insert dummy data by sql script
   - [x][x] list expenses
   - [x][x] create expenses
   - [x][x] edit expenses
   - [x][x] delete expenses

======

- Customers Settings

  - [x] clone layout for customer
  <!-- - [x] create customer table & insert dummy data by sql script -->
  - [x] list customers
  - [x] create customer
  - [x] edit customer
  - [x] reset password for customer
  - [x] inactive / activate customer
  - [x] search customer
  - [x] clone layoput for view customer
  - [x] view customer
  - [] resolve dummy data under customer-view
    - [y] do calculation & display result
      - [y] filter non-cased card
    - [] Cards
      - [x] list rent card
        - [x] filter customer's rent card
        - [x] filter non-cased rent card
        - [...] fix including cased card
      - [x] assign card / create rent card
        - [x] list cards ({card_name} - {bank_name})
          - [x] filter non-used rent card (/filter out rented card)
      - [x] edit rent card
      - [x] delete rent card
      - [.../] rent ended for end card
        - TEMP CMT
      - [.../] remove this month for end card
        - TEMP CMT
    - [y] Invoices
      - [y] generate (invoice nombor)
      - [x] list invoices
      - [o] edit invoices
      - [o] delete invoices (???)
    - [] Payments
      - [x] add payment (pay)
      - [x] list payments
        - [] blocking condition (DOUBLE CHK: rent up until May, can't add June)
      - [x] delete payment
    - [x] Cases
      - [x] case rent card
        - [x] list cased rent card

- customer-view (Access level: customer only)
  - [x] clone layout for customer-view
  - [.../] view user
  - [.../] do calculation & display result
  - [] resolve dummy data under customer-view
    - [x] Cards
      - [x] list rent card
        - [x] filter customer's rent card
        - [x] filter non-cased rent card
      - [x] view card details
    - [] Invoices
      - [o] list invoices
      - [.../] view invoice
    - [x] Payments
      - [x] list payments
    - [x] Cases
      - [x] list cased rent card
- header
  - [o] switch diff side-menu based on user role of Masteradmin
  - [o] switch diff side-menu based on user role of Superadmins
  - [o] switch diff side-menu based on user role of Customer
  - [o] set name
  - [o] set username

**- Cards Settings**
**- Users Settings**

- Banks Settings

  - [x] clone layout for bank
  - [x] create bank table & insert dummy data by sql script
  - [x] list banks
  - [x] create bank
  - [x] edit bank
  - [x] delete bank

- Announcement
  - [x] clone layout for announcement
  - [x] create announcement table & insert dummy data by sql script
  - [x] list announcements
  - [x] active / inactive announcement
    - [x] can active one announcement only
  - [x] create announcement
  - [x] edit announcement
  - [x] delete announcement
  - [x] link announcement to header (show if have active announcement else hide)

**- My Cards**

- My Cards > Card Details

  - [x] clone layout for Card Details
  - [x] create card table & insert dummy data by sql script
  - [x] list cards
    - [.../] filter by created_by
    - [.../] filter by non cased
    - [] TODO: handle logic when has >1 record from rc (can rent aft rent)
    - [] TODO: role agent
  - [x] create cards
  - [x] edit cards
    - [] set null if empty input (FINDING SOLUTION)
  - [y] approve cards
  - [.../] view rent for card
  - [y] display 'Total Cards', 'Total Cost', 'Approved Cards', 'Rent Count' & 'Rent Cost'
    - [.../] filter by created_by
      ///
  - [] resolve all "select > option" to dynamic
  - [] resolve all "https://bankcardsample.system1906.com" to ours

- Cards Settings > All Cards

  - [y] clone layout for All Cards
  - [y] list cards for 'Waiting Approval'
  - [z] list cards for 'Rejected'
  - [z] list cards for 'Case'
  - [y] list cards for 'Approved'
    - [] view rent for card (DUMMY DATA)
    - [z] edit for card
    - [z] reject for card
    - [z] approve for card
    - [z] case for card

- Access Level Control

  - [] Superadmins
  - [] customer
    - [] customer-view page
  - [] admin, Admins
    - [] User Management module
    - [] My Cards module
  - [] Agents

=== LATER ===

- [.../] Dashboard

  - TEMP CMT

  - [] clone layout for Dashboard
  - [] do calculation & display result

- [] Design new layout

  - <!-- TODO: chk data for 'Card Cost (RM)' in edit model of 'Waiting of Approval' & 'Approved'  -->

  <!-- TODO -->

  - view rent
  - edit > card cost
  - export & import card tbl
    INSERT INTO `card` (`id`, `bank_id`, `card_name`, `ic`, `online_user_id`, `online_password`, `atm_password`, `account_no`, `otp_no`, `card_no`, `address_of_bank`, `secure_word`, `gmail_of_bank`, `home_address`, `mother_name`, `token_key`, `monthly_cost`, `status`, `created_by`, `created_at`, `rejected_by`, `rejected_at`, `reject_remarks`, `cased_by`, `cased_at`, `case_remarks`, `approved_by`, `approved_at`) VALUES
    (9, 1, 'TESTING Name', '123456-71-8901', 'ABC123', 'OnlinePassword', 'AtmPassword', 'A123456B', '123456', '123-123-123', 'No 111, Jalan 111, Taman 111.', 'SecureWord', 'Gmail@Bank.com', 'No 222, Jalan 222, Taman 222.', 'Tan Ah Mei', 'XYZ Company', 0.00, 'Waiting for Approval', 1, '2023-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    +----+---------+--------------+----------------+------------------+-------------------+----------------+--------------+----------+----------------------+-------------------------------+---------------+-----------------+-------------------------------+---------------+----------------+--------------+----------------------+------------+------------+-------------+-------------+-------------------------------+----------+------------+-----------------------------+-------------+-------------+
    | id | bank_id | card_name | ic | online_user_id | online_password | atm_password | account_no | otp_no | card_no | address_of_bank | secure_word | gmail_of_bank | home_address | mother_name | token_key | monthly_cost | status | created_by | created_at | rejected_by | rejected_at | reject_remarks | cased_by | cased_at | case_remarks | approved_by | approved_at |
    +----+---------+--------------+----------------+------------------+-------------------+----------------+--------------+----------+----------------------+-------------------------------+---------------+-----------------+-------------------------------+---------------+----------------+--------------+----------------------+------------+------------+-------------+-------------+-------------------------------+----------+------------+-----------------------------+-------------+-------------+
    | 1 | 20 | RHB card | 111111 | online_user_id | online_password | atm_password | account_no | otp_no | 111 | address_of_bank | secure_word | gmail_of_bank | NULL | NULL | NULL | 316666.67 | Approved | 1 | 2023-04-28 | NULL | NULL | NULL | NULL | NULL | NULL | 1 | 2023-04-28 |
    | 2 | 3 | Am Card | 121212 | online_user_id | online_password | atm_password | account_no | otp_no | 1212 | address_of_bank | secure_word | gmail_of_bank | NULL | NULL | NULL | 316666.67 | Approved | 1 | 2023-04-28 | NULL | NULL | NULL | NULL | NULL | NULL | 1 | 2023-04-28 |
    | 8 | 3 | Name 4 | IC 4 | Online User ID 4 | Online Password 4 | Atm Password 4 | Account No 4 | OTP No 4 | Card No/Company ID 4 | Address of Bank 4 | Secure word 4 | Gmail of Bank 4 | Home Address 4 | Mother Name 4 | Company Name 4 | 6.00 | Rejected | 1 | 2023-05-03 | 1 | 2023-05-03 | Here are some Reject Remarks! | 1 | 2023-05-03 | Here are some Case Remarks! | 1 | 2023-05-03 |
    | 9 | 1 | TESTING Name | 123456-71-8901 | ABC123 | OnlinePassword | AtmPassword | A123456B | 123456 | 123-123-123 | No 111, Jalan 111, Taman 111. | SecureWord | Gmail@Bank.com | No 222, Jalan 222, Taman 222. | Tan Ah Mei | XYZ Company | 0.00 | Waiting for Approval | 1 | 2023-05-05 | NULL | NULL | NULL | NULL | NULL | NULL | NULL | NULL |
    +----+---------+--------------+----------------+------------------+-------------------+----------------+--------------+----------+----------------------+-------------------------------+---------------+-----------------+-------------------------------+---------------+----------------+--------------+----------------------+------------+------------+-------------+-------------+-------------------------------+----------+------------+-----------------------------+-------------+-------------+
    4 rows in set (0.00 sec)

    - chg 2 cols of 'remark' to 'remarks'

======

## GitHub Repo - Coorporation & Version Control

https://github.com/00ZRHun/99mlbank.com
** push to branch bfr merge into master **

## Work Report

### 11 Apr 2023

- clone login page
- clone template for header & footer
- clone home page
- clone user-management page

* clone layout only (function not yet)
* Github: https://github.com/00ZRHun/99mlbank.com/commits/main

### 12 Apr 2023

- Create administration table
- Create users table
- Login page
  - Add login function
  - Pop err msg if credentials do not match records
- Users-management page
  - Create user
  - List all users
  - Active user
  - Inactive user
  - Edit user (in progress)

### 13 Apr 2023

- view user
- edit user
- export ecadmin_99mlbank database script into ecadmin_99mlbank.sql
- upload server

### 17 Apr 2023

- popup err msg if Username or Password is wrong or user inactive
- prevent to access other pages if haven't login yet
- fix login logic (master superadmin & superadmin)

### 18 Apr 2023

- clone layout for rent pay
- create rent table & insert dummy data by sql script
- list rent pays
- create rent pay
- edit rent pay
- delete rent pay

### 19 Apr 2023

- clone layout for expense
- create expense table & insert dummy data by sql script
- list expenses
- create expense
- edit expense
- delete expense

### 20 Apr 2023

- clone layout for customer
- list customers
- create customer
- edit customer
- reset password for customer
- inactive / activate customer
- clone layoput for view customer
- view customer

### 25 Apr 2023

- clone layout for bank
- create bank table & insert dummy data by sql script
- list banks
- create bank
- edit bank
- delete bank

### 26 Apr 2023

- clone layout for announcement
- create announcement table & insert dummy data by sql script
- list announcements
- active / inactive announcement
  - can active one announcement only
- create announcement
- edit announcement
- delete announcement
- link announcement to header (show if have active announcement else hide)

### 27 Apr 2023

- My Cards > Card Details
  - clone layout for Card Details
  - create card table & insert dummy data by sql script
  - list cards
  - create cards
  - edit cards
    ///
  - approve cards (in progress)
  - view rent for card (dummy data for now)
  - display 'Total Cards', 'Total Cost', 'Approved Cards', 'Rent Count' & 'Rent Cost' (dummy data for now)

### 28 Apr 2023

- list cards
- create cards
- edit cards
- approve cards
- display 'Total Cards', 'Total Cost', 'Approved Cards', 'Rent Count' & 'Rent Cost'
  - view rent for card (dummy data)

### 2 May 2023

- clone layout for All Cards
- list cards for 'Waiting Approval'
- list cards for 'Rejected'
- list cards for 'Case'
- list cards for 'Approved'

### 3 May 2023

- edit for card
- reject for card
- approve for card
- case for card
- view rent for card (DUMMY DATA)

### Work Report (8-9 May)

- resolve dummy data under customer-view
  - Cards
    - list rent card
      - filter customer's rent card
      - filter non-cased rent card
    - assign card / create rent card
      - list cards ({card_name} - {bank_name})
        - filter non-used rent card (/filter out rented card)
    - edit rent card
    - delete rent card
    - rent ended for end card (not yet & need time chk logic)
    - remove this month for end card (not yet & need time chk logic)
  - Invoices
    - generate (invoice nombor) (not yet & need time chk logic)
    - list invoices
  - Payments
    - add payment (pay)
    - list payments
    - delete payment
  - Cases
    - case rent card
      - list cased rent card

### 10 May 2023

- do calculation & display result under view customer
- generate (invoice nombor) under view customer
- switch diff side-menu based on user role (eg. Masteradmin, Superadmins, Customer)
- create customer-view page for customer role (in progress)

/// 这些不不急的 -》 dashboard module, end rent & remove this month func & new design

### 11 May 2023

- customer-view (Access level: customer only)

  - clone layout for customer-view
  - do calculation & display result
  - resolve dummy data under customer-view
    - Cards
      - list rent card
        - filter customer's rent card
        - filter non-cased rent card
      - view card details

- simplify customer/view
  - simplify $path, $prev_path
  - simplify $row['total'] cost per card
    - set value when create & update
- code customer-view (add func in above)
- code dashboard module (add func in above)
  // simplify 'user_id = $user_id' into a var
- remove all 'https://bankcardsample.system1906.com'

////
FIX

- remove path varible aft inactive / active user

- add logout function
  - fix pages (got layer/folder) are not logout correctly
    - eg. rent page is not logout correctly (http:)//localhost:8080/rent/index.php
- add change my password
- filter Superadmins role only
- filter available username only (popup err msg if Username is taken)

- alert 'Coming Soon' for incomplete modules/pages (other modules/pages than user, rent & expense)
- export sql2 from local & import to server
- upload to cpanel

===

- rent

  - [x] filter superadmin only
  - [] show selected superadmin

- login

  - [] username: must same upper / lower case
  - [] password: ≥ ??? len

- view user

  - [x] redirect to prev user-management page (if id is invalid)
  - [x] get upline user name

- rent & expense

  - [] `table_name`

- bank
  - [] chk if web missing closing form tag, eg. </form>

USE

- [x][] // initialise variables
- [][] $host = $url . curr_path;

TODO:

- superadmin
  - use "by" field to be filtered by specific user
- study dummy data
  - &quot;{field_name}&quot;
- tmp cmt dashboard module, end rent btn, remove this month btn

///

- remove this
  $count = 0; // TODO: remove var & its usage

TODO

- dashboard
- user-view (bottom details)
- add agent role
