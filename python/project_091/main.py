"""
Project 091: Basic URL Expander
This script takes a short code from the URL shortener and returns the original long URL.
"""
import os
import json

MAPPING_FILE = "../project_090/url_map.json"
SHORT_URL_PREFIX = "http://short.url/"

def load_mappings():
    if os.path.exists(MAPPING_FILE):
        with open(MAPPING_FILE, "r") as f:
            return json.load(f)
    return {}

def main():
    mappings = load_mappings()
    short_url = input("Enter the short URL to expand: ").strip()
    if not short_url.startswith(SHORT_URL_PREFIX):
        print("Invalid short URL format.")
        return
    code = short_url.replace(SHORT_URL_PREFIX, "")
    long_url = mappings.get(code)
    if long_url:
        print(f"Original URL: {long_url}")
    else:
        print("Short URL not found.")

if __name__ == "__main__":
    main()
