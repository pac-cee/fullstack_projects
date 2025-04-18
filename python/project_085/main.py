import os

dir_path = input("Enter directory path: ")
outfile = input("Enter output filename: ")
try:
    items = os.listdir(dir_path)
    with open(outfile, 'w') as f:
        for item in items:
            f.write(item + '\n')
    print(f"Directory listing written to '{outfile}'.")
except FileNotFoundError:
    print("Directory not found.")
