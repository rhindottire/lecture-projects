from PyQt5.QtWidgets import QWidget, QVBoxLayout, QHBoxLayout, QPushButton, QListWidget, QLineEdit

class TodoView(QWidget):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("To-Do List")
        self.setGeometry(100, 100, 400, 300)

        self.layout = QVBoxLayout()

        self.task_list = QListWidget()
        self.layout.addWidget(self.task_list)

        self.input_layout = QHBoxLayout()
        self.task_input = QLineEdit()
        self.add_button = QPushButton("Add")
        self.delete_button = QPushButton("Delete")
        self.input_layout.addWidget(self.task_input)
        self.input_layout.addWidget(self.add_button)
        self.input_layout.addWidget(self.delete_button)

        self.layout.addLayout(self.input_layout)
        self.setLayout(self.layout)
