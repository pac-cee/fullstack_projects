import random

names = input("Enter names separated by commas: ").split(',')
names = [name.strip() for name in names if name.strip()]
if names:
    print(f"Randomly selected: {random.choice(names)}")
else:
    print("No names provided.")
