import csv

filename = input("Enter CSV filename: ")
fields = input("Enter column names separated by commas: ").split(',')
fields = [f.strip() for f in fields]
with open(filename, 'w', newline='') as csvfile:
    writer = csv.writer(csvfile)
    writer.writerow(fields)
    while True:
        row = input(f"Enter row values for {fields} (comma separated, or 'quit' to finish): ")
        if row.strip().lower() == 'quit':
            break
        values = [v.strip() for v in row.split(',')]
        writer.writerow(values)
print(f"CSV file '{filename}' written.")
