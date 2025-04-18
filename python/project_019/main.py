nums = input("Enter numbers separated by spaces: ").split()
nums = [int(n) for n in nums]
unique = list(set(nums))
print(f"Unique elements: {unique}")
