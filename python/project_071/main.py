import json
import xml.etree.ElementTree as ET

json_file = input("Enter JSON filename: ")
xml_file = input("Enter XML filename: ")

def dict_to_elem(d, root_tag):
    root = ET.Element(root_tag)
    def build(elem, d):
        if isinstance(d, dict):
            for k, v in d.items():
                child = ET.SubElement(elem, k)
                build(child, v)
        else:
            elem.text = str(d)
    build(root, d)
    return root

try:
    with open(json_file, 'r') as jf:
        data = json.load(jf)
    root_tag = list(data.keys())[0] if isinstance(data, dict) else 'root'
    root = dict_to_elem(data[root_tag] if root_tag in data else data, root_tag)
    tree = ET.ElementTree(root)
    tree.write(xml_file, encoding='utf-8', xml_declaration=True)
    print(f"Converted {json_file} to {xml_file}.")
except FileNotFoundError:
    print("File not found.")
except json.JSONDecodeError:
    print("Invalid JSON file.")
