from string import Template

html_template = '''
<html>
<head><title>$title</title></head>
<body>
    <h1>$header</h1>
    <p>$content</p>
</body>
</html>
'''

title = input("Enter page title: ")
header = input("Enter header: ")
content = input("Enter content: ")

html = Template(html_template).substitute(title=title, header=header, content=content)

filename = input("Enter output HTML filename: ")
with open(filename, 'w') as f:
    f.write(html)
print(f"HTML file '{filename}' created with rendered template.")
