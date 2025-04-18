import os
import time

filename = input("Enter filename to watch: ")
try:
    last_mtime = os.path.getmtime(filename)
    print(f"Watching '{filename}' for changes. Press Ctrl+C to stop.")
    while True:
        time.sleep(1)
        mtime = os.path.getmtime(filename)
        if mtime != last_mtime:
            print(f"File '{filename}' was modified.")
            last_mtime = mtime
except FileNotFoundError:
    print("File not found.")
except KeyboardInterrupt:
    print("\nStopped watching.")
