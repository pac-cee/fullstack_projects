import os

old_name = input("Enter current filename: ")
new_name = input("Enter new filename: ")
try:
    os.rename(old_name, new_name)
    print(f"Renamed {old_name} to {new_name}")
except FileNotFoundError:
    print("File not found.")
except Exception as e:
    print(f"Error: {e}")
