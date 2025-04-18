filename = input("Enter filename: ")
try:
    with open(filename, 'r') as f:
        print(f.read())
except FileNotFoundError:
    print("File not found.")
