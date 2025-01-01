from PyQt6.QtWidgets import (
    QDialog,
    QVBoxLayout,
    QHBoxLayout,
    QLabel,
    QLineEdit,
    QPushButton,
    QComboBox
)
from PyQt6.QtCore import Qt

class EditMemberDialog(QDialog):
    def __init__(self, parent=None, member_id=None):
        super().__init__(parent)
        self.member_id = member_id
        self.setWindowTitle("Tambah Member" if not member_id else "Edit Member")
        self.setMinimumWidth(300)

        layout = QVBoxLayout()

        # Nama
        self.nama_input = QLineEdit()
        layout.addWidget(QLabel("Nama:"))
        layout.addWidget(self.nama_input)

        # No HP
        self.nohp_input = QLineEdit()
        layout.addWidget(QLabel("No HP:"))
        layout.addWidget(self.nohp_input)

        # Gender
        self.gender_input = QComboBox()
        self.gender_input.addItems(["Laki-laki", "Perempuan"])
        layout.addWidget(QLabel("Gender:"))
        layout.addWidget(self.gender_input)

        # PIN
        self.pin_input = QLineEdit()
        layout.addWidget(QLabel("PIN:"))
        layout.addWidget(self.pin_input)

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

        # Set spacing
        layout.setSpacing(10)
        layout.setContentsMargins(20, 20, 20, 20)
        button_layout.setSpacing(10)

        # Set object names
        self.save_button.setObjectName("saveButton")
        self.cancel_button.setObjectName("cancelButton")

        self.setLayout(layout)

    def set_data(self, nama, nohp, gender, pin):
        self.nama_input.setText(nama)
        self.nohp_input.setText(nohp) 
        self.gender_input.setCurrentText(gender)
        self.pin_input.setText(pin)

    def get_data(self):
        return {
            "nama_member": self.nama_input.text(),
            "no_hp_member": self.nohp_input.text(),
            "gender_member": self.gender_input.currentText(),
            "pin": self.pin_input.text()
        }
