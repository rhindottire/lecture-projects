import sqlite3
import os

current_dir = os.path.dirname(os.path.abspath(__file__))

database_path = os.path.join(current_dir, 'perpustakaan.sqlite')

conn = sqlite3.connect(database_path)
cursor=conn.cursor()
cursor.execute("""
  CREATE table member (
    id_member INTEGER PRIMARY KEY AUTOINCREMENT,
    nama_member TEXT,
    no_hp_member TEXT,
    gender_member TEXT,
    pin TEXT DEFAULT NULL
  );
""")
print(f"Database berhasil dibuat di: {database_path}")

cursor.execute("""
  INSERT into member VALUES (null,null,null,null,'12345');
""")

cursor.execute("""
  CREATE TABLE buku (
    id_buku INTEGER PRIMARY KEY AUTOINCREMENT,
    judul TEXT,
    pengarang TEXT,
    deskripsi TEXT
  );
""")

cursor.execute("""
    CREATE TABLE durasi (
    id_durasi INTEGER PRIMARY KEY AUTOINCREMENT,
    jumlah_hari INTEGER,
    harga INTEGER
  );
""")

cursor.execute("""
  CREATE TABLE transaksi_peminjaman (
    id_transaksi_peminjaman INTEGER PRIMARY KEY AUTOINCREMENT,
    nama_peminjam TEXT,
    id_buku INTEGER,
    tanggal_pinjam DATE,
    tanggal_kembali DATE,
    durasi_pinjam INTEGER,
    status DEFAULT 'meminjam' CHECK (status IN ('meminjam','dikembalikan','belum dikembalikan'))
  );
""")

cursor.execute("""
  DROP TABLE transaksi_peminjaman
""")

cursor.execute("""
  CREATE TABLE transaksi_peminjaman (
    id_transaksi_peminjaman INTEGER PRIMARY KEY AUTOINCREMENT,
    id_member INTEGER,
    id_buku INTEGER,
    id_durasi INTEGER,
    tanggal_pinjam DATE,
    tanggal_kembali DATE,
    status DEFAULT 'meminjam' CHECK (status IN ('meminjam','dikembalikan','belum dikembalikan')),
    CONSTRAINT fk_tp_member FOREIGN KEY (id_member) REFERENCES member (id_member) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_tp_buku FOREIGN KEY (id_buku) REFERENCES buku (id_buku) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_tp_durasi FOREIGN KEY (id_durasi) REFERENCES durasi (id_durasi) ON DELETE CASCADE ON UPDATE CASCADE
  )
""")

conn.commit()
conn.close()