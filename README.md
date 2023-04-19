# 99mlbank.com

## Setup

PHP Version: 8.0

## Credential

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
   - [][] resolve dummy data

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
  - [x] clone layout for customers
  - [x] create customers table & insert dummy data by sql script
  - [x] list customers
  - [x] create customers
  - [x] edit customers
  - [x] reset password for customers
  - [x] inactive / activate customers
  - [] view customer

**- Cards Settings**
**- Users Settings**

- Banks Settings

  - [x] clone layout for banks
  - [] create banks table & insert dummy data by sql script
  - [] list banks
  - [] create banks
  - [] edit banks
  - [] delete banks

- Announcement
  - [x] clone layout for announcement
  - [] create announcement table & insert dummy data by sql script
  - [] list announcement
  - [] create announcement
  - [] edit announcement
  - [] delete announcement

**- My Cards**

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
- list rent pay
- create rent pay
- edit rent pay
- delete rent pay

### 19 Apr 2023

- clone layout for expenses
- create expenses table & insert dummy data by sql script
- list expenses
- create expenses
- edit expenses
- delete expenses

### 20 Apr 2023

- clone layout for customers
- create customers table & insert dummy data by sql script
- list customers
- create customers
- edit customers
- reset password for customers
- inactive / activate customers
- view customer

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
