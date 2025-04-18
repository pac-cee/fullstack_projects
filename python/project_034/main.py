import os

dir_path = input("Enter directory path: ")
filename = input("Enter filename to search for: ")
try:
    found = False
    for f in os.listdir(dir_path):
        if f == filename:
            print(f"Found: {os.path.join(dir_path, f)}")
            found = True
            break
    if not found:
        print("File not found.")
except FileNotFoundError:
    print("Directory not found.")
