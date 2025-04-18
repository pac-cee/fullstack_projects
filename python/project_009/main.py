nums = input("Enter numbers separated by spaces: ").split()
nums = [int(n) for n in nums]
reversed_nums = list(reversed(nums))
print(f"Reversed list: {reversed_nums}")
