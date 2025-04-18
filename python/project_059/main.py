import time

input("Press Enter to start the stopwatch...")
laps = []
start = time.time()
last_lap = start
while True:
    action = input("Press Enter to record a lap, or type 'stop' to finish: ")
    if action.strip().lower() == 'stop':
        break
    now = time.time()
    lap_time = now - last_lap
    laps.append(lap_time)
    print(f"Lap {len(laps)}: {lap_time:.2f} seconds")
    last_lap = now
end = time.time()
total = end - start
print(f"Total time: {total:.2f} seconds")
for idx, lap in enumerate(laps, 1):
    print(f"Lap {idx}: {lap:.2f} seconds")
