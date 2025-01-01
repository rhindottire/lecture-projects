INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat) VALUES
  ('ACHMAD RIDHO FAIZ', 'L', '081234567890', 'Jalan Merdeka No. 10, Surabaya, Jawa Timur'),
  ('EDHO', 'L', '081234567891', 'Jalan Pahlawan No. 5, Surabaya, Jawa Timur'),
  ('RIDHO', 'L', '081234567892', 'Jalan Tunjungan No. 15, Surabaya, Jawa Timur'),
  ('DODO', 'L', '081234567893', 'Jalan Diponegoro No. 22, Surabaya, Jawa Timur'),
  ('FAIZ', 'L', '081234567894', 'Jalan Gubeng No. 8, Surabaya, Jawa Timur'),
  ('Izy', 'L', '081234567895', 'Jalan Darmo No. 12, Surabaya, Jawa Timur'),
  ('Dio', 'L', '081234567896', 'Jalan Kertajaya No. 7, Surabaya, Jawa Timur'),
  ('Aida', 'P', '081234567897', 'Jalan Pemuda No. 3, Surabaya, Jawa Timur'),
  ('Ashley', 'P', '081234567898', 'Jalan Ahmad Yani No. 2, Surabaya, Jawa Timur'),
  ('Stephanie', 'P', '081234567899', 'Jalan Mayjen Sungkono No. 18, Surabaya, Jawa Timur');

INSERT INTO transaksi (keterangan, total, pelanggan_id) VALUES
  ('Pembelian laptop', 10000000, 1),
  ('Pembelian smartphone', 5000000, 2),
  ('Pembelian TV', 8000000, 3),
  ('Pembelian kulkas', 4500000, 4),
  ('Pembelian mesin cuci', 3500000, 5),
  ('Pembelian AC', 6000000, 6),
  ('Pembelian sepeda motor', 20000000, 7),
  ('Pembelian sofa', 7000000, 8),
  ('Pembelian meja makan', 2500000, 9),
  ('Pembelian kamera', 7500000, 10);

INSERT INTO supplier (nama, telp, alamat) VALUES
  ('PT Sumber Jaya', '081234567000', 'Jl. Raya Surabaya No.123, Surabaya, Jawa Timur'),
  ('CV Mitra Abadi', '081234567001', 'Jl. Ahmad Yani No.45, Bandung, Jawa Barat'),
  ('Toko Elektronik Surabaya', '081234567002', 'Jl. Diponegoro No.67, Surabaya, Jawa Timur'),
  ('UD Sumber Makmur', '081234567003', 'Jl. Pemuda No.89, Jakarta Pusat, DKI Jakarta'),
  ('PT Surya Lestari', '081234567004', 'Jl. Gajah Mada No.56, Semarang, Jawa Tengah'),
  ('CV Berkah Utama', '081234567005', 'Jl. Merdeka No.23, Yogyakarta, DI Yogyakarta'),
  ('UD Sumber Sejahtera', '081234567006', 'Jl. Panglima Polim No.78, Jakarta Selatan, DKI Jakarta'),
  ('PT Maju Bersama', '081234567007', 'Jl. Sultan Agung No.101, Denpasar, Bali'),
  ('CV Prima Mandiri', '081234567008', 'Jl. Jenderal Sudirman No.12, Makassar, Sulawesi Selatan'),
  ('Toko Cahaya Elektronik', '081234567009', 'Jl. Kebon Jeruk No.90, Jakarta Barat, DKI Jakarta');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
  ('BRG001', 'Laptop ASUS', 10000000, 50, 1),
  ('BRG002', 'Smartphone Samsung', 5000000, 100, 2),
  ('BRG003', 'Televisi LG', 8000000, 30, 3),
  ('BRG004', 'Kulkas Sharp', 4500000, 40, 4),
  ('BRG005', 'Mesin Cuci Panasonic', 3500000, 25, 5),
  ('BRG006', 'AC Daikin', 6000000, 60, 6),
  ('BRG007', 'Sepeda Motor Yamaha', 20000000, 15, 7),
  ('BRG008', 'Sofa Minimalis', 7000000, 20, 8),
  ('BRG009', 'Meja Makan Kayu', 2500000, 35, 9),
  ('BRG010', 'Kamera Canon', 7500000, 10, 10);

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
  (1, 1, 10000000, 1),
  (2, 2, 5000000, 1),
  (3, 3, 8000000, 1),
  (4, 4, 4500000, 1),
  (5, 5, 3500000, 1),
  (6, 6, 6000000, 1),
  (7, 7, 20000000, 1),
  (8, 8, 7000000, 1),
  (9, 9, 2500000, 1),
  (10, 10, 7500000, 1);

INSERT INTO user_ (username, password, nama, alamat, hp, level) VALUES
  ('achmadfaiz', 'password123', 'Achmad Ridho Faiz', 'Jalan Merdeka No. 10, Surabaya, Jawa Timur', '081234567890', 1),
  ('edho123', 'pass456', 'Edho', 'Jalan Pahlawan No. 5, Surabaya, Jawa Timur', '081234567891', 2),
  ('ridho98', 'secret789', 'Ridho', 'Jalan Tunjungan No. 15, Surabaya, Jawa Timur', '081234567892', 1),
  ('dodofaiz', 'dodopass', 'Dodo', 'Jalan Diponegoro No. 22, Surabaya, Jawa Timur', '081234567893', 3),
  ('faizzy', 'faizpass', 'Faiz', 'Jalan Gubeng No. 8, Surabaya, Jawa Timur', '081234567894', 2),
  ('izzy21', 'izzypass21', 'Izy', 'Jalan Darmo No. 12, Surabaya, Jawa Timur', '081234567895', 2),
  ('diofan', 'diopass', 'Dio', 'Jalan Kertajaya No. 7, Surabaya, Jawa Timur', '081234567896', 1),
  ('aida23', 'aidapass23', 'Aida', 'Jalan Pemuda No. 3, Surabaya, Jawa Timur', '081234567897', 2),
  ('ashley89', 'ashleypass', 'Ashley', 'Jalan Ahmad Yani No. 2, Surabaya, Jawa Timur', '081234567898', 1),
  ('stephanie22', 'stephpass22', 'Stephanie', 'Jalan Mayjen Sungkono No. 18, Surabaya, Jawa Timur', '081234567899', 3);

INSERT INTO pembayaran (total, metode, transaksi_id) VALUES
  (10000000, 'TUNAI', 1),
  (5000000, 'TRANSFER', 2),
  (8000000, 'EDC', 3),
  (4500000, 'TUNAI', 4),
  (3500000, 'TRANSFER', 5),
  (6000000, 'EDC', 6),
  (20000000, 'TUNAI', 7),
  (7000000, 'TRANSFER', 8),
  (2500000, 'EDC', 9),
  (7500000, 'TUNAI', 10);