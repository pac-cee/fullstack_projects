import tarfile

tar_name = input("Enter TAR archive name: ")
try:
    with tarfile.open(tar_name, 'r') as tar:
        tar.extractall()
        print(f"Extracted all files from '{tar_name}'.")
except FileNotFoundError:
    print("TAR file not found.")
except tarfile.ReadError:
    print("Invalid TAR file.")
