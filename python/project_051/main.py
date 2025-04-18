import time

input("Press Enter to start the stopwatch...")
start = time.time()
input("Press Enter to stop the stopwatch...")
end = time.time()
elapsed = end - start
print(f"Elapsed time: {elapsed:.2f} seconds")
