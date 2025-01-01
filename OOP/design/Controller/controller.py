from PyQt5.QtWidgets import QMessageBox

class TodoController:
    def __init__(self, model, view):
        self.__model = model
        self.__view = view

        self.__view.add_button.clicked.connect(self.handle_add_task)
        self.__view.delete_button.clicked.connect(self.handle_delete_task)
    
        self.update_task_list()

    def handle_add_task(self):
        task = self.__view.task_input.text().strip()
        if task:
            if self.__model.add_task(task):
                self.update_task_list()
                self.__view.task_input.clear()
            else:
                QMessageBox.warning(self.__view, "Warning", "Task already exists!")
        else:
            QMessageBox.warning(self.__view, "Warning", "Task cannot be empty!")

    def handle_delete_task(self):
        selected_items = self.__view.task_list.selectedItems()
        if not selected_items:
            QMessageBox.warning(self.__view, "Warning", "No task selected!")
            return

        for item in selected_items:
            task = item.text()
            self.__model.remove_task(task)

        self.update_task_list()

    def update_task_list(self):
        self.__view.task_list.clear()
        tasks = self.__model.get_tasks()
        self.__view.task_list.addItems(tasks)
