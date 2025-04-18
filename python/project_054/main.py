import time
from datetime import datetime

try:
    while True:
        now = datetime.now().strftime("%H:%M:%S")
        print(now, end='\r')
        time.sleep(1)
except KeyboardInterrupt:
    print("\nClock stopped.")
