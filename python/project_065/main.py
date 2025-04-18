import json

filename = input("Enter JSON filename: ")
data = {}
while True:
    key = input("Enter key (or 'quit' to finish): ")
    if key.strip().lower() == 'quit':
        break
    value = input("Enter value: ")
    data[key] = value
with open(filename, 'w') as f:
    json.dump(data, f, indent=4)
print(f"JSON file '{filename}' written.")
