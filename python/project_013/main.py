num = int(input("Enter a number: "))
if num < 2:
    print(f"{num} is not prime.")
else:
    for i in range(2, int(num ** 0.5) + 1):
        if num % i == 0:
            print(f"{num} is not prime.")
            break
    else:
        print(f"{num} is prime.")
