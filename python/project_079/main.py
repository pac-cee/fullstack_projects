import zipfile

zip_name = input("Enter ZIP archive name: ")
try:
    with zipfile.ZipFile(zip_name, 'r') as zipf:
        zipf.extractall()
        print(f"Extracted all files from '{zip_name}'.")
except FileNotFoundError:
    print("ZIP file not found.")
except zipfile.BadZipFile:
    print("Invalid ZIP file.")
