import requests
from bs4 import BeautifulSoup

url = input("Enter URL to crawl: ")
try:
    response = requests.get(url)
    soup = BeautifulSoup(response.text, 'html.parser')
    links = [a.get('href') for a in soup.find_all('a', href=True)]
    print("Links found on the page:")
    for link in links:
        print(link)
except Exception as e:
    print(f"Error: {e}")
