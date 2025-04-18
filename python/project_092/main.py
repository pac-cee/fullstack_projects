"""
Project 092: Basic Random Password Generator
This script generates a random password of specified length with letters, digits, and punctuation.
"""
import string
import random

def generate_password(length=12):
    chars = string.ascii_letters + string.digits + string.punctuation
    return ''.join(random.choices(chars, k=length))

def main():
    try:
        length = int(input("Enter desired password length (default 12): ") or 12)
        if length < 4:
            print("Password length should be at least 4.")
            return
    except ValueError:
        print("Invalid input.")
        return
    password = generate_password(length)
    print(f"Generated password: {password}")

if __name__ == "__main__":
    main()
