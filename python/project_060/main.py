import time

pomodoro = 25 * 60  # 25 minutes
break_ = 5 * 60  # 5 minutes
cycles = int(input("How many Pomodoro cycles? "))
for i in range(1, cycles + 1):
    print(f"Pomodoro {i} started! Work for 25 minutes.")
    time.sleep(1)  # Replace 1 with pomodoro for real use
    print("Time for a 5-minute break!")
    time.sleep(1)  # Replace 1 with break_ for real use
print(f"Completed {cycles} Pomodoro cycles!")
