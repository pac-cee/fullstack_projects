import random

sides = int(input("Enter number of sides on the die: "))
rolls = int(input("Enter number of rolls: "))
results = [random.randint(1, sides) for _ in range(rolls)]
print(f"Results: {results}")
