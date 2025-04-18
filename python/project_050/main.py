import random
import string

count = int(input("How many passwords to generate? "))
length = int(input("Password length: "))
chars = string.ascii_letters + string.digits + string.punctuation
for i in range(count):
    password = ''.join(random.choice(chars) for _ in range(length))
    print(f"Password {i+1}: {password}")
