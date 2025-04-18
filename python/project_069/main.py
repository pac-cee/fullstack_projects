import xml.etree.ElementTree as ET

filename = input("Enter XML filename: ")
root_tag = input("Enter root tag: ")
root = ET.Element(root_tag)
while True:
    tag = input("Enter tag (or 'quit' to finish): ")
    if tag.strip().lower() == 'quit':
        break
    value = input("Enter value: ")
    child = ET.SubElement(root, tag)
    child.text = value

tree = ET.ElementTree(root)
tree.write(filename, encoding='utf-8', xml_declaration=True)
print(f"XML file '{filename}' written.")
