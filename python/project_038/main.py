import os

def print_tree(path, indent=""):
    try:
        items = os.listdir(path)
        for item in items:
            full_path = os.path.join(path, item)
            print(indent + item)
            if os.path.isdir(full_path):
                print_tree(full_path, indent + "  ")
    except Exception as e:
        print(f"Error: {e}")

start_path = input("Enter directory path: ")
print_tree(start_path)
