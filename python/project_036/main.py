import os

dirname = input("Enter directory name to create: ")
try:
    os.mkdir(dirname)
    print(f"Directory '{dirname}' created.")
except FileExistsError:
    print("Directory already exists.")
except Exception as e:
    print(f"Error: {e}")
