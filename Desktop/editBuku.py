from PyQt6.QtWidgets import (
    QDialog,
    QVBoxLayout,
    QHBoxLayout,
    QLabel,
    QLineEdit,
    QPushButton,
    QTextEdit,
)
from PyQt6.QtCore import Qt


class EditBukuDialog(QDialog):
    def __init__(self, parent=None, buku_id=None):
        super().__init__(parent)
        self.buku_id = buku_id
        self.setWindowTitle("Tambah Buku" if not buku_id else "Edit Buku")
        self.setMinimumWidth(300)

        layout = QVBoxLayout()

        # Judul
        self.judul_input = QLineEdit()
        layout.addWidget(QLabel("Judul:"))
        layout.addWidget(self.judul_input)

        # Pengarang
        self.pengarang_input = QLineEdit()
        layout.addWidget(QLabel("Pengarang:"))
        layout.addWidget(self.pengarang_input)

        # Deskripsi
        self.deskripsi_input = QTextEdit()
        layout.addWidget(QLabel("Deskripsi:"))
        layout.addWidget(self.deskripsi_input)

        # Buttons
        button_layout = QHBoxLayout()
        self.save_button = QPushButton("Simpan")
        self.cancel_button = QPushButton("Batal")

        self.save_button.clicked.connect(self.accept)
        self.cancel_button.clicked.connect(self.reject)

        button_layout.addWidget(self.save_button)
        button_layout.addWidget(self.cancel_button)
        layout.addLayout(button_layout)

        # Load stylesheet
        with open("style/editBuku.qss", "r") as f:
            self.setStyleSheet(f.read())

        # Set spacing for layouts
        layout.setSpacing(10)
        layout.setContentsMargins(20, 20, 20, 20)
        button_layout.setSpacing(10)

        # Set object names for specific styling
        self.save_button.setObjectName("saveButton")
        self.cancel_button.setObjectName("cancelButton")

        self.setLayout(layout)

    def set_data(self, judul, pengarang, deskripsi):
        self.judul_input.setText(judul)
        self.pengarang_input.setText(pengarang)
        self.deskripsi_input.setText(deskripsi)

    def get_data(self):
        return {
            "judul": self.judul_input.text(),
            "pengarang": self.pengarang_input.text(),
            "deskripsi": self.deskripsi_input.toPlainText(),
        }
