string = input("Enter a string: ")
vowels = 'aeiouAEIOU'
count = sum(1 for c in string if c in vowels)
print(f"Number of vowels: {count}")
