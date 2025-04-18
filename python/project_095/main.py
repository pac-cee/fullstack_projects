"""
Project 095: Basic Barcode Generator
This script generates a barcode image from user-provided data.
"""
import barcode
from barcode.writer import ImageWriter

def main():
    data = input("Enter the data for the barcode: ").strip()
    if not data:
        print("No data provided.")
        return
    code128 = barcode.get('code128', data, writer=ImageWriter())
    file_name = input("Enter filename to save barcode (default: barcode.png): ").strip() or "barcode.png"
    code128.save(file_name.replace('.png',''))
    print(f"Barcode saved as {file_name}")

if __name__ == "__main__":
    main()
