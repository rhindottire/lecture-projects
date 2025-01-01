CREATE TABLE Barang (
  id_barang INT PRIMARY KEY,
  nama_barang VARCHAR(100),
  harga_barang DECIMAL(10, 2),
  stok INT,
  kategori VARCHAR(50)
);

CREATE TABLE Pelanggan (
  id_pelanggan INT PRIMARY KEY,
  nama_pelanggan VARCHAR(100),
  alamat VARCHAR(255),
  nomor_telepon VARCHAR(15)
);

CREATE TABLE Pemasok (
  id_pemasok INT PRIMARY KEY,
  nama_pemasok VARCHAR(100),
  alamat VARCHAR(255),
  nomor_telepon VARCHAR(15)
);

CREATE TABLE Transaksi_Penjualan (
  id_transaksi_penjualan INT PRIMARY KEY,
  tanggal_penjualan DATE,
  total_harga DECIMAL(10, 2),
  id_pelanggan INT,
  FOREIGN KEY (id_pelanggan) REFERENCES Pelanggan(id_pelanggan)
);

CREATE TABLE Transaksi_Pembelian (
  id_transaksi_pembelian INT PRIMARY KEY,
  tanggal_pembelian DATE,
  total_harga DECIMAL(10, 2),
  id_pemasok INT,
  FOREIGN KEY (id_pemasok) REFERENCES Pemasok(id_pemasok)
);

CREATE TABLE Barang_Penjualan (
  id_barang INT,
  id_transaksi_penjualan INT,
  jumlah INT,
  PRIMARY KEY (id_barang, id_transaksi_penjualan),
  FOREIGN KEY (id_barang) REFERENCES Barang(id_barang),
  FOREIGN KEY (id_transaksi_penjualan) REFERENCES
  Transaksi_Penjualan(id_transaksi_penjualan)
);

CREATE TABLE Barang_Pembelian (
  id_barang INT,
  id_transaksi_pembelian INT,
  jumlah INT,
  PRIMARY KEY (id_barang, id_transaksi_pembelian),
  FOREIGN KEY (id_barang) REFERENCES Barang(id_barang),
  FOREIGN KEY (id_transaksi_pembelian) REFERENCES
  Transaksi_Pembelian(id_transaksi_pembelian)
);