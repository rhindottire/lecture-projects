class TodoModel:
    def __init__(self):
        self.__tasks = [] 

    def add_task(self, task):
        if task not in self.__tasks:
            self.__tasks.append(task)
            return True
        return False

    def remove_task(self, task):
        if task in self.__tasks:
            self.__tasks.remove(task)
            return True
        return False

    def get_tasks(self):
        return self.__tasks
