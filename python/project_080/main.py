import tarfile

tar_name = input("Enter TAR archive name: ")
files = input("Enter filenames to add, separated by commas: ").split(',')
files = [f.strip() for f in files if f.strip()]
with tarfile.open(tar_name, 'w') as tar:
    for file in files:
        try:
            tar.add(file)
            print(f"Added {file}")
        except FileNotFoundError:
            print(f"File not found: {file}")
print(f"Created TAR archive '{tar_name}'.")
