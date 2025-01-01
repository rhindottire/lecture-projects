CREATE TABLE pelanggan (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nama VARCHAR(100),
	jenis_kelamin ENUM('L', 'P'),
	telp VARCHAR(12),
	alamat TEXT
);

CREATE TABLE transaksi (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	waktu_transaksi DATETIME(3) DEFAULT CURRENT_TIMESTAMP(3),
	keterangan TEXT,
	total INT,
	pelanggan_id INT,
	FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE supplier (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nama VARCHAR(100),
	telp VARCHAR(12)
);

CREATE TABLE barang (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	kode_barang VARCHAR(10),
	nama_barang VARCHAR(100),
	harga INT,
	stok INT,
	supplier_id INT,
	FOREIGN KEY (supplier_id) REFERENCES supplier(id)
);

CREATE TABLE transaksi_detail (
	transaksi_id INT NOT NULL,
	barang_id INT NOT NULL,
	harga INT,
	qty INT,
	PRIMARY KEY (transaksi_id, barang_id),
	FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
	FOREIGN KEY (barang_id) REFERENCES barang(id)
);

CREATE TABLE user_ (
	id_user INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(30),
	password VARCHAR(35),
	nama VARCHAR(50),
	alamat VARCHAR(150),
	hp VARCHAR(20),
	level INT
);

CREATE TABLE pembayaran (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	waktu_bayar DATETIME(3) DEFAULT CURRENT_TIMESTAMP(3),
	total INT,
	metode ENUM('TUNAI', 'TRANSFER', 'EDC'),
	transaksi_id INT,
	FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);