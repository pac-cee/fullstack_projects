contacts = {}
while True:
    action = input("Add (a), Lookup (l), or Quit (q): ").strip().lower()
    if action == 'a':
        name = input("Enter name: ")
        phone = input("Enter phone: ")
        contacts[name] = phone
        print("Contact added.")
    elif action == 'l':
        name = input("Enter name to lookup: ")
        phone = contacts.get(name, "Not found.")
        print(f"Phone: {phone}")
    elif action == 'q':
        break
    else:
        print("Unknown action.")
