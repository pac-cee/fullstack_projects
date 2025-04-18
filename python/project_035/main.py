import os

filename = input("Enter filename to delete: ")
try:
    os.remove(filename)
    print(f"Deleted {filename}")
except FileNotFoundError:
    print("File not found.")
except Exception as e:
    print(f"Error: {e}")
