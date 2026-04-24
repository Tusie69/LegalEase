# LegalEase Database Overview

## 1) Muc tieu
Tai lieu nay gioi thieu toan bo thiet ke database hien tai cua du an LegalEase, dua tren tat ca migration dang co trong repository.

## 2) Tong quan nhanh
- Database engine: MySQL/MariaDB (XAMPP)
- Tong so bang: **45**
- Kieu mo hinh: monolith relational schema, tach theo domain nghiep vu
- Cac migration chinh:
  - Laravel core: users/sessions/cache/jobs
  - Admin domain
  - Lawyer extension
  - Customer extension
  - Guest flow

## 3) Nhom bang theo domain

### A. Core auth + ha tang (8 bang)
- `users`, `password_reset_tokens`, `sessions`
- `cache`, `cache_locks`
- `jobs`, `job_batches`, `failed_jobs`

### B. Quyen va quan tri he thong
- `roles`
- `admin_login_logs`
- `admin_audit_logs`
- `admin_report_exports`
- `account_actions`
- `user_violations`

### C. Ho so lawyer
- `lawyer_profiles`
- `lawyer_documents`
- `lawyer_verification_reviews`
- `specializations`
- `lawyer_specializations`
- `lawyer_addresses`
- `slots`
- `cancellation_policies`

### D. Ho so customer
- `customer_profiles`
- `customer_login_logs`
- `customer_saved_lawyers`

### E. Dat lich + van hanh appointment
- `appointments`
- `booking_locks`
- `guest_booking_sessions`
- `appointment_events`
- `appointment_disputes`
- `appointment_dispute_messages`
- `appointment_interventions`
- `appointment_refunds`
- `ratings`
- `appointment_documents`
- `user_reports`

### F. Thanh toan
- `payments`

### G. Giao tiep
- `conversations`
- `messages`
- `notifications`

### H. CMS/noi dung trang
- `cms_articles`
- `cms_faqs`
- `cms_home_configs`
- `cms_home_featured_lawyers`
- `cms_home_pins`

## 4) Cac quan he cot loi
- `users` la bang trung tam:
  - lien ket toi `roles`
  - 1-1 voi `lawyer_profiles` hoac `customer_profiles`
  - dong vai tro actor trong nhieu bang audit/intervention/report/message
- `appointments` la truc nghiep vu:
  - FK toi `users` (lawyer, customer)
  - FK toi `slots` (nullable)
  - co cac bang ve dispute, refund, rating, payment, event, document
- `lawyer_profiles`:
  - 1-n `lawyer_documents`
  - 1-n `lawyer_verification_reviews`
  - n-n `specializations` qua `lawyer_specializations`
  - 1-1 `lawyer_addresses`
- `guest_booking_sessions` + `booking_locks` ho tro pre-booking truoc khi user dang ky/dang nhap.

## 5) Luong du lieu nghiep vu chinh
1. Lawyer tao slot trong `slots`.
2. Customer/guest tao booking intent (`guest_booking_sessions`, `booking_locks`).
3. He thong tao `appointments` khi dat thanh cong.
4. Thanh toan ghi nhan qua `payments`.
5. Qua trinh xu ly appointment duoc track boi `appointment_events`.
6. Neu tranh chap: `appointment_disputes` + `appointment_dispute_messages` + `appointment_interventions`.
7. Sau buoi hen: `ratings`, co the phat sinh `appointment_refunds` va `user_reports`.

## 6) Rang buoc va indexing dang chu y
- Nhieu unique key de tranh trung:
  - `users.email`
  - `appointments.booking_code`
  - `appointments.slot_id` (moi slot toi da 1 lich hen)
  - bang pivot nhu `lawyer_specializations`, `customer_saved_lawyers`
- Check constraint:
  - `ratings.stars` trong [1..5] qua constraint `chk_ratings_stars_range`
- Index da duoc tao theo huong query van hanh:
  - timeline (`status + created_at`, `status + scheduled_start_at`)
  - lookup theo actor (`lawyer_id`, `customer_id`, `admin_id`)
  - bo loc moderation/reporting

## 7) Seed data hien tai
- Migration `create_admin_domain_tables` se seed 3 role mac dinh:
  - `ADMIN`, `LAWYER`, `CUSTOMER`
- `DatabaseSeeder` mac dinh tao 1 user test:
  - `test@example.com`

## 8) Ghi chu ky thuat
- Tat ca migration da chay thanh cong voi `php artisan migrate:fresh --seed`.
- Neu reset moi truong local, can dam bao `.env` dung DB:
  - `DB_CONNECTION=mysql`
  - `DB_HOST=127.0.0.1`
  - `DB_PORT=3306`
  - `DB_DATABASE=legalease_2`
  - `DB_USERNAME=root`
  - `DB_PASSWORD=`
