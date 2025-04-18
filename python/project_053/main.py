import time
from datetime import datetime

alarm_time = input("Enter alarm time (HH:MM:SS, 24-hour format): ")
print(f"Alarm set for {alarm_time}. Waiting...")
while True:
    now = datetime.now().strftime("%H:%M:%S")
    if now == alarm_time:
        print("Wake up! Alarm time reached!")
        break
    time.sleep(1)
