"""
Project 099: Basic Language Translator
This script translates text from one language to another using the LibreTranslate API.
"""
import requests

def main():
    text = input("Enter text to translate: ").strip()
    source = input("Source language code (e.g., en): ").strip()
    target = input("Target language code (e.g., es): ").strip()
    if not text or not source or not target:
        print("All fields are required.")
        return
    url = "https://libretranslate.com/translate"
    payload = {
        "q": text,
        "source": source,
        "target": target,
        "format": "text"
    }
    try:
        response = requests.post(url, data=payload)
        data = response.json()
        print(f"Translated text: {data['translatedText']}")
    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    main()
