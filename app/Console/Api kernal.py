class Student:
    def __init__(self, student_id, name, age):
        self.student_id = student_id
        self.name = name
        self.age = age

    def __str__(self):
        return f"Student ID: {self.student_id}, Name: {self.name}, Age: {self.age}"




# Example usage
if __name__ == "__main__":
    sms = StudentManagementSystem()

    # Add students
    student1 = Student(1, "Alice", 20)
    student2 = Student(2, "Bob", 22)
    student3 = Student(3, "Charlie", 21)

    sms.add_student(student1)
    sms.add_student(student2)
    sms.add_student(student3)

    # Display all students
    print("All Students:")
    sms.display_all_students()

    # Get student by ID
    student = sms.get_student(2)
    if student:
        print("\nStudent found:")
        print(student)
    else:
        print("\nStudent not found.")

    # Add a new student
    new_student = Student(4, "David", 23)
    sms.add_student(new_student)

    # Display all students after adding a new student
    print("\nAll Students after adding a new student:")
    sms.display_all_students()
