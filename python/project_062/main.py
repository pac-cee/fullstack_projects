import csv

filename = input("Enter CSV filename: ")
try:
    with open(filename, newline='') as csvfile:
        reader = csv.reader(csvfile)
        for row in reader:
            print(row)
except FileNotFoundError:
    print("File not found.")
