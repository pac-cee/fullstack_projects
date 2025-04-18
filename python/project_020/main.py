nums = input("Enter numbers separated by spaces: ").split()
nums = [int(n) for n in nums]
nums.sort()
print(f"Sorted list: {nums}")
