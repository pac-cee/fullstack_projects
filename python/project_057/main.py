from datetime import datetime

date_str = input("Enter a date (YYYY-MM-DD): ")
try:
    dt = datetime.strptime(date_str, "%Y-%m-%d")
    print(f"{date_str} is a {dt.strftime('%A')}")
except ValueError:
    print("Invalid date format.")
