from datetime import datetime

logfile = input("Enter log filename: ")
while True:
    msg = input("Enter log message (or 'quit' to exit): ")
    if msg.strip().lower() == 'quit':
        break
    with open(logfile, 'a') as f:
        timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        f.write(f"[{timestamp}] {msg}\n")
    print("Log entry added.")
