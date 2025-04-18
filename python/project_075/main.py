import PyPDF2

pdf_file = input("Enter PDF filename: ")
try:
    with open(pdf_file, 'rb') as f:
        reader = PyPDF2.PdfReader(f)
        for i, page in enumerate(reader.pages):
            print(f"Page {i+1}:")
            print(page.extract_text())
except FileNotFoundError:
    print("File not found.")
except Exception as e:
    print(f"Error: {e}")
