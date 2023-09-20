class Student:
    def __init__(self, student_id, name, age):
        self.student_id = student_id
        self.name = name
        self.age = age

    def __str__(self):
        return f"Student ID: {self.student_id}, Name: {self.name}, Age: {self.age}"


class StudentManagementSystem:
    def __init__(self):
        self.students = {}

    def add_student(self, student):
        self.students[student.student_id] = student

    def get_student(self, student_id):
        return self.students.get(student_id)

    def display_all_students(self):
        for student_id, student in self.students.items():
            print(student)

    def display_student(self, student_id):
        student = self.get_student(student_id)
        if student:
            print(student)
        else:
            print("Student not found.")


class Admin:
    def __init__(self, username, password):
        self.username = username
        self.password = password

    def authenticate(self, username, password):
        return self.username == username and self.password == password

class teacher:
    def __init__(self, username, password):
        self.username = username
        self.password = password

    def authenticate(self, username, password):
        return self.username == username and self.password == password


# Example usage
if __name__ == "__main__":
    # Create a student management system
    sms = StudentManagementSystem()

    # Add students
    # student1 = Student(1, "Alice", 20)
    # student2 = Student(2, "Bob", 22)
    # student3 = Student(3, "Charlie", 21)

    sms.teacher(teacher1)
    sms.add_student(student2)
    sms.add_student(student3)

    # Create an admin
    admin = Admin("admin", "password")

    # Admin authentication
    username = input("Enter admin username: ")
    password = input("Enter admin password: ")

    if admin.authenticate(username, password):
        print("Admin authentication successful.")

        # Display all students
        print("\nAll Students:")
        sms.display_all_students()

        # Display a specific student
        student_id = int(input("\nEnter student ID to display: "))
        sms.display_student(student_id)

    else:
        print("Admin authentication failed.")
# 




