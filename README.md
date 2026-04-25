# LegalEase

Ung dung Laravel cho luong xac thuc co ban: dang ky, dang nhap, dang xuat va vao dashboard.

## Cong nghe
- PHP `^8.3`
- Laravel `^13`
- Vite `^8`
- Tailwind CSS `^4`
- Co so du lieu: MySQL (khuyen dung cho project nay)

## Tinh nang hien co
- Dang ky tai khoan (`/register`)
- Dang nhap (`/login`)
- Dang xuat (`/logout`)
- Trang dashboard yeu cau dang nhap (`/dashboard`)

## Yeu cau truoc khi chay
- Da cai PHP 8.3+
- Da cai Composer
- Da cai Node.js + npm
- Da co MySQL dang chay

## Cai dat nhanh
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Tren Windows PowerShell, neu `cp` khong dung duoc:
```powershell
Copy-Item .env.example .env
```

## Cau hinh MySQL trong `.env`
Mo file `.env` va cap nhat:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=legalease
DB_USERNAME=root
DB_PASSWORD=your_password
```

Sau do chay migration:
```bash
php artisan migrate
```

## Chay du an
Chay backend:
```bash
php artisan serve
```

Chay frontend (Vite):
```bash
npm run dev
```

Mac dinh ung dung chay tai: `http://127.0.0.1:8000`

## Kiem tra ket noi database
```bash
php artisan migrate:status
```

Neu ket noi MySQL on, ban se thay danh sach migration.

## Route chinh
- `GET /` -> chuyen huong den trang dang nhap
- `GET /register` -> form dang ky
- `POST /register` -> tao tai khoan moi
- `GET /login` -> form dang nhap
- `POST /login` -> xu ly dang nhap
- `GET /dashboard` -> trang sau dang nhap
- `POST /logout` -> dang xuat

## Ghi chu
- File `.env` khong duoc commit len GitHub.
- Du an dang dung model `User` anh xa toi bang `Users` (chu hoa), khoa chinh `User_Id`.
