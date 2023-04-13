# 99mlbank.com

## Setup

PHP Version: 8.0

## Credential

Username: masteradmin
Password: 123456789

## Modules

1. Login

   - [x] clone layout
   - [x] add login function
   - [x] popup err msg if Username or Password is wrong or user inactive
   - [x] prevent to access other pages if haven't login yet
   - [] add logout function

- [] filter active status only

2. Home

   - [x] clone layout

3. User-management
   - [x] clone layout
   - [x] list users
   - [x] create user
   - [] popup err msg if Username is taken
   - [x] view user
   - [x] edit user
   - [] fix wording switch between create & edit (title & msg)
   - [x] inactive / active user
   - [] reset password
   - [] search user
   - [] filter user by date
   - [] resolve dummy data

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

- popup err msg if Username or Password is wrong or user inactive
- prevent to access other pages if haven't login yet
- view user
- edit user
- export ecadmin_99mlbank database script into ecadmin_99mlbank.sql
- upload server
