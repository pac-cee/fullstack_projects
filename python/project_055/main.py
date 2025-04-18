import time

work = 25 * 60  # 25 minutes
break_ = 5 * 60  # 5 minutes

print("Pomodoro started! Work for 25 minutes.")
time.sleep(work)
print("Time for a 5-minute break!")
time.sleep(break_)
print("Pomodoro cycle complete!")
