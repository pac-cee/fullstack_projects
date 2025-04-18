import PyPDF2

pdf_file = input("Enter PDF filename to split: ")
try:
    with open(pdf_file, 'rb') as f:
        reader = PyPDF2.PdfReader(f)
        for i, page in enumerate(reader.pages):
            writer = PyPDF2.PdfWriter()
            writer.add_page(page)
            outname = f"page_{i+1}.pdf"
            with open(outname, 'wb') as out:
                writer.write(out)
            print(f"Created {outname}")
except FileNotFoundError:
    print("File not found.")
except Exception as e:
    print(f"Error: {e}")
