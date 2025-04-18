filename = input("Enter filename: ")
try:
    with open(filename, 'r') as f:
        lines = f.readlines()
    print(f"Line count: {len(lines)}")
except FileNotFoundError:
    print("File not found.")
