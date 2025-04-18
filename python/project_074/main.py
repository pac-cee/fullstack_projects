from fpdf import FPDF

pdf_file = input("Enter PDF filename: ")
text = input("Enter text for the PDF: ")
pdf = FPDF()
pdf.add_page()
pdf.set_font("Arial", size=12)
pdf.multi_cell(0, 10, text)
pdf.output(pdf_file)
print(f"PDF '{pdf_file}' created.")
