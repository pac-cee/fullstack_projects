import os

path = input("Enter directory path: ")
try:
    items = os.listdir(path)
    print("Contents:")
    for item in items:
        print(item)
except FileNotFoundError:
    print("Directory not found.")
