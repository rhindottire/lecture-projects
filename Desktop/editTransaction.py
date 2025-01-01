from PyQt6.QtWidgets import (
    QDialog,
    QVBoxLayout,
    QHBoxLayout,
    QLabel,
    QLineEdit,
    QPushButton,
    QComboBox,
    QDateEdit,
)
from PyQt6.QtCore import Qt, QDate
from datetime import datetime, timedelta


class EditTransactionDialog(QDialog):
    def __init__(self, parent=None, transaction_id=None, members=None, books=None, durasi=None):
        super().__init__(parent)
        self.transaction_id = transaction_id
        self.setWindowTitle(
            "Tambah Transaksi" if not transaction_id else "Edit Transaksi"
        )
        self.setMinimumWidth(300)
        
        self.durasi = durasi

        layout = QVBoxLayout()

        # Member dropdown
        self.member_input = QComboBox()
        for member in members:
            self.member_input.addItem(member[1], member[0])
        layout.addWidget(QLabel("Member:"))
        layout.addWidget(self.member_input)

        # Book dropdown
        self.book_input = QComboBox()
        for book in books:
            self.book_input.addItem(book[1], book[0])
        layout.addWidget(QLabel("Book:"))
        layout.addWidget(self.book_input)

        # Duration dropdown
        self.duration_input = QComboBox()
        if durasi:
            for id_durasi, jumlah_hari, harga in durasi:
                self.duration_input.addItem(f"{jumlah_hari} Hari - Rp {harga:,}", (id_durasi, jumlah_hari, harga))
        self.duration_input.currentIndexChanged.connect(self.update_return_date_and_price)
        layout.addWidget(QLabel("Duration:"))
        layout.addWidget(self.duration_input)

        # Loan Date (Input oleh user)
        self.loanDate_input = QDateEdit()
        self.loanDate_input.setCalendarPopup(True)
        today = QDate.currentDate()
        self.loanDate_input.setDate(today)
        self.loanDate_input.setMinimumDate(today)
        self.loanDate_input.dateChanged.connect(self.update_return_date_and_price)
        layout.addWidget(QLabel("Loan Date:"))
        layout.addWidget(self.loanDate_input)

        # Return Date (Dihitung otomatis)
        self.returnDate_input = QLineEdit()
        self.returnDate_input.setReadOnly(True)
        layout.addWidget(QLabel("Return Date:"))
        layout.addWidget(self.returnDate_input)

        # Price
        self.price_input = QLineEdit()
        self.price_input.setReadOnly(True)
        layout.addWidget(QLabel("Price:"))
        layout.addWidget(self.price_input)

        # Status
        self.status_input = QComboBox()
        self.status_input.addItems(["meminjam", "dikembalikan", "belum dikembalikan"])
        layout.addWidget(QLabel("Status:"))
        layout.addWidget(self.status_input)

        # Buttons
        button_layout = QHBoxLayout()
        self.save_button = QPushButton("Simpan")
        self.cancel_button = QPushButton("Batal")

        self.save_button.clicked.connect(self.accept)
        self.cancel_button.clicked.connect(self.reject)

        button_layout.addWidget(self.save_button)
        button_layout.addWidget(self.cancel_button)
        layout.addLayout(button_layout)

        # Set spacing
        layout.setSpacing(10)
        layout.setContentsMargins(20, 20, 20, 20)
        button_layout.setSpacing(10)

        # Set object names
        self.save_button.setObjectName("saveButton")
        self.cancel_button.setObjectName("cancelButton")

        self.setLayout(layout)

        # Initialize return date and price
        self.update_return_date_and_price()

    def update_return_date_and_price(self):
        """Update return date and price based on selected loan date and duration."""
        data = self.duration_input.currentData()
        if data:
            id_durasi, jumlah_hari, harga = data
            loan_date = self.loanDate_input.date().toPyDate()
            return_date = loan_date + timedelta(days=jumlah_hari)
            self.returnDate_input.setText(return_date.strftime("%Y-%m-%d"))
            self.price_input.setText(str(harga))
        else:
            self.returnDate_input.setText("")
            self.price_input.setText("")

    def set_data(self, id_member, id_buku, id_durasi, loanDate, returnDate, status):
        """
        Mengisi data form berdasarkan data dari database.
        """
        self.member_input.setCurrentIndex(self.member_input.findData(id_member))
        self.book_input.setCurrentIndex(self.book_input.findData(id_buku))
        if self.durasi:
            index = next(
                (i for i, data in enumerate(self.durasi) if data[0] == id_durasi), -1
            )
            if index != -1:
                self.duration_input.setCurrentIndex(index)
        self.loanDate_input.setDate(QDate.fromString(loanDate, "yyyy-MM-dd"))
        self.returnDate_input.setText(str(returnDate))
        status_index = self.status_input.findText(status)
        if status_index >= 0:
            self.status_input.setCurrentIndex(status_index)

    def get_data(self):
        """
        Mengambil data form untuk disimpan ke database.
        """
        data = self.duration_input.currentData()
        id_durasi = data[0] if data else None
        return {
            "id_member": self.member_input.currentData(),
            "id_buku": self.book_input.currentData(),
            "id_durasi": id_durasi,
            "tanggal_pinjam": self.loanDate_input.date().toString("yyyy-MM-dd"),
            "tanggal_kembali": self.returnDate_input.text(),
            "status": self.status_input.currentText(),
        }