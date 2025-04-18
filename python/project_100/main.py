"""
Project 100: Basic Text-to-Speech Converter
This script converts user-provided text to speech and saves it as an audio file.
"""
import pyttsx3

def main():
    text = input("Enter text to convert to speech: ").strip()
    if not text:
        print("No text provided.")
        return
    file_name = input("Enter filename to save audio (default: speech.mp3): ").strip() or "speech.mp3"
    engine = pyttsx3.init()
    engine.save_to_file(text, file_name)
    engine.runAndWait()
    print(f"Speech saved as {file_name}")

if __name__ == "__main__":
    main()
