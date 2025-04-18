import json

filename = input("Enter JSON filename: ")
try:
    with open(filename, 'r') as f:
        data = json.load(f)
    print(json.dumps(data, indent=4))
except FileNotFoundError:
    print("File not found.")
except json.JSONDecodeError:
    print("Invalid JSON file.")
