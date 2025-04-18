import re

email = input("Enter email address: ")
pattern = r'^[\w\.-]+@[\w\.-]+\.\w{2,}$'
if re.match(pattern, email):
    print("Valid email address.")
else:
    print("Invalid email address.")
