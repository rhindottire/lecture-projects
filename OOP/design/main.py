import sys
from PyQt5.QtWidgets import QApplication
from Model.model import TodoModel
from View.view import TodoView
from Controller.controller import TodoController

if __name__ == "__main__":
    app = QApplication(sys.argv)

    model = TodoModel()
    view = TodoView()
    controller = TodoController(model, view)
    
    view.show()
    sys.exit(app.exec_())
