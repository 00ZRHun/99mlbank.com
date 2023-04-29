# 99mlbank.com

## Setup

PHP Version: 8.0

## Credential

https://99mlbank.com
Username: masteradmin
Password: 123456789

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

========================= 5. Rent Pay

- [x][x] clone layout for rent pay
- [x][x] create rent table & insert dummy data by sql script
- [x][x] list rent pay
- [x][x] create rent pay
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
  - [] assign card
  - [] resolve dummy data under customer-view

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
  - [x] create cards
  - [x] edit cards
    - [] set null if empty input (FINDING SOLUTION)
  - [y] approve cards
  - [] view rent for card
  - [y] display 'Total Cards', 'Total Cost', 'Approved Cards', 'Rent Count' & 'Rent Cost'
    ///
  - [] resolve all "select > option" to dynamic

- Cards Settings > All Cards

  - [y] clone layout for All Cards
  - [y] list cards for 'Waiting Approval'
  - [] list cards for 'Rejected'
  - [] list cards for 'Case'
  - [y] list cards for 'Approved'
    - [] view rent
    - [] edit card

  <!-- TODO -->

  - view rent
  - edit > card cost

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
