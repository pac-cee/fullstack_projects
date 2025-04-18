import PyPDF2

output_file = input("Enter output PDF filename: ")
input_files = input("Enter PDF filenames to merge, separated by commas: ").split(',')
input_files = [f.strip() for f in input_files if f.strip()]
merger = PyPDF2.PdfMerger()
try:
    for file in input_files:
        merger.append(file)
    merger.write(output_file)
    merger.close()
    print(f"Merged PDFs into '{output_file}'.")
except FileNotFoundError as e:
    print(f"File not found: {e.filename}")
except Exception as e:
    print(f"Error: {e}")
