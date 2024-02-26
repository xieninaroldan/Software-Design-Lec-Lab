import tkinter as tk
from tkinter import messagebox
from PIL import Image, ImageTk
import random

class MultiplicationApp:
    def __init__(self, root):
        self.root = root
        self.root.title("Multiplication Learning Game")
        self.root.geometry("400x300")  # Set the size of the window
        self.root.configure(bg="black")  # Set the background color

        # Load and set the background image
        bg_image = Image.open("bg.jpg")  # Replace with your image file
        self.background_image = ImageTk.PhotoImage(bg_image)
        self.bg_label = tk.Label(root, image=self.background_image)
        self.bg_label.place(relwidth=1, relheight=1)

        self.score = 0
        self.max_score = 50
        self.num1, self.num2 = self.generate_question()

        self.label_question = tk.Label(root, text=f"How much is {self.num1} times {self.num2}?",
                                       font=("Arial", 14), bg="lightgray")
        self.label_question.pack(pady=10)

        self.entry_answer = tk.Entry(root, font=("Arial", 12))
        self.entry_answer.pack(pady=10)

        self.button_check = tk.Button(root, text="Submit Answer", command=self.check_answer,
                                      font=("Arial", 12), bg="green", fg="white")
        self.button_check.pack(pady=10)

        self.label_result = tk.Label(root, text="", font=("Arial", 12), bg="lightgray", fg="black")
        self.label_result.pack(pady=10)

    def generate_question(self):
        num1 = random.randint(1, 9)
        num2 = random.randint(1, 9)
        return num1, num2

    def check_answer(self):
        user_answer = self.entry_answer.get()

        try:
            user_answer = int(user_answer)
        except ValueError:
            messagebox.showerror("Error", "Please enter a valid number.")
            return

        correct_answer = self.num1 * self.num2

        if user_answer == correct_answer:
            self.show_result("You are correct!", "green")
            print("You are correct!")
            self.score += 5
            if self.score < self.max_score:
                self.num1, self.num2 = self.generate_question()
                self.label_question.config(text=f"How much is {self.num1} times {self.num2}?")
                self.label_result.config(text="", bg="lightgray")  # Clear the result label for the next question
            else:
                messagebox.showinfo("Congratulations", "You've reached the maximum score.")
                self.entry_answer.config(state=tk.DISABLED)
                self.button_check.config(state=tk.DISABLED)
        else:
            self.show_result("Incorrect. Please try again.", "red")
            print("Incorrect. Please try again.")
            self.score = max(0, self.score - 5)

        self.label_result.config(text=f"Score: {self.score}")

    def show_result(self, message, color):
        self.label_result.config(text=message, fg=color, bg="lightgray")

if __name__ == "__main__":
    root = tk.Tk()
    app = MultiplicationApp(root)
    root.mainloop()
