import random

low = int(input("Enter lower bound: "))
high = int(input("Enter upper bound: "))
if low > high:
    print("Lower bound must not be greater than upper bound.")
else:
    num = random.randint(low, high)
    print(f"Random number between {low} and {high}: {num}")
