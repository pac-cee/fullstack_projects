import os

dirname = input("Enter directory name to delete: ")
try:
    os.rmdir(dirname)
    print(f"Directory '{dirname}' deleted.")
except FileNotFoundError:
    print("Directory not found.")
except OSError:
    print("Directory is not empty or cannot be deleted.")
except Exception as e:
    print(f"Error: {e}")
