# Dokumentasi Fitur Checkout & Order Management

## Alur Checkout dari Cart

### 1. User menambahkan tiket ke keranjang

-   Route: `POST /cart/add/{tiket}` (CartController::add)
-   Data disimpan di Session dengan struktur:
    ```php
    [
      'tiket_id' => int,
      'jumlah' => int,
      'harga' => decimal,
      'nama' => string,
      'event' => string,
      'lokasi' => string,
      'tanggal' => datetime
    ]
    ```

### 2. User melihat cart

-   Route: `GET /cart` (CartController::index)
-   View: `resources/views/cart/index.blade.php`
-   Fitur:
    -   Lihat semua item di keranjang
    -   Hapus item individual
    -   Kosongkan seluruh keranjang
    -   Button "Lanjutkan ke Pembayaran" (Dummy Checkout)

### 3. Dummy Checkout (Process)

-   Route: `POST /checkout` (CheckoutController::store)
-   Logic:
    1. Validasi cart tidak kosong
    2. Mulai database transaction
    3. Hitung total harga dari semua item
    4. Buat record Order
    5. Untuk setiap item di cart:
        - Validasi stok tiket
        - Buat DetailOrder
        - Kurangi stok tiket (decrement)
    6. Hapus cart dari session
    7. Redirect ke halaman riwayat dengan pesan sukses

### 4. Struktur Data Order

#### Table: orders

```sql
- id (PK)
- user_id (FK)
- event_id (FK, nullable untuk multi-event orders)
- total_harga (decimal)
- order_date (datetime)
- created_at, updated_at
```

#### Table: detail_orders

```sql
- id (PK)
- order_id (FK)
- tiket_id (FK)
- jumlah (int)
- subtotal (decimal)
- created_at, updated_at
```

### 5. Tampilan Data di User Side

-   Route: `GET /history` (EventController::history)
-   Menampilkan:
    -   Transaksi langsung (dari BeliTiketController)
    -   Orders dari checkout (dari CheckoutController)
-   View: `resources/views/history.blade.php`

### 6. Tampilan Data di Admin Side

-   Route: `GET /admin/orders` (Admin\OrderController::index)
-   Route: `GET /admin/orders/{order}` (Admin\OrderController::show)
-   Admin dapat melihat:
    -   Daftar semua orders
    -   Detail order termasuk pembeli dan item
    -   Stok tiket yang sudah di-update
-   View:
    -   `resources/views/admin/orders/index.blade.php`
    -   `resources/views/admin/orders/show.blade.php`

## Keamanan & Validasi

1. **Double Validation Kuota**: Sama seperti BeliTiketController
2. **Database Transaction**: Memastikan data konsisten
3. **Exception Handling**: Jika ada error, transaksi rollback
4. **Auth Middleware**: Hanya user yang login dapat checkout

## Model Relations

### Order Model

-   `user()`: belongs to User
-   `details()`: has many DetailOrder
-   `event()`: belongs to Event (optional)

### DetailOrder Model

-   `order()`: belongs to Order
-   `tiket()`: belongs to Tiket

### Tiket Model

-   `event()`: belongs to Event
-   `transaksis()`: has many Transaksi

## Perbandingan: Beli Langsung vs Checkout Cart

| Aspek       | Beli Langsung            | Checkout Cart             |
| ----------- | ------------------------ | ------------------------- |
| Route       | POST /tiket/{tiket}/beli | POST /checkout            |
| Disimpan di | Transaksi table          | Order + DetailOrder table |
| Jumlah Item | 1 tiket                  | Multi tiket               |
| Session     | Tidak                    | Ya                        |
| Admin View  | Transaksi                | Orders                    |
| User View   | Riwayat Pembelian        | Riwayat Pembelian         |

## Cara Testing

### 1. Test sebagai User

```
1. Login sebagai user
2. Jelajahi events di /events
3. Buka event detail
4. Tambahkan beberapa tiket ke cart
5. Buka /cart
6. Klik "Lanjutkan ke Pembayaran"
7. Lihat di /history - Order baru akan muncul
8. Stok tiket akan berkurang
```

### 2. Test sebagai Admin

```
1. Login sebagai admin
2. Buka /admin/orders
3. Lihat daftar orders yang dibuat user
4. Klik order untuk melihat detail
5. Lihat stok di /admin/tiket - sudah berkurang
```

## File yang Ditambah/Dimodifikasi

### File Baru:

-   `app/Http/Controllers/CheckoutController.php`
-   `app/Http/Controllers/Admin/OrderController.php`
-   `resources/views/admin/orders/index.blade.php`
-   `resources/views/admin/orders/show.blade.php`

### File Dimodifikasi:

-   `routes/web.php` - Tambah route checkout & orders
-   `app/Http/Controllers/EventController.php` - Update history method
-   `resources/views/cart/index.blade.php` - Update checkout button
-   `resources/views/history.blade.php` - Tampil orders & transaksis
-   `app/Models/Order.php` - Update relations comments
-   `app/Models/DetailOrder.php` - Update relations comments
