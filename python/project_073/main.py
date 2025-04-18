import html2text

html_file = input("Enter HTML filename: ")
md_file = input("Enter Markdown filename: ")
try:
    with open(html_file, 'r') as f:
        html = f.read()
    md = html2text.html2text(html)
    with open(md_file, 'w') as f:
        f.write(md)
    print(f"Converted {html_file} to {md_file}.")
except FileNotFoundError:
    print("File not found.")
