import os

dir_path = input("Enter directory path: ")
ext = input("Enter file extension (e.g., .txt): ")
try:
    files = [f for f in os.listdir(dir_path) if f.endswith(ext)]
    print(f"Files with extension {ext}:")
    for file in files:
        print(file)
except FileNotFoundError:
    print("Directory not found.")
