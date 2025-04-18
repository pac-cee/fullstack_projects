import json
import csv

json_file = input("Enter JSON filename: ")
csv_file = input("Enter CSV filename: ")
try:
    with open(json_file, 'r') as jf:
        data = json.load(jf)
    if not isinstance(data, list) or not all(isinstance(item, dict) for item in data):
        print("JSON must be an array of objects.")
    else:
        keys = data[0].keys()
        with open(csv_file, 'w', newline='') as cf:
            writer = csv.DictWriter(cf, fieldnames=keys)
            writer.writeheader()
            writer.writerows(data)
        print(f"Converted {json_file} to {csv_file}.")
except FileNotFoundError:
    print("File not found.")
except json.JSONDecodeError:
    print("Invalid JSON file.")
