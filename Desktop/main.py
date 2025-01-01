# NAMA : Muhammad Haikal Firmansyah, NIM  : 230411100095
# NAMA : Imam Syafii, NIM : 230411100198
# NAMA : Rohman Maulana,  NIM : 230411100140
# NAMA : Hanif Brian Gyimnastiar, NIM: 230411100036 
# NAMA : Ahmad Mufid Rizqi, NIM: 230411100031 
# NAMA : Achmad Ridho Fa'iz, NIM: 230411100197
# EMAIL YG BISA DIHUBUNGI: firmansyahhaikal86@gmail.com
# Kelas: PEMDES IF3A
# Topic : Perpustakaan


import sys
import sqlite3
from PyQt6.QtWidgets import (
    QMainWindow,
    QApplication,
    QDialog,
    QVBoxLayout,
    QLabel,
    QLineEdit,
    QPushButton,
    QMessageBox,
    QListWidgetItem,
    QWidget,
    QGridLayout,
    QFrame,
    QVBoxLayout,
    QLabel,
    QPushButton,
    QHBoxLayout,
    QTableWidget,
    QTableView,
    QTableWidgetItem,
)
from PyQt6.QtCore import Qt, QSize
from PyQt6.QtGui import QIcon, QPixmap, QFont, QColor

# Import the UI class from the 'main_ui' module
from main_ui import Ui_MainWindow
from editBuku import EditBukuDialog
from editMember import EditMemberDialog
from editTransaction import EditTransactionDialog


# Dialog Login
class LoginDialog(QDialog):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("Login")
        self.setFixedSize(180, 210)

        # Apply the stylesheet for the login dialog
        with open("style/login_style.qss", "r") as file:
            self.setStyleSheet(file.read())

        # Layout untuk dialog login
        layout = QVBoxLayout()

        # Label dan input untuk Admin
        self.password_label = QLabel("Admin:")
        self.password_label.setStyleSheet(
            "font-size: 20px; font-weight: bold; color: #E0E0E0;"
        )
        layout.addSpacing(10)
        label_layout = QHBoxLayout()
        label_layout.addStretch()
        label_layout.addWidget(self.password_label)
        label_layout.addStretch()

        # Tambahkan layout label ke layout utama
        layout.addLayout(label_layout)

        self.password_input = QLineEdit()
        self.password_input.setEchoMode(QLineEdit.EchoMode.Password)
        self.password_input.setPlaceholderText("MASUKKAN PIN: 12345")
        self.password_input.setFixedHeight(40)
        layout.addWidget(self.password_label)
        layout.addWidget(self.password_input)

        layout.addSpacing(10)

        self.login_button = QPushButton("Login")
        self.login_button.setFixedHeight(45)

        self.login_button.clicked.connect(self.handle_login)
        layout.addWidget(self.login_button)

        self.setLayout(layout)

        # Status login
        self.logged_in = False

    def handle_login(self):
        password = self.password_input.text()

        # Sambungkan ke database SQLite
        conn = sqlite3.connect("perpustakaan.sqlite")
        cursor = conn.cursor()

        # Query untuk memeriksa password
        query = "SELECT * FROM member WHERE pin = ?"
        cursor.execute(query, (password,))
        result = cursor.fetchone()

        conn.close()

        if result:
            QMessageBox.information(
                self, "Login Berhasil", "Selamat datang " + result[1].upper()
            )
            self.logged_in = True
            self.accept()  # Tutup dialog login
        else:
            QMessageBox.warning(self, "Login Gagal", "Username atau password salah.")


