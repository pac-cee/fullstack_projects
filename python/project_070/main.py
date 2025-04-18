import xml.etree.ElementTree as ET
import json

xml_file = input("Enter XML filename: ")
json_file = input("Enter JSON filename: ")

def elem_to_dict(elem):
    d = {elem.tag: {}}
    children = list(elem)
    if children:
        for child in children:
            d[elem.tag].update(elem_to_dict(child))
    else:
        d[elem.tag] = elem.text
    return d

try:
    tree = ET.parse(xml_file)
    root = tree.getroot()
    data = elem_to_dict(root)
    with open(json_file, 'w') as jf:
        json.dump(data, jf, indent=4)
    print(f"Converted {xml_file} to {json_file}.")
except FileNotFoundError:
    print("File not found.")
except ET.ParseError:
    print("Invalid XML file.")
