import markdown

md_file = input("Enter Markdown filename: ")
html_file = input("Enter HTML filename: ")
try:
    with open(md_file, 'r') as f:
        text = f.read()
    html = markdown.markdown(text)
    with open(html_file, 'w') as f:
        f.write(html)
    print(f"Converted {md_file} to {html_file}.")
except FileNotFoundError:
    print("File not found.")
