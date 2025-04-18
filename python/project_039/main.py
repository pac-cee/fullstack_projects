import os
from collections import defaultdict

dir_path = input("Enter directory path: ")
ext_counts = defaultdict(int)
try:
    for filename in os.listdir(dir_path):
        if os.path.isfile(os.path.join(dir_path, filename)):
            ext = os.path.splitext(filename)[1]
            ext_counts[ext] += 1
    for ext, count in ext_counts.items():
        print(f"{ext or '[no extension]'}: {count}")
except FileNotFoundError:
    print("Directory not found.")
