import os

dir_path = input("Enter directory path: ")
total_size = 0
try:
    for filename in os.listdir(dir_path):
        filepath = os.path.join(dir_path, filename)
        if os.path.isfile(filepath):
            total_size += os.path.getsize(filepath)
    print(f"Total size: {total_size} bytes")
except FileNotFoundError:
    print("Directory not found.")
