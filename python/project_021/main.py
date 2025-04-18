dictionary = {
    "python": "A high-level programming language.",
    "variable": "A storage location paired with a name.",
    "function": "A block of code that performs a specific task."
}
word = input("Enter a word: ").lower()
meaning = dictionary.get(word, "Word not found in dictionary.")
print(meaning)
