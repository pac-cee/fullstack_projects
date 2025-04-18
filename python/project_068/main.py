import xml.etree.ElementTree as ET

filename = input("Enter XML filename: ")
try:
    tree = ET.parse(filename)
    root = tree.getroot()
    def print_element(elem, indent=""):
        print(f"{indent}<{elem.tag}>: {elem.text.strip() if elem.text else ''}")
        for child in elem:
            print_element(child, indent + "  ")
    print_element(root)
except FileNotFoundError:
    print("File not found.")
except ET.ParseError:
    print("Invalid XML file.")
