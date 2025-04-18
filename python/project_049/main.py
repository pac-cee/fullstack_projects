import random

names = input("Enter names separated by commas: ").split(',')
names = [name.strip() for name in names if name.strip()]
team_size = int(input("Enter team size: "))
random.shuffle(names)
teams = [names[i:i + team_size] for i in range(0, len(names), team_size)]
for idx, team in enumerate(teams, 1):
    print(f"Team {idx}: {team}")
