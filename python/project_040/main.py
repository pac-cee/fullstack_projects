import os

filename = input("Enter filename to duplicate: ")
try:
    with open(filename, 'r') as f:
        content = f.read()
    name, ext = os.path.splitext(filename)
    new_filename = f"{name}_copy{ext}"
    with open(new_filename, 'w') as f:
        f.write(content)
    print(f"Created copy: {new_filename}")
except FileNotFoundError:
    print("File not found.")
except Exception as e:
    print(f"Error: {e}")
