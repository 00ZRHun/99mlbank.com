STUDY NOTES

=== Card ===
monthly_price
insurance

=== RentCard ===
card_id
start_date
end_date

/// largeModal (storeCard)
select_card -> card_id
from_date
to_price
insurance
/// editModal (updateCard)
edit_from_date
edit_to_date
edit_to_price
edit_insurance

**_ OTHER _**
=== card ===
id
bank_id
card_name
ic  
online_user_id  
online_password  
atm_password  
account_no  
otp_no  
card_no  
address_of_bank  
secure_word  
gmail_of_bank  
home_address  
mother_name  
token_key  
monthly_cost
status  
created_by
created_at
rejected_by
rejected_at
reject_remarks  
cased_by
cased_at  
case_remarks  
approved_by
approved_at
|

mysql> SELECT \* FROM card;
+----+---------+-----------+--------+------------------+-------------------+----------------+--------------+----------+----------------------+-------------------+---------------+-----------------+----------------+---------------+----------------+--------------+----------+------------+------------+-------------+-------------+-------------------------------+----------+------------+-----------------------------+-------------+-------------+
| id | bank_id | card_name | ic | online_user_id | online_password | atm_password | account_no | otp_no | card_no | address_of_bank | secure_word | gmail_of_bank | home_address | mother_name | token_key | monthly_cost | status | created_by | created_at | rejected_by | rejected_at | reject_remarks | cased_by | cased_at | case_remarks | approved_by | approved_at |
+----+---------+-----------+--------+------------------+-------------------+----------------+--------------+----------+----------------------+-------------------+---------------+-----------------+----------------+---------------+----------------+--------------+----------+------------+------------+-------------+-------------+-------------------------------+----------+------------+-----------------------------+-------------+-------------+
| 1 | 20 | RHB card | 111111 | online_user_id | online_password | atm_password | account_no | otp_no | 111 | address_of_bank | secure_word | gmail_of_bank | NULL | NULL | NULL | 316666.67 | Approved | 1 | 2023-04-28 | NULL | NULL | NULL | NULL | NULL | NULL | 1 | 2023-04-28 |
| 2 | 3 | Am Card | 121212 | online_user_id | online_password | atm_password | account_no | otp_no | 1212 | address_of_bank | secure_word | gmail_of_bank | NULL | NULL | NULL | 316666.67 | Approved | 1 | 2023-04-28 | NULL | NULL | NULL | NULL | NULL | NULL | 1 | 2023-04-28 |
| 8 | 3 | Name 4 | IC 4 | Online User ID 4 | Online Password 4 | Atm Password 4 | Account No 4 | OTP No 4 | Card No/Company ID 4 | Address of Bank 4 | Secure word 4 | Gmail of Bank 4 | Home Address 4 | Mother Name 4 | Company Name 4 | 6.00 | Rejected | 1 | 2023-05-03 | 1 | 2023-05-03 | Here are some Reject Remarks! | 1 | 2023-05-03 | Here are some Case Remarks! | 1 | 2023-05-03 |
+----+---------+-----------+--------+------------------+-------------------+----------------+--------------+----------+----------------------+-------------------+---------------+-----------------+----------------+---------------+----------------+--------------+----------+------------+------------+-------------+-------------+-------------------------------+----------+------------+-----------------------------+-------------+-------------+
3 rows in set (0.01 sec)

mysql>

=== rent card ===
select_card
from_date
to_price
insurance

== OTHER COL ==
date_start
date_end

- price (<= monthly_cost)
  insurance

---

cased_at_for_rent
case_remarks_for_rent

---

///
from_date / start_date
to_date / end_date
???
no_of_days
total
???

tbl: invoice
no
tbl: payment
Payment Date
Pay for
Amount
Remarks

- date format: dd/mm/yyyy

TODO

- CUSTOMER > view.php > line 355
  <!-- list cards ({card_name} - {bank_name}) -->

                              <?php
                                      $sql = "SELECT cd.id AS id, cd.card_name AS card_name, bk.name AS bank_name
                                      FROM `card` as cd LEFT JOIN `bank` as bk ON cd.bank_id = bk.id
                                      WHERE cd.status = 'Approved'";
                                      // echo "<script>alert('sql = $sql')</script>";   // D
                                      $result = mysqli_query($conn, $sql);
                                      if ($result->num_rows > 0) {
                                          while ($row = $result->fetch_assoc()) {
                                              echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                                      ?>
                                      <option value="<?= $row['id'] ?>"><?= $row['card_name'] - $row['bank_name'] ?></option>
                              <?php
                                          }
                                      }
                              ?>

- update join tables
  SELECT cd.id AS id, cd.card_name AS card_name, bk.name AS bank_name
  FROM `card` as cd LEFT JOIN `bank` as bk ON cd.bank_id = bk.id
  WHERE cd.id = 3;

UPDATE card set card_name = 'Name 4.2'
FROM `card` as cd LEFT JOIN `bank` as bk ON cd.bank_id = bk.id
WHERE cd.id = 3;

UPDATE card set bk.name AS bank_name

<!-- TO BE CONTINUE HERE -->

Invoice No</th>

<th>Month Year</th>
<th>Total

Invoice

- id
- monthYear
- total
