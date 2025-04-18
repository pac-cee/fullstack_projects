import random

number = random.randint(1, 100)
attempts = 0
max_attempts = 7
print("Guess the number between 1 and 100! You have 7 attempts.")
while attempts < max_attempts:
    guess = int(input("Your guess: "))
    attempts += 1
    if guess < number:
        print("Too low!")
    elif guess > number:
        print("Too high!")
    else:
        print(f"Correct! You win in {attempts} attempts.")
        break
else:
    print(f"Out of attempts! The number was {number}.")
