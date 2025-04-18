choice = input("Convert from (C)elsius or (F)ahrenheit? ").strip().lower()
if choice == 'c':
    c = float(input("Enter temperature in Celsius: "))
    f = c * 9/5 + 32
    print(f"{c}°C is {f:.1f}°F")
elif choice == 'f':
    f = float(input("Enter temperature in Fahrenheit: "))
    c = (f - 32) * 5/9
    print(f"{f}°F is {c:.1f}°C")
else:
    print("Invalid choice.")
