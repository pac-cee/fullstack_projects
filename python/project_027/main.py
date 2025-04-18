filename = input("Enter filename: ")
try:
    with open(filename, 'r') as f:
        text = f.read()
    words = text.split()
    freq = {}
    for word in words:
        freq[word] = freq.get(word, 0) + 1
    for word, count in freq.items():
        print(f"{word}: {count}")
except FileNotFoundError:
    print("File not found.")