# Define a custom MainWindow class
class MainWindow(QMainWindow):
    def __init__(self):
        super().__init__()

        # Initialize the UI from the generated 'main_ui' class
        self.ui = Ui_MainWindow()
        self.ui.setupUi(self)

        # Set window properties
        self.setWindowIcon(QIcon("./icon/Logo.png"))
        self.setWindowTitle("E-Book")

        # Initialize UI elements
        self.title_label = self.ui.title_label
        self.title_label.setText("E-Book")

        self.title_icon = self.ui.title_icon
        self.title_icon.setText("")
        self.title_icon.setPixmap(QPixmap("./icon/Logo.png"))
        self.title_icon.setScaledContents(True)

        self.side_menu = self.ui.listWidget
        self.side_menu.setFocusPolicy(Qt.FocusPolicy.NoFocus)
        self.side_menu_icon_only = self.ui.listWidget_icon_only
        self.side_menu_icon_only.setFocusPolicy(Qt.FocusPolicy.NoFocus)
        self.side_menu_icon_only.hide()

        self.menu_btn = self.ui.menu_btn
        self.menu_btn.setText("")
        self.menu_btn.setIcon(QIcon("./icon/close.svg"))
        self.menu_btn.setIconSize(QSize(30, 30))
        self.menu_btn.setCheckable(True)
        self.menu_btn.setChecked(False)

        self.main_content = self.ui.stackedWidget

        # Define a list of menu items with names and icons
        self.menu_list = [
            {"name": "Dashboard", "icon": "./icon/dashboard-white.svg"},
            {"name": "Books", "icon": "./icon/orders-white.svg"},
            {"name": "Members", "icon": "./icon/customers-white.svg"},
            {"name": "Transactions", "icon": "./icon/reports-white.svg"},
            {"name": "Logout", "icon": "./icon/arrow-left.svg"},
        ]

        # Initialize the UI elements and slots
        self.init_list_widget()
        self.init_stackwidget()
        self.init_single_slot()
        self.update_dashboard()  # Add initial dashboard update

    def init_single_slot(self):
        # Connect signals and slots for menu button and side menu
        self.menu_btn.toggled["bool"].connect(self.side_menu.setHidden)
        self.menu_btn.toggled["bool"].connect(self.title_label.setHidden)
        self.menu_btn.toggled["bool"].connect(self.side_menu_icon_only.setVisible)
        self.menu_btn.toggled["bool"].connect(self.title_icon.setHidden)

        # Connect signals and slots for switching between menu items
        self.side_menu.currentRowChanged["int"].connect(self.handle_menu_change)
        self.side_menu_icon_only.currentRowChanged["int"].connect(
            self.handle_menu_change
        )
        self.side_menu.currentRowChanged["int"].connect(
            self.side_menu_icon_only.setCurrentRow
        )
        self.side_menu_icon_only.currentRowChanged["int"].connect(
            self.side_menu.setCurrentRow
        )
        self.menu_btn.toggled.connect(self.button_icon_change)

    def init_list_widget(self):
        # Initialize the side menu and side menu with icons only
        self.side_menu_icon_only.clear()
        self.side_menu.clear()

        for menu in self.menu_list:
            # Set items for the side menu with icons only
            item = QListWidgetItem()
            item.setIcon(QIcon(menu.get("icon")))
            item.setSizeHint(QSize(40, 40))
            self.side_menu_icon_only.addItem(item)
            self.side_menu_icon_only.setCurrentRow(0)

            # Set items for the side menu with icons and text
            item_new = QListWidgetItem()
            item_new.setIcon(QIcon(menu.get("icon")))
            item_new.setText(menu.get("name"))
            self.side_menu.addItem(item_new)
            self.side_menu.setCurrentRow(0)

    def init_stackwidget(self):
        # Initialize the stack widget with content pages
        widget_list = self.main_content.findChildren(QWidget)
        for widget in widget_list:
            self.main_content.removeWidget(widget)

        for menu in self.menu_list:
            text = menu.get("name")
            if text == "Dashboard":
                self.add_dashboard_content()
            elif text == "Books":
                self.add_books_content()
            elif text == "Members":
                self.add_members_content()
            elif text == "Transactions":
                self.add_Transaction_content()
            elif text == "Logout":
                pass
                # No specific content needed for logout, it's handled in handle_menu_change
                layout = QGridLayout()
                label = QLabel("Logout")
                label.setAlignment(Qt.AlignmentFlag.AlignCenter)
                font = QFont()
                font.setPixelSize(20)
                label.setFont(font)
                layout.addWidget(label)
                new_page = QWidget()
                new_page.setLayout(layout)
                self.main_content.addWidget(new_page)

    def add_dashboard_content(self):
        # Layout utama untuk dashboard
        dashboard_layout = QVBoxLayout()
        dashboard_layout.setContentsMargins(20, 20, 20, 20)
        dashboard_layout.setSpacing(10)
        dashboard_layout.setAlignment(Qt.AlignmentFlag.AlignTop)

        # Layout tambahan untuk baris statistik
        stats_layout = QGridLayout()
        stats_layout.setSpacing(10)

        def get_total_books():
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute("SELECT COUNT(*) FROM buku")
            total_books = cursor.fetchone()[0]
            conn.close()
            return total_books

        def get_total_members():
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute("SELECT COUNT(*) FROM member")
            total_members = cursor.fetchone()[0]
            conn.close()
            return total_members

        def get_total_borrowed_books():
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute(
                "SELECT COUNT(*) FROM transaksi_peminjaman WHERE status = 'meminjam'"
            )
            total_borrowed_books = cursor.fetchone()[0]
            conn.close()
            return total_borrowed_books

        def get_total_returned_books():
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute(
                "SELECT COUNT(*) FROM transaksi_peminjaman WHERE status = 'dikembalikan'"
            )
            total_returned_books = cursor.fetchone()[0]
            conn.close()
            return total_returned_books

        # Kotak statistik
        book_box = self.create_stat_box("Buku", str(get_total_books()), "#2196F3")
        member_box = self.create_stat_box(
            "Anggota", str(get_total_members()), "#FBC02D"
        )
        circulation_box = self.create_stat_box(
            "Dipinjam", str(get_total_borrowed_books()), "#43A047"
        )
        report_box = self.create_stat_box(
            "Dikembalikan", str(get_total_returned_books()), "#E53935"
        )

        # Tambahkan kotak ke layout grid
        stats_layout.addWidget(book_box, 0, 0)
        stats_layout.addWidget(member_box, 0, 1)
        stats_layout.addWidget(circulation_box, 0, 2)
        stats_layout.addWidget(report_box, 0, 3)

        # Tambahkan layout statistik ke layout utama
        dashboard_layout.addLayout(stats_layout)

        # Label selamat datang
        label = QLabel("Selamat Datang di Dashboard")
        label.setAlignment(Qt.AlignmentFlag.AlignCenter)
        font = QFont()
        font.setPixelSize(20)
        label.setFont(font)
        dashboard_layout.addWidget(label)

        # Atur layout ke widget dashboard
        dashboard_widget = QWidget()
        dashboard_widget.setLayout(dashboard_layout)

        # Tambahkan widget dashboard ke stack
        self.main_content.addWidget(dashboard_widget)

    def button_icon_change(self, status):
        # Change the menu button icon based on its status
        if status:
            self.menu_btn.setIcon(QIcon("./icon/open.svg"))
        else:
            self.menu_btn.setIcon(QIcon("./icon/close.svg"))

    def create_stat_box(self, title, value, color, icon_path=None):
        # Frame utama
        frame = QFrame()
        frame.setStyleSheet(
            f"""
            QFrame {{
                background-color: {color};
                border-radius: 10px;
            }}
        """
        )
        frame.setFixedSize(200, 120)

        # Layout dalam frame
        layout = QVBoxLayout(frame)

        # Label untuk value (angka)
        value_label = QLabel(value)
        value_label.setStyleSheet("color: white; font-size: 15px; font-weight: bold;")
        value_label.setAlignment(Qt.AlignmentFlag.AlignTop)

        # Label untuk title (teks bawah angka)
        title_label = QLabel(title)
        title_label.setStyleSheet("color: white; font-size: 14px;")
        title_label.setAlignment(Qt.AlignmentFlag.AlignTop)

        # Tambahkan widget ke layout
        layout.addWidget(value_label)
        layout.addWidget(title_label)

        return frame

    def handle_menu_change(self, index):
        if index == len(self.menu_list) - 1:  # Logout
            self.logout()
        else:
            self.main_content.setCurrentIndex(index)

    def logout(self):
        # Tampilkan dialog konfirmasi
        confirmation = QMessageBox.question(
            self,
            "Konfirmasi Logout",
            "Apakah Anda yakin ingin logout?",
            QMessageBox.StandardButton.Yes | QMessageBox.StandardButton.No,
        )

        if confirmation == QMessageBox.StandardButton.Yes:
            QApplication.quit()  # Keluar dari aplikasi

    def add_books_content(self):
        page = QWidget()
        layout = QVBoxLayout(page)
        layout.setContentsMargins(20, 20, 20, 20)

        # Layout for search widgets
        search_layout = QHBoxLayout()

        self.search_title = QLineEdit()
        self.search_title.setPlaceholderText("Cari judul...")
        self.search_title.textChanged.connect(self.filter_books)

        self.search_author = QLineEdit()
        self.search_author.setPlaceholderText("Cari pengarang...")
        self.search_author.textChanged.connect(self.filter_books)

        search_layout.addWidget(self.search_title)
        search_layout.addWidget(self.search_author)
        layout.addLayout(search_layout)

        # Tambah button
        add_btn = QPushButton("Tambah Buku")
        add_btn.setStyleSheet(
            """
            QPushButton {
                background-color: #4CAF50;
                color: white;
                font-size: 14px;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
            }
            QPushButton:hover {
                background-color: #45a049;
            }
        """
        )
        add_btn.setObjectName("addBookBtn")
        add_btn.clicked.connect(self.add_buku)
        layout.addWidget(add_btn, alignment=Qt.AlignmentFlag.AlignRight)

        # Table kolom
        self.table_buku = QTableWidget()
        self.table_buku.setColumnCount(4)
        self.table_buku.setHorizontalHeaderLabels(
            ["Judul", "Pengarang", "Deskripsi", "Aksi"]
        )

        # Set column width
        self.table_buku.setColumnWidth(0, 150)  # Judul
        self.table_buku.setColumnWidth(1, 150)  # Pengarang
        self.table_buku.setColumnWidth(2, 300)  # Deskripsi
        self.table_buku.setColumnWidth(3, 210)  # Aksi

        self.table_buku.setSelectionBehavior(QTableWidget.SelectionBehavior.SelectRows)
        self.table_buku.setAlternatingRowColors(True)
        layout.addWidget(self.table_buku)

        self.refresh_table()
        self.main_content.addWidget(page)

    def filter_books(self):
        search_title = self.search_title.text().lower()
        search_author = self.search_author.text().lower()

        for row in range(self.table_buku.rowCount()):
            title_item = self.table_buku.item(row, 0)
            author_item = self.table_buku.item(row, 1)

            if title_item and author_item:
                title = title_item.text().lower()
                author = author_item.text().lower()

                title_match = search_title in title
                author_match = search_author in author

                # Show row if both title and author match the search criteria
                self.table_buku.setRowHidden(row, not (title_match and author_match))

    def add_buku(self):
        dialog = EditBukuDialog(self)
        if dialog.exec() == QDialog.DialogCode.Accepted:
            data = dialog.get_data()
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute(
                """
                INSERT INTO buku (judul, pengarang, deskripsi)
                VALUES (?, ?, ?)
            """,
                (data["judul"], data["pengarang"], data["deskripsi"]),
            )
            conn.commit()
            conn.close()
            self.refresh_table()
            self.update_dashboard()  # Add dashboard update

    def refresh_table(self):
        self.table_buku.setRowCount(0)
        conn = sqlite3.connect("perpustakaan.sqlite")
        cursor = conn.cursor()
        cursor.execute("SELECT * FROM buku")

        for row_num, row_data in enumerate(cursor.fetchall()):
            self.table_buku.insertRow(row_num)

            # start dari kolom index 1
            for col_num, col_data in enumerate(row_data[1:], 0):
                item = QTableWidgetItem(str(col_data))
                item.setFlags(
                    item.flags() & ~Qt.ItemFlag.ItemIsEditable
                )  # Make read-only
                self.table_buku.setItem(row_num, col_num, item)

            action_widget = QWidget()
            action_widget.setObjectName("actionWidget")
            action_layout = QHBoxLayout()
            action_layout.setContentsMargins(4, 4, 4, 4)
            action_layout.setSpacing(8)

            # Edit button
            edit_btn = QPushButton()
            edit_btn.setObjectName("editBtn")
            edit_btn.setText("Edit")
            edit_btn.setCursor(Qt.CursorShape.PointingHandCursor)

            # Delete button
            delete_btn = QPushButton()
            delete_btn.setObjectName("deleteBtn")
            delete_btn.setText("Hapus")
            delete_btn.setCursor(Qt.CursorShape.PointingHandCursor)

            # Connect button signals
            edit_btn.clicked.connect(lambda _, id=row_data[0]: self.edit_buku(id))
            delete_btn.clicked.connect(lambda _, id=row_data[0]: self.delete_buku(id))

            # Add buttons to layout
            action_layout.addStretch()
            action_layout.addWidget(edit_btn)
            action_layout.addWidget(delete_btn)
            action_layout.addStretch()

            action_widget.setLayout(action_layout)
            self.table_buku.setCellWidget(row_num, 3, action_widget)

        conn.close()

    def delete_buku(self, buku_id):
        confirmation = QMessageBox.question(
            self,
            "Konfirmasi Hapus",
            "Apakah Anda yakin ingin menghapus buku ini?",
            QMessageBox.StandardButton.Yes | QMessageBox.StandardButton.No,
        )

        if confirmation == QMessageBox.StandardButton.Yes:
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute("DELETE FROM buku WHERE id_buku=?", (buku_id,))
            conn.commit()
            conn.close()
            self.refresh_table()
            self.update_dashboard()

    def edit_buku(self, buku_id):
        conn = sqlite3.connect("perpustakaan.sqlite")
        cursor = conn.cursor()
        cursor.execute("SELECT * FROM buku WHERE id_buku=?", (buku_id,))
        buku = cursor.fetchone()
        conn.close()

        dialog = EditBukuDialog(self, buku_id)
        dialog.set_data(buku[1], buku[2], buku[3])

        if dialog.exec() == QDialog.DialogCode.Accepted:
            data = dialog.get_data()
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute(
                """
                UPDATE buku 
                SET judul=?, pengarang=?, deskripsi=?
                WHERE id_buku=?
            """,
                (data["judul"], data["pengarang"], data["deskripsi"], buku_id),
            )
            conn.commit()
            conn.close()
            self.refresh_table()
            self.update_dashboard()  # Add dashboard update

    def update_dashboard(self):
        # Get current stats
        conn = sqlite3.connect("perpustakaan.sqlite")
        cursor = conn.cursor()

        # Get total books and members
        cursor.execute("SELECT COUNT(*) FROM buku")
        total_books = cursor.fetchone()[0]

        cursor.execute("SELECT COUNT(*) FROM member")
        total_members = cursor.fetchone()[0]

        cursor.execute(
            "SELECT COUNT(*) FROM transaksi_peminjaman WHERE status = 'meminjam'"
        )
        total_borrowed_books = cursor.fetchone()[0]

        cursor.execute(
            "SELECT COUNT(*) FROM transaksi_peminjaman WHERE status = 'dikembalikan'"
        )
        total_returned_books = cursor.fetchone()[0]

        conn.close()

        # Update dashboard widgets
        dashboard_widget = self.main_content.widget(0)
        if dashboard_widget:
            stats_layout = dashboard_widget.layout().itemAt(0).layout()

            # Update book count
            stats_layout.itemAt(0).widget().findChild(QLabel).setText(str(total_books))
            # Update member count
            stats_layout.itemAt(1).widget().findChild(QLabel).setText(
                str(total_members)
            )
            # Update borrowed books count
            stats_layout.itemAt(2).widget().findChild(QLabel).setText(
                str(total_borrowed_books)
            )
            # Update returned books count
            stats_layout.itemAt(3).widget().findChild(QLabel).setText(
                str(total_returned_books)
            )

    def update_query(self, s=None):
        # Get the text values from the widgets.
        track = self.track.text()
        composer = self.composer.text()

        try:
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute(
                "SELECT judul, pengarang FROM buku WHERE judul LIKE ? AND pengarang LIKE ?",
                (f"%{track}%", f"%{composer}%"),
            )
            # Handle results if needed
            conn.close()
        except sqlite3.Error as e:
            print(f"Database error: {e}")
            QMessageBox.critical(self, "Error", "Failed to query database")

    def add_members_content(self):
        page = QWidget()
        layout = QVBoxLayout(page)
        layout.setContentsMargins(20, 20, 20, 20)

        # Tambah button
        add_btn = QPushButton("Tambah Member")
        add_btn.setStyleSheet(
            """
            QPushButton {
                background-color: #4CAF50;
                color: white;
                font-size: 14px;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
            }
            QPushButton:hover {
                background-color: #45a049;
            }
        """
        )
        add_btn.setObjectName("addMemberBtn")
        add_btn.clicked.connect(self.add_member)
        layout.addWidget(add_btn, alignment=Qt.AlignmentFlag.AlignRight)

        # Table kolom
        self.table_member = QTableWidget()
        self.table_member.setColumnCount(5)
        self.table_member.setHorizontalHeaderLabels(
            ["Nama", "No HP", "Gender", "PIN", "Aksi"]
        )

        # Set column width
        self.table_member.setColumnWidth(0, 150)  # Nama
        self.table_member.setColumnWidth(1, 150)  # No HP
        self.table_member.setColumnWidth(2, 150)  # Gender
        self.table_member.setColumnWidth(3, 150)  # PIN
        self.table_member.setColumnWidth(4, 210)  # Aksi

        self.table_member.setSelectionBehavior(
            QTableWidget.SelectionBehavior.SelectRows
        )
        self.table_member.setAlternatingRowColors(True)
        layout.addWidget(self.table_member)

        self.refresh_member_table()
        self.main_content.addWidget(page)

    def refresh_member_table(self):
        self.table_member.setRowCount(0)
        conn = sqlite3.connect("perpustakaan.sqlite")
        cursor = conn.cursor()
        cursor.execute("SELECT * FROM member")

        for row_num, row_data in enumerate(cursor.fetchall()):
            self.table_member.insertRow(row_num)

            # start dari kolom index 1
            for col_num, col_data in enumerate(row_data[1:], 0):
                self.table_member.setItem(
                    row_num, col_num, QTableWidgetItem(str(col_data))
                )

            action_widget = QWidget()
            action_widget.setObjectName("actionWidget")
            action_layout = QHBoxLayout()
            action_layout.setContentsMargins(4, 4, 4, 4)
            action_layout.setSpacing(8)

            # Edit button
            edit_btn = QPushButton()
            edit_btn.setObjectName("editBtn")
            edit_btn.setText("Edit")
            edit_btn.setCursor(Qt.CursorShape.PointingHandCursor)

            # Delete button
            delete_btn = QPushButton()
            delete_btn.setObjectName("deleteBtn")
            delete_btn.setText("Hapus")
            delete_btn.setCursor(Qt.CursorShape.PointingHandCursor)

            # Connect signals
            edit_btn.clicked.connect(lambda _, id=row_data[0]: self.edit_member(id))
            delete_btn.clicked.connect(lambda _, id=row_data[0]: self.delete_member(id))

            # Add buttons to layout
            action_layout.addStretch()
            action_layout.addWidget(edit_btn)
            action_layout.addWidget(delete_btn)
            action_layout.addStretch()

            action_widget.setLayout(action_layout)
            self.table_member.setCellWidget(row_num, 4, action_widget)

        conn.close()

    def add_member(self):
        dialog = EditMemberDialog(self)
        if dialog.exec() == QDialog.DialogCode.Accepted:
            data = dialog.get_data()

            # Check if PIN already exists
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute("SELECT COUNT(*) FROM member WHERE pin=?", (data["pin"],))

            cursor.execute(
                """
                INSERT INTO member (nama_member, no_hp_member, gender_member, pin)
                VALUES (?, ?, ?, ?)
            """,
                (
                    data["nama_member"],
                    data["no_hp_member"],
                    data["gender_member"],
                    data["pin"],
                ),
            )
            conn.commit()
            conn.close()
            self.refresh_member_table()
            self.update_dashboard()

    def edit_member(self, id_member):
        conn = sqlite3.connect("perpustakaan.sqlite")
        cursor = conn.cursor()
        cursor.execute("SELECT * FROM member WHERE id_member=?", (id_member,))
        member = cursor.fetchone()
        conn.close()

        dialog = EditMemberDialog(self, id_member)
        dialog.set_data(member[1], member[2], member[3], member[4])

        if dialog.exec() == QDialog.DialogCode.Accepted:
            data = dialog.get_data()
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute(
                """
                UPDATE member
                SET nama_member=?, no_hp_member=?, gender_member=?, pin=?
                WHERE id_member=?
            """,
                (
                    data["nama_member"],
                    data["no_hp_member"],
                    data["gender_member"],
                    data["pin"],
                    id_member,
                ),
            )
            conn.commit()
            conn.close()
            self.refresh_member_table()
            self.update_dashboard()

    def delete_member(self, id_member):
        confirmation = QMessageBox.question(
            self,
            "Konfirmasi Hapus",
            "Apakah Anda yakin ingin menghapus member ini?",
            QMessageBox.StandardButton.Yes | QMessageBox.StandardButton.No,
        )

        if confirmation == QMessageBox.StandardButton.Yes:
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute("DELETE FROM member WHERE id_member=?", (id_member,))
            conn.commit()
            conn.close()
            self.refresh_member_table()
            self.update_dashboard()

    def add_Transaction_content(self):
        page = QWidget()
        layout = QVBoxLayout(page)
        layout.setContentsMargins(20, 20, 20, 20)
        add_btn = QPushButton("Add Transaction")
        add_btn.setStyleSheet(
            """
            QPushButton {
                background-color: #4CAF50;
                color: white;
                font-size: 14px;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
            }
            QPushButton:hover {
                background-color: #45a049;
            }
        """
        )
        add_btn.setObjectName("addTransactionBtn")
        add_btn.clicked.connect(self.add_Transaction)
        layout.addWidget(add_btn, alignment=Qt.AlignmentFlag.AlignRight)
        self.table_Transaction = QTableWidget()
        self.table_Transaction.setColumnCount(8)
        self.table_Transaction.setHorizontalHeaderLabels(
            [
                "ID Transaksi",
                "Nama Member",
                "Nama Buku",
                "Harga",
                "Tanggal Pinjam",
                "Tanggal Kembali",
                "Status",
                "Aksi",
            ]
        )
        column_widths = [100, 150, 200, 100, 100, 120, 120, 210]
        for i, width in enumerate(column_widths):
            self.table_Transaction.setColumnWidth(i, width)
        self.table_Transaction.setSelectionBehavior(
            QTableWidget.SelectionBehavior.SelectRows
        )
        self.table_Transaction.setAlternatingRowColors(True)
        layout.addWidget(self.table_Transaction)
        self.refresh_Transaction_table()
        self.main_content.addWidget(page)

    def refresh_Transaction_table(self):
        self.table_Transaction.setRowCount(0)
        conn = sqlite3.connect("perpustakaan.sqlite")
        cursor = conn.cursor()
        cursor.execute(
            """
            SELECT t.id_transaksi_peminjaman, m.nama_member, b.judul, 
                d.harga, t.tanggal_pinjam, t.tanggal_kembali, t.status
            FROM transaksi_peminjaman t
            JOIN durasi d ON t.id_durasi = d.id_durasi
            JOIN member m ON t.id_member = m.id_member 
            JOIN buku b ON t.id_buku = b.id_buku
        """
        )
        for row_num, row_data in enumerate(cursor.fetchall()):
            self.table_Transaction.insertRow(row_num)
            for col_num, col_data in enumerate(row_data):
                item = QTableWidgetItem(str(col_data))
                item.setFlags(item.flags() & ~Qt.ItemFlag.ItemIsEditable)
                self.table_Transaction.setItem(row_num, col_num, item)
            action_widget = QWidget()
            action_layout = QHBoxLayout(action_widget)
            action_layout.setContentsMargins(4, 4, 4, 4)
            action_layout.setSpacing(8)

            edit_btn = QPushButton("Edit")
            return_btn = QPushButton("Return")
            delete_btn = QPushButton("Delete")

            if row_data[6] == "dikembalikan":
                return_btn.setEnabled(False)
                
            for btn in [edit_btn, return_btn, delete_btn]:
                btn.setFixedWidth(60)
                btn.setCursor(Qt.CursorShape.PointingHandCursor)
            transaction_id = row_data[0]
            edit_btn.clicked.connect(
                lambda _, id=transaction_id: self.edit_Transaction(id)
            )
            return_btn.clicked.connect(
                lambda _, id=transaction_id: self.return_book(id)
            )
            delete_btn.clicked.connect(
                lambda _, id=transaction_id: self.delete_Transaction(id)
            )
            action_layout.addWidget(edit_btn)
            action_layout.addWidget(return_btn)
            action_layout.addWidget(delete_btn)
            action_layout.addStretch()

            if row_data[6] == "dikembalikan":
                return_btn.setEnabled(False)
            self.table_Transaction.setCellWidget(row_num, 7, action_widget)
        conn.close()

    def return_book(self, transaction_id):
        confirmation = QMessageBox.question(
            self,
            "Konfirmasi Pengembalian",
            "Apakah Anda yakin ingin mengembalikan buku ini?",
            QMessageBox.StandardButton.Yes | QMessageBox.StandardButton.No,
        )
        if confirmation == QMessageBox.StandardButton.Yes:
            try:
                conn = sqlite3.connect("perpustakaan.sqlite")
                cursor = conn.cursor()
                cursor.execute(
                    """
                    UPDATE transaksi_peminjaman
                    SET status = 'dikembalikan'
                    WHERE id_transaksi_peminjaman = ?
                """,
                    (transaction_id,),
                )
                conn.commit()
            except sqlite3.Error as e:
                QMessageBox.critical(self, "Error", f"Gagal mengupdate status: {e}")
            finally:
                conn.close()
            self.refresh_Transaction_table()
            self.update_dashboard()
            QMessageBox.information(
                self,
                "Sukses",
                "Status buku berhasil diperbarui menjadi 'Buku Dikembalikan'.",
            )

    def add_Transaction(self):
        conn = sqlite3.connect("perpustakaan.sqlite")
        cursor = conn.cursor()
        cursor.execute("SELECT id_member, nama_member FROM member")
        members = cursor.fetchall()
        cursor.execute("SELECT id_buku, judul FROM buku")
        books = cursor.fetchall()
        cursor.execute("SELECT id_durasi, jumlah_hari, harga FROM durasi")
        durasi = cursor.fetchall()

        conn.close()

        dialog = EditTransactionDialog(
            self, members=members, books=books, durasi=durasi
        )
        if dialog.exec() == QDialog.DialogCode.Accepted:
            data = dialog.get_data()
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute(
                """
                INSERT INTO transaksi_peminjaman 
                (id_member, id_buku, id_durasi, tanggal_pinjam, tanggal_kembali, status)
                VALUES (?, ?, ?, ?, ?, ?)
            """,
                (
                    data["id_member"],
                    data["id_buku"],
                    data["id_durasi"],
                    data["tanggal_pinjam"],
                    data["tanggal_kembali"],
                    data["status"],
                ),
            )
            conn.commit()
            conn.close()

            QMessageBox.information(
                self,
                "Sukses",
                "Transaksi berhasil ditambahkan!",
                QMessageBox.StandardButton.Ok,
            )

            self.refresh_Transaction_table()
            self.update_dashboard()  # Refresh dashboard

    def edit_Transaction(self, id_transaksi_peminjaman):
        conn = sqlite3.connect("perpustakaan.sqlite")
        cursor = conn.cursor()
        cursor.execute(
            "SELECT * FROM transaksi_peminjaman WHERE id_transaksi_peminjaman=?",
            (id_transaksi_peminjaman,),
        )
        Transaction = cursor.fetchone()
        cursor.execute("SELECT id_member, nama_member FROM member")
        members = cursor.fetchall()
        cursor.execute("SELECT id_buku, judul FROM buku")
        books = cursor.fetchall()
        cursor.execute("SELECT id_durasi, jumlah_hari, harga FROM durasi")
        durasi = cursor.fetchall()
        conn.close()

        dialog = EditTransactionDialog(
            self, id_transaksi_peminjaman, members=members, books=books, durasi=durasi
        )
        dialog.set_data(
            Transaction[1],  # id_member
            Transaction[2],  # id_buku
            Transaction[3],  # id_durasi
            Transaction[4],  # tanggal_pinjam
            Transaction[5],  # tanggal_kembali
            Transaction[6],  # status
        )

        if dialog.exec() == QDialog.DialogCode.Accepted:
            data = dialog.get_data()
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute(
                """
                UPDATE transaksi_peminjaman
                SET id_member=?, id_buku=?, id_durasi=?, tanggal_pinjam=?, tanggal_kembali=?, status=?
                WHERE id_transaksi_peminjaman=?
            """,
                (
                    data["id_member"],
                    data["id_buku"],
                    data["id_durasi"],
                    data["tanggal_pinjam"],
                    data["tanggal_kembali"],
                    data["status"],
                    id_transaksi_peminjaman,
                ),
            )
            conn.commit()
            conn.close()
            self.refresh_Transaction_table()
            self.update_dashboard()  # Refresh dashboard

    def delete_Transaction(self, id_transaksi_peminjaman):
        confirmation = QMessageBox.question(
            self,
            "Confirmation",
            "Are you sure you want to delete this Transaction?",
            QMessageBox.StandardButton.Yes | QMessageBox.StandardButton.No,
        )

        if confirmation == QMessageBox.StandardButton.Yes:
            conn = sqlite3.connect("perpustakaan.sqlite")
            cursor = conn.cursor()
            cursor.execute(
                "DELETE FROM transaksi_peminjaman WHERE id_transaksi_peminjaman=?",
                (id_transaksi_peminjaman,),
            )
            conn.commit()
            conn.close()
            self.refresh_Transaction_table()
            self.update_dashboard()  # Refresh dashboard


def main():
    login_dialog = LoginDialog()
    if login_dialog.exec() == QDialog.DialogCode.Accepted:
        # Jika login berhasil, buka MainWindow
        window = MainWindow()
        window.show()
        app.exec()


if __name__ == "__main__":
    app = QApplication(sys.argv)
    # Load style file
    with open("style/style.qss") as f:
        style_str = f.read()
    app.setStyleSheet(style_str)
    # Jalankan aplikasi
    main()
