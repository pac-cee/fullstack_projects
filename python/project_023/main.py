grades = input("Enter grades separated by spaces: ").split()
grades = [float(g) for g in grades]
avg = sum(grades) / len(grades)
if avg >= 90:
    letter = 'A'
elif avg >= 80:
    letter = 'B'
elif avg >= 70:
    letter = 'C'
elif avg >= 60:
    letter = 'D'
else:
    letter = 'F'
print(f"Average: {avg:.2f}, Grade: {letter}")
