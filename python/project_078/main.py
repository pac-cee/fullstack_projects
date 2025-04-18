import zipfile

zip_name = input("Enter ZIP archive name: ")
files = input("Enter filenames to add, separated by commas: ").split(',')
files = [f.strip() for f in files if f.strip()]
with zipfile.ZipFile(zip_name, 'w') as zipf:
    for file in files:
        try:
            zipf.write(file)
            print(f"Added {file}")
        except FileNotFoundError:
            print(f"File not found: {file}")
print(f"Created ZIP archive '{zip_name}'.")
