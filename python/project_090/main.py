"""
Project 090: Basic URL Shortener
This script allows the user to input a long URL and generates a short code for it, storing the mapping in a local file.
"""
import os
import json
import string
import random

MAPPING_FILE = "url_map.json"
SHORT_URL_PREFIX = "http://short.url/"


def load_mappings():
    if os.path.exists(MAPPING_FILE):
        with open(MAPPING_FILE, "r") as f:
            return json.load(f)
    return {}

def save_mappings(mappings):
    with open(MAPPING_FILE, "w") as f:
        json.dump(mappings, f, indent=2)

def generate_short_code(length=6):
    chars = string.ascii_letters + string.digits
    return ''.join(random.choices(chars, k=length))

def shorten_url(long_url, mappings):
    # Check if already shortened
    for code, url in mappings.items():
        if url == long_url:
            return code
    # Generate a new code
    while True:
        code = generate_short_code()
        if code not in mappings:
            mappings[code] = long_url
            return code

def main():
    mappings = load_mappings()
    long_url = input("Enter the long URL to shorten: ").strip()
    if not (long_url.startswith("http://") or long_url.startswith("https://")):
        print("Invalid URL. Please include http:// or https://")
        return
    code = shorten_url(long_url, mappings)
    save_mappings(mappings)
    print(f"Short URL: {SHORT_URL_PREFIX}{code}")

if __name__ == "__main__":
    main()
