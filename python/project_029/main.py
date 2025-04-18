file1 = input("Enter first filename: ")
file2 = input("Enter second filename: ")
outfile = input("Enter output filename: ")
try:
    with open(file1, 'r') as f1, open(file2, 'r') as f2:
        content1 = f1.read()
        content2 = f2.read()
    with open(outfile, 'w') as fout:
        fout.write(content1 + '\n' + content2)
    print(f"Merged {file1} and {file2} into {outfile}")
except FileNotFoundError as e:
    print(f"File not found: {e.filename}")
