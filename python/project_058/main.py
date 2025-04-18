from datetime import datetime

dob_str = input("Enter your birth date (YYYY-MM-DD): ")
try:
    dob = datetime.strptime(dob_str, "%Y-%m-%d")
    now = datetime.now()
    years = now.year - dob.year - ((now.month, now.day) < (dob.month, dob.day))
    months = now.month - dob.month
    if months < 0:
        months += 12
    days = now.day - dob.day
    if days < 0:
        last_month = now.replace(day=1) - timedelta(days=1)
        days += last_month.day
    print(f"You are {years} years, {months} months, and {days} days old.")
except ValueError:
    print("Invalid date format.")
