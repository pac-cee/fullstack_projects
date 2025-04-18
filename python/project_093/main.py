"""
Project 093: Basic QR Code Generator
This script generates a QR code image from user-provided text or URL.
"""
import qrcode

def main():
    data = input("Enter the text or URL for the QR code: ").strip()
    if not data:
        print("No data provided.")
        return
    img = qrcode.make(data)
    file_name = input("Enter filename to save QR code (default: qrcode.png): ").strip() or "qrcode.png"
    img.save(file_name)
    print(f"QR code saved as {file_name}")

if __name__ == "__main__":
    main()
