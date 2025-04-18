"""
Project 096: Basic Barcode Reader
This script reads a barcode image and prints the decoded data.
"""
from PIL import Image
from pyzbar.pyzbar import decode

def main():
    file_name = input("Enter the barcode image filename: ").strip()
    try:
        img = Image.open(file_name)
        decoded_objs = decode(img)
        if not decoded_objs:
            print("No barcode found in the image.")
            return
        for obj in decoded_objs:
            print(f"Decoded data: {obj.data.decode('utf-8')}")
    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    main()
