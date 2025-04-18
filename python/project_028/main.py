src = input("Enter source filename: ")
dst = input("Enter destination filename: ")
try:
    with open(src, 'r') as fsrc:
        content = fsrc.read()
    with open(dst, 'w') as fdst:
        fdst.write(content)
    print(f"Copied contents from {src} to {dst}")
except FileNotFoundError:
    print("Source file not found.")
