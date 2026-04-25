# LegalEase - Status Mapping Standard (v1)

## 1) users.status
- Values: `ACTIVE`, `INACTIVE`

Allowed transitions:
- `ACTIVE -> INACTIVE`
  - Trigger: Admin khoa tai khoan (vi pham/lap lai vi pham)
  - Required side effects:
    - Insert `account_actions` (`action_type=LOCK`, `previous_status=ACTIVE`, `new_status=INACTIVE`)
    - Insert `notifications`
- `INACTIVE -> ACTIVE`
  - Trigger: Admin mo khoa
  - Required side effects:
    - Insert `account_actions` (`action_type=UNLOCK`, `previous_status=INACTIVE`, `new_status=ACTIVE`)
    - Insert `notifications`

## 2) lawyer_profiles.verification_status
- Values: `UNVERIFIED`, `VERIFIED`

Allowed transitions:
- `UNVERIFIED -> VERIFIED`
  - Trigger: Admin duyet ho so
  - Required side effects:
    - Set `verified_at`, `verified_by_admin_id`
    - Insert `lawyer_verification_reviews` (`decision=APPROVED`)
    - Insert `notifications`
- `UNVERIFIED -> UNVERIFIED` (reject)
  - Trigger: Admin tu choi ho so
  - Required side effects:
    - Insert `lawyer_verification_reviews` (`decision=REJECTED`, co `reason`)
    - Insert `notifications`

## 3) appointments.status
- Values: `PENDING`, `CONFIRMED`, `COMPLETED`, `CANCELLED`

Allowed transitions:
- `PENDING -> CONFIRMED`
  - Trigger: Dat lich thanh cong / du dieu kien xac nhan
- `PENDING -> CANCELLED`
  - Trigger: Huy boi user/admin
  - Required side effects:
    - Set `cancelled_at`, `cancellation_reason`
    - Neu admin can thiep: insert `appointment_interventions` (`action=FORCE_CANCEL`)
    - Neu co hoan tien: insert `appointment_refunds`
- `CONFIRMED -> COMPLETED`
  - Trigger: Ket thuc lich hen binh thuong
- `CONFIRMED -> CANCELLED`
  - Trigger: Huy boi 1 ben hoac admin can thiep
  - Required side effects: giong tren
- `CONFIRMED -> COMPLETED` (force)
  - Trigger: Admin force complete
  - Required side effects:
    - Insert `appointment_interventions` (`action=FORCE_COMPLETE`)

Terminal states:
- `COMPLETED` (khong doi trang thai nua)
- `CANCELLED` (khong doi trang thai nua)

## 4) appointment_disputes.status
- Values: `OPEN`, `RESOLVED`

Allowed transitions:
- `OPEN -> RESOLVED`
  - Trigger: Admin xu ly xong khieu nai
  - Required side effects:
    - Set `resolved_at`
    - Insert `notifications` cho cac ben lien quan

Terminal state:
- `RESOLVED`

## 5) appointment_refunds.status
- Values: `PENDING`, `PROCESSED`, `REJECTED`

Allowed transitions:
- `PENDING -> PROCESSED`
  - Trigger: Hoan tien thanh cong
  - Required side effects: set `processed_at`
- `PENDING -> REJECTED`
  - Trigger: Tu choi hoan tien

Terminal states:
- `PROCESSED`
- `REJECTED`

## 6) cms_articles.status
- Values: `DRAFT`, `PUBLISHED`

Allowed transitions:
- `DRAFT -> PUBLISHED`
  - Trigger: Admin publish bai viet
  - Required side effects: set `published_at`
- `PUBLISHED -> DRAFT`
  - Trigger: Admin an bai viet/depublish

## 7) admin_report_exports.status
- Values: `PENDING`, `PROCESSING`, `COMPLETED`, `FAILED`

Allowed transitions:
- `PENDING -> PROCESSING`
- `PROCESSING -> COMPLETED`
  - Required side effects: set `generated_at`, `file_path`
- `PROCESSING -> FAILED`

Terminal states:
- `COMPLETED`
- `FAILED`

## 8) Canonical action values

### account_actions.action_type
- Values: `LOCK`, `UNLOCK`, `STATUS_UPDATE`

### appointment_interventions.action
- Values: `FORCE_CANCEL`, `FORCE_COMPLETE`, `DISPUTE_RESOLUTION`

### lawyer_verification_reviews.decision
- Values: `APPROVED`, `REJECTED`

## 9) Validation rules (service layer)
- Khong cho phep transition ngoai danh sach tren.
- Moi transition co side effects bat buoc phai thuc hien trong cung transaction.
- Moi thao tac admin quan trong nen ghi `admin_audit_logs`.
