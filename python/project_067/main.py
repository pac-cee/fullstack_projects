import csv
import json

csv_file = input("Enter CSV filename: ")
json_file = input("Enter JSON filename: ")
try:
    with open(csv_file, newline='') as cf:
        reader = csv.DictReader(cf)
        data = list(reader)
    with open(json_file, 'w') as jf:
        json.dump(data, jf, indent=4)
    print(f"Converted {csv_file} to {json_file}.")
except FileNotFoundError:
    print("File not found.")
