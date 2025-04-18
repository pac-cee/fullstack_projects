import random

flips = int(input("Enter number of coin tosses: "))
results = [random.choice(['Heads', 'Tails']) for _ in range(flips)]
heads = results.count('Heads')
tails = results.count('Tails')
print(f"Heads: {heads}, Tails: {tails}")
